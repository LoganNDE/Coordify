<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Checkout\Session;
use Illuminate\Routing\Controller;

class paymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin')->except([]);
    }

    public function checkout(string $id, Request $request)
    {
        $name_participant = null;

        if ($request->input('name')){
            $name_participant = $request->input('name');
        } 

        $event = Event::findOrFail($id);
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'images' => [asset(Storage::url($event->image))],
                        'name' => $event->name,
                        'description' => $event->description,
                    ],
                    'unit_amount' => ($event->price * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel', ['id' => $event->id]),
            'metadata' => [
                'participant_name' => $name_participant,
                'event_id' => $event->id,
                'user_id' => auth()->id() ?? 'guest',
            ],
        ]);

        return redirect($session->url);
    }

    public function checkoutSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect()->route('front.index')->with('error', 'No se ha proporcionado el ID de sesión.');
        }

        try {
            $session = Session::retrieve($sessionId);
        } catch (\Exception $e) {
            return redirect()->route('front.index')->with('error', 'La sesión de pago no es válida o ha expirado.');
        }

        if ($session->payment_status === 'paid') {
            $eventId = $session->metadata->event_id;

            if ($session->metadata->participant_name != null){
                $participant_name = $session->metadata->participant_name;
            }else{
                $participant_name = $session->customer_details->name;
            }

            $event = Event::findOrFail($eventId);
            $customerEmail = $session->customer_details->email;
            $user = auth()->user();

            // Verifica si ya existe un participante con esta sesión
            $participant = Participant::where('stripe_session_id', $session->id)->first();

            if (!$participant) {
                $participant = new Participant();
                $participant->name = $participant_name;
                $participant->email = $customerEmail;
                $participant->user_id = $user->id;
                $participant->stripe_session_id = $session->id;
                $participant->save();
            }

            if (!$event->participants->contains($participant->id)) {
                $event->participants()->attach($participant->id);
            
                $user_qr =  bcrypt("Participant:" . $participant->id . $participant->name . '_' . "Event:" . $eventId);
                $filePath = 'qrs/' . $participant->id . $participant->name . '/qr.png';
                Storage::disk('public')->put($filePath, QRCodeController::generate($user_qr));
                $participant->qr_code = $filePath;
                $participant->qr_decode = $user_qr;
                $participant->save();
    
            }


            return view('checkout.success', [
                'event' => $event,
                'qr_code' => $participant->qr_code ?? 'example'
            ]);
        }

        return redirect()->route('front.index')->with('error', 'El pago no se ha completado correctamente.');
    }

    public function cancelCheckout(string $id)
    {
        return redirect()->route('events.showPublic', ['id' => $id])
            ->with('error', 'El pago ha fallado, vuelva a intentarlo.');
    }

    public function checkoutSubscription(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();

        if ($user->stripe_subscription_id) {
            $stripeSubscription = Subscription::retrieve($user->stripe_subscription_id);
            
            if ($stripeSubscription && $stripeSubscription->status === 'active') {
                return back()->with('error', 'Ya tienes una suscripción activa. Dirijete a ajustes para obeter mas detalles.');
            }
        }

        $priceId = $request->input('price_id');

        $session = Session::create([
            'mode' => 'subscription',
            'payment_method_types' => ['card'],
            'customer_email' => $user->email,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription.cancel'),
            'metadata' => [
                'user_id' => $user->id,
                'plan_id' => $request->input('plan_id')
            ],
        ]);

        return redirect($session->url);
    }

    public function subscriptionSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect()->route('front.subscriptions')->with('error', 'No se ha proporcionado el ID de sesión.');
        }

        try {
            $session = Session::retrieve($sessionId);
        } catch (\Exception $e) {
            return redirect()->route('front.subscriptions')->with('error', 'La sesión de suscripción no es válida o ha expirado.');
        }


        if ($session->status === 'complete' || $session->payment_status === 'paid') {
            $user = auth()->user();
            $subscriptionId = $session->subscription;

            $user->subscription_id = $session->metadata->plan_id;
            $user->stripe_subscription_id = $subscriptionId;
            $user->save();

            return redirect()->route('front.subscriptions')->with('success', 'Suscripción completada.');
        }

        return redirect()->route('front.subscriptions')->with('error', 'La suscripción no se ha completado correctamente.');
    }

    public function errorSubscription()
    {
        return redirect()->route('front.subscriptions')->with('error', 'Suscripción cancelada.');
    }

    public function cancelSubscription(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();

        if (!$user->stripe_subscription_id) {
            return back()->with('error', 'No tienes ninguna suscripción activa.');
        }

        try {
            $subscription = Subscription::retrieve($user->stripe_subscription_id);

            $subscription->cancel_at_period_end = true;
            $subscription->save();

            return back()->with('success', 'Tu suscripción ha sido cancelada. Seguirá activa hasta el final del periodo actual.');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un error al cancelar tu suscripción: ' . $e->getMessage());
        }
    }
    
}
