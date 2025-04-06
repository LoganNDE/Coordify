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
            'cancel_url' => route('checkout.cancel'),
        ]);
    
        return redirect($session->url);
    }
    
}
