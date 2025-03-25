<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class CrearEventosEjemplos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event = new Event();
        $event->id = 4;
        $event->name = 'Cumpleaños de Logan';
        $event->description = 'Va a ser increible';
        $event->province = 'Madrid';
        $event->address = 'Jesus morante borras 29, Quart de poblet';
        $event->startDate = '2024-02-12';
        $event->startTime = '12:00:00';
        $event->endDate = '2024-02-12';
        $event->endTime = '22:00:00';
        $event->paymentType = 'free';
        $event->image = 'events/uqbitTmVNcJOihz43NWzTz3uiySrIe1Kk6hs9mCw.jpg';
        $event->community = 'Comunidad De Madrid';
        $event->user_id = 2;
        $event->save();

        $event = new Event();
        $event->id = 5;
        $event->name = 'Partido de futbol | Madrid vs Barcelona';
        $event->description = 'das';
        $event->province = 'Quart de Poblet';
        $event->address = 'Calle madre asuncion 22';
        $event->startDate = '1122-11-12';
        $event->startTime = '21:12:00';
        $event->endDate = '1221-02-12';
        $event->endTime = '12:21:00';
        $event->paymentType = 'free';
        $event->image = 'events/ocW5r3p7AujmM1nsJPajab7yXdLVolR7SVUtgqkO.png';
        $event->community = 'Comunidad De Madrid';
        $event->user_id = 2;
        $event->save();

        $event = new Event();
        $event->id = 6;
        $event->name = 'Apertura del nuevo tarantin chiflado';
        $event->description = null;
        $event->province = 'Valencia';
        $event->address = 'Jesus Morante Colo Colo 12';
        $event->startDate = '1122-02-12';
        $event->startTime = '12:22:00';
        $event->endDate = '1221-02-12';
        $event->endTime = '12:21:00';
        $event->paymentType = 'free';
        $event->image = 'events/DlEy8sO8mCCIxG5FWVH7N1H7tfTTBn1v2vzKd6mg.png';
        $event->community = 'Comunidad De Madrid';
        $event->user_id = 2;
        $event->save();

        $event = new Event();
        $event->id = 7;
        $event->name = 'Clases de piano | Multisala';
        $event->description = null;
        $event->province = 'Valencia';
        $event->address = 'Calle madre asuncion 22';
        $event->startDate = '1221-02-12';
        $event->startTime = '21:22:00';
        $event->endDate = '2122-02-21';
        $event->endTime = '21:22:00';
        $event->paymentType = 'free';
        $event->image = 'events/5BDqlaimDtvwFFpQnpjFEu8qWoIrJBcx5FmIvR8d.jpg';
        $event->community = 'Comunidad De Madrid';
        $event->user_id = 2;
        $event->save();

        $event = new Event();
        $event->id = 8;
        $event->name = 'Orquesta solidaria recaudacion DANA';
        $event->description = 'dasdadsa';
        $event->province = 'Valencia';
        $event->address = 'Salon de actos de Quart de Poblet';
        $event->startDate = '1212-02-12';
        $event->startTime = '21:22:00';
        $event->endDate = '0212-02-21';
        $event->endTime = '21:21:00';
        $event->paymentType = 'free';
        $event->image = 'events/OSKmmaIZSks4YVga1GavkfS7Icc3T2nQu6zl9LQU.jpg';
        $event->community = 'Comunidad De Madrid';
        $event->user_id = 2;
        $event->save();

        $event = new Event();
        $event->id = 9;
        $event->name = 'dasdsadasdsa';
        $event->description = null;
        $event->province = 'dasdsadas';
        $event->address = 'dsadsadsadsa';
        $event->startDate = '0012-12-24';
        $event->startTime = '12:21:00';
        $event->endDate = '4122-02-12';
        $event->endTime = '12:21:00';
        $event->paymentType = 'free';
        $event->image = 'events/OBqf1vr12iUhUtX5NyyDQdPwj61mxUTu12ipoKRZ.jpg';
        $event->community = 'Comunidad De Madrid';
        $event->user_id = 2;
        $event->save();
    }
}
