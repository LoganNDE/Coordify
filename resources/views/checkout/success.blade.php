@extends('_partials.layout-front')

@section('titlePage', 'Pago confirmado')

@section('content')
<div class="w-full flex flex-col items-center lg:mt-8">
    <div class="bg-gray-100 w-[95%] lg:w-[80%] rounded-xl shadow-xl overflow-hidden p-5 lg:p-10">
        
        <a class="mb-4 inline-block px-6 py-2 bg-secundary text-white font-semibold rounded-md shadow hover:bg-opacity-80 transition" href="{{ route('front.index') }}">
            ← Volver al inicio
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_480px] gap-y-10 gap-x-12">


            <!-- Detalles del evento -->
            <div class="flex flex-col gap-6">
                <h1 class="text-3xl font-bold text-gray-900 uppercase">Pago realizado con éxito</h1>

                <div class="flex flex-col gap-2">
                    <h3 class="font-bold uppercase text-gray-800 text-sm">Nombre del Evento</h3>
                    <p class="text-xl font-semibold text-gray-800">{{ $event->name }}</p>
                </div>

                <div class="flex flex-col gap-2">
                    <h3 class="font-bold uppercase text-gray-800 text-sm">Ubicación</h3>
                    <p>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->address) }}" target="_blank" class="text-secundary underline">
                            {{ $event->address }}, {{ $event->community }}
                        </a>
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <h3 class="font-bold uppercase text-gray-800 text-sm">Categoría</h3>
                    @if(isset($event->category))
                        <div class="flex items-center gap-2">
                            <img src="{{ asset($event->category->image) }}" class="w-6 h-6 object-contain" alt="{{ $event->category->name }}">
                            <span class="text-sm font-semibold text-gray-900">{{ ucfirst($event->category->name) }}</span>
                        </div>
                    @else
                        <span class="text-sm text-gray-600">Sin categoría</span>
                    @endif
                </div>

                <div class="flex flex-col gap-2">
                    <h3 class="font-bold uppercase text-gray-800 text-sm">Descripción</h3>
                    <p class="text-gray-800 leading-relaxed">{{ $event->description }}</p>
                </div>

                <div class="flex flex-col gap-2">
                    <h3 class="font-bold uppercase text-gray-800 text-sm">Precio</h3>
                    <p class="text-green-600 font-bold text-lg">
                        @if ($event->paymentType === 'free' || $event->price == 0)
                            Evento Gratuito
                        @else
                            {{ number_format($event->price, 2) }} €
                        @endif
                    </p>
                </div>


            </div>

            <!-- QR Code -->
            <div class="flex flex-col justify-center items-center gap-4">
                <img src="{{ Storage::url($qr_code) }}" class="lg:m-w-[300px] max-w-[60%]" alt="Código QR" class="w-full max-w-[360px] object-contain shadow-lg rounded-md">
                <a href="{{ Storage::url($qr_code) }}" class="inline-block bg-yellow-300 text-center text-black font-semibold py-3 px-10 rounded-md shadow hover:bg-yellow-400 transition-all" download="qr_code_custom.png">
                    Descargar QR
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
