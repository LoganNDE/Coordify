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
        $event->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
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
        $event->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
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
        $event->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
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
        $event->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
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
        $event->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
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
    }
}
