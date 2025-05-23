@extends('_partials.layout')
@section('titlePage', 'Inicio')

@section('content')
<div class="flex gap-3 flex-col w-[90%] lg:w-4/6 mt-2 lg:mt-8 mx-auto">
    <section class="w-full flex flex-col gap-5 bg-gray-100 rounded-lg p-4 lg:p-10 shadow-md">
        <div class="flex justify-between items-center">
            <a class="mt-3 px-6 py-2 inline-block bg-secundary text-white font-semibold rounded-md shadow hover:bg-opacity-80 transition" href="{{ route('events.index') }}">
                ← Atrás
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <div class="flex-1 flex flex-col gap-3">
                <h2 class="text-xl font-semibold">{{ $event['name'] }}</h2>
                <p class="text-gray-700">{{ $event['description'] }}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800">
                    <div>
                        <h3 class="font-bold uppercase">Ubicación</h3>
                        <p>{{ $event->address ?? 'Sin dirección' }} @if($event->community), {{ $event->community }} @endif</p>
                    </div>
                    <div>
                        <h3 class="font-bold uppercase">Fecha y hora</h3>
                        <p>
                        <span>Empieza el</span> {{ date('d/m/Y', strtotime($event->startDate)) }}
                        {{ $event->startTime ? '- ' . date('H:i', strtotime($event->startTime)) : '' }}

                        @if($event->endDate)
                            <br><span>Finaliza el</span> {{ date('d/m/Y', strtotime($event->endDate)) }}
                            {{ $event->endTime ? '- ' . date('H:i', strtotime($event->endTime)) : '' }}
                        @endif
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold uppercase">Precio</h3>
                        <p class="font-semibold">
                            @if ($event->paymentType === 'free' || !$event->price)
                                Evento gratuito
                            @else
                                {{ number_format($event->price, 2) }} €
                            @endif
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold uppercase">Categoría</h3>
                        @if(isset($event->category))
                            <div class="flex items-center gap-2">
                                <img src="{{ asset($event->category->image) }}" alt="{{ $event->category->name }}" class="w-6 h-6 object-contain">
                                <span>{{ ucfirst($event->category->name) }}</span>
                            </div>
                        @else
                            <span>Sin categoría</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-center lg:items-end max-w-full lg:max-w-[300px]">
                <img class="rounded-lg object-cover w-full max-h-[300px]" src="{{ Storage::url($event['image']) }}" alt="{{ $event['name'] }}">
            </div>
        </div>

        <div class="mt-6">
            @php $count = count($event->participants); @endphp
            <h2 class="text-xl text-secundary font-bold mb-4">
                {{ $count }} Participante{{ $count !== 1 ? 's' : '' }}
            </h2>

            <div class="flex flex-col gap-3 h-auto lg:max-h-[200px] overflow-y-auto pr-1">
                @forelse ($event->participants as $participant)
                    <div class="bg-gray-200 p-4 rounded-lg flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-center gap-2 w-full md:w-[25%]">
                            <i class="fa-regular fa-circle-user"></i>
                            <span class="truncate">{{ $participant['name'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 w-full md:w-[25%]">
                            <i class="fa-regular fa-envelope"></i>
                            <span class="truncate">{{ $participant['email'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 w-full md:w-[25%] justify-start md:justify-center">
                            <i class="fa-solid fa-door-open"></i>
                            <span class="{{ $participant['status'] == 'pending' ? 'bg-red-700' : 'bg-green-700' }} h-3 w-3 rounded-full block"></span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Aún no hay participantes en tu evento. 😥</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
