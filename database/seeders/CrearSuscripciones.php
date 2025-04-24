<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrearSuscripciones extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // Crear planes de suscripción
        $bronze = new Subscription();
        $bronze->name = 'Bronce';
        $bronze->image = 'bronze.webp';
        $bronze->aux_image = 'bronze.png';
        $bronze->event_limit = 3;
        $bronze->event_promotion = 0;
        $bronze->fee = 15;
        $bronze->save();

        $silver = new Subscription();
        $silver->name = 'Plata';
        $silver->image = 'silver.webp';
        $silver->aux_image = 'silver.png';
        $silver->event_limit = 8;
        $silver->event_promotion = 1;
        $silver->fee = 10;
        $silver->save();

        $gold = new Subscription();
        $gold->name = 'Oro';
        $gold->image = 'gold.webp';
        $gold->aux_image = 'gold.png';
        $gold->event_limit = 20;
        $gold->event_promotion = 5;
        $gold->fee = 5;
        $gold->save();

        $diamond = new Subscription();
        $diamond->name = 'Diamante';
        $diamond->image = 'diamond.webp';
        $diamond->aux_image = 'diamond.png';
        $diamond->event_limit = null;
        $diamond->event_promotion = 15;
        $diamond->fee = 0;
        $diamond->save();

    }
}
