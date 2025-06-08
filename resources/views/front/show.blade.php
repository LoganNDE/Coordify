@extends('_partials.layout-front')

@section('titlePage', 'Evento')
@section('content')
<div class="w-full flex flex-col items-center lg:mt-8">
    <div class="bg-gray-100 w-[95%] lg:w-[80%] rounded-xl shadow-xl overflow-hidden">
        @if (session('error'))
            <p class="p-4 text-red-600 text-center uppercase font-semibold">{{ session('error') }}</p>
        @endif

        <a class="mt-3 ml-3 px-6 py-2 inline-block bg-secundary text-white font-semibold rounded-md shadow hover:bg-opacity-80 transition" href="{{ route('front.index') }}">
            ← Atrás
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-[480px_1fr] gap-y-10 gap-x-12 p-5 lg:p-10">
            <div class="flex justify-center items-start">
                <img class="w-full max-w-[460px] h-[420px] object-cover object-center rounded-lg shadow" 
                     src="{{ isset($event->image) ? Storage::url($event->image) : asset('/img/default-event.png') }}" 
                     alt="{{ $event->name }}">
            </div>

            <div class="flex flex-col justify-between gap-5">
                <h1 class="text-3xl font-bold uppercase text-gray-900 mb-3">{{ $event->name }}</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div>
                        <h3 class="font-bold uppercase text-gray-800">Ubicación</h3>
                        <p><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->address) }}" target="_blank" class="text-secundary underline">{{ $event->address }}, {{ $event->community }}</a></p>
                    </div>
                    <div>
                        <h3 class="font-bold uppercase text-gray-800">Fecha y Hora</h3>
                        <p>
                            <span>Empieza el</span> {{ date('d/m/Y', strtotime($event->startDate)) }}
                            {{ $event->startTime ? '- ' . date('H:i', strtotime($event->startTime)) : '' }}

                            @if($event->endDate)
                                <br><span>Finaliza el</span> {{ date('d/m/Y', strtotime($event->endDate)) }}
                                {{ $event->endTime ? '- ' . date('H:i', strtotime($event->endTime)) : '' }}
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h3 class="font-bold uppercase text-gray-800">Categoría:</h3>
                        @if(isset($event->category))
                            <div class="flex gap-2 items-end">
                                <img src="{{ asset($event->category->image) }}" class="w-6 h-6 object-contain" alt="{{ $event->category->name }}">
                                <span class="text-sm font-semibold text-gray-900">{{ ucfirst($event->category->name) }}</span>
                            </div>
                        @else
                            <span class="text-sm text-gray-600">Sin categoría</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold uppercase text-gray-800">Participantes</h3>
                        <p>{{ $event->participants->count() ?? 0 }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="font-bold uppercase text-gray-800 mb-1">Descripción</h3>
                    <p class="text-gray-800 leading-relaxed">{{ $event->description }}</p>
                </div>

                <div class="mt-4 text-lg font-bold text-green-600">
                    @if ($event->paymentType === 'free' || $event->price === null || $event->price == 0)
                        Evento Gratuito
                    @else
                        {{ number_format($event->price, 2) }} €
                    @endif
                </div>

                <div class="flex flex-wrap gap-4 mt-6">
                    <a class="py-3 px-12 bg-primary text-white rounded-full shadow hover:bg-opacity-90 transition-all eventCkeckout }}" 
                       href="{{ route('payment.checkout', ['id' => $event->id]) }}">
                        Comprar
                    </a>
                    <a  href="mailto:{{ $event->user->email }}" class="py-3 px-12 bg-secundary text-white rounded-full shadow hover:bg-opacity-90 transition-all" href="#">
                        Contactar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
