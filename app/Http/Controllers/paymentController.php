<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Routing\Controller;


class paymentController extends Controller
{

    public function __construct()
    {
    $this->middleware('auth:web,admin')->except([]);
    }

    public function checkout( String $id)
    {
        $event = Event::findOrFail($id);

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'images' => [asset(Storage::url($event['image']))],
                        'name' => $event['name'],
                        'description' => $event['description'],
                        
                    ],
                    'unit_amount' => ($event['price'] * 100), // en céntimos → 18.98€
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel', ['id' => $event['id']]),
            'metadata' => [
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
            return redirect()->route('events.public')->with('error', 'No session ID provided.');
        }
    
        $session = Session::retrieve($sessionId);
    
        if ($session->payment_status === 'paid') {
            $eventId = $session->metadata->event_id;
    
            // Aquí puedes registrar el pago, enviar entradas, etc.
            // Ejemplo:
            // Registro::create([...]);
            
            $event = Event::findOrFail($eventId);

            
            $participant = new Participant();
            $participant->name = auth()->user()->name;
            $participant->email = auth()->user()->email;

            $qr =  QRCodeController::generate($participant);
            $filePath = auth()->user()->id . auth()->user()->name . '/qr_code.png';
            Storage::disk('public')->put($filePath, $qr);
            
            $participant->qr_code = $filePath;
            $participant->save();

            $event->participants()->attach($participant->id);

    
            return view('checkout.success', ['event' => $event, 'qr_code' => $filePath]);
        }
    
        return redirect()->route('events.public')->with('error', 'Pago no completado');
    }


    public function cancelCheckout(String $id)
    {
        return redirect()->route('events.showPublic', ['id' => $id])->with('error', "El pago ha fallado, Vuelva a intentarlo");
    }


    public function checkoutSubscription(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();
        $priceId = $request->input('price_id'); // El ID de Stripe del precio mensual (ej: price_1234)

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
        ]);

        return redirect($session->url);
    }

    public function subscriptionSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) return redirect()->route('front.subscriptions')->with('error', 'No session ID provided');

        $session = Session::retrieve($sessionId);

        if ($session->status === 'complete' || $session->payment_status === 'paid') {
            // Aquí podrías guardar el plan al usuario:
            // $user = auth()->user();
            // $user->subscription_id = PLAN_ID;
            // $user->save();

            return redirect()->route('front.subscriptions')->with('success', 'Pago completado');
        }

        return redirect()->route('front.subscriptions')->with('error', 'Pago no completado');
    }

        public function subscriptionCancel()
        {
            return redirect()->route('front.subscriptions')->with('error', 'Suscripción cancelada');
        }
    
}
