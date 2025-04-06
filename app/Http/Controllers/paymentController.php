<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class paymentController extends Controller
{
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
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel', ['id' => $event['id']]),
        ]);
    
        return redirect($session->url);
    }


    public function cancelCheckout(String $id)
    {
        return redirect()->route('events.showPublic', ['id' => $id])->with('error', "El pago ha fallado, Vuelva a intentarlo");
    }
    
}
