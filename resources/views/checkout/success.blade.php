@extends('_partials.layout-front')

@section('titlePage', 'Pago confirmado')


@section('content')
    <div class="wrapper w-full flex justify-center min-h-[90vh]">
        <div class="flex flex-row items-center justify-center max-w-[80%]">
            <div class="w-[60%]">
                <a class="btn px-6 py-3 bg-gray-100 rounded-lg mb-3 inline-block" href="{{ route('front.index') }}">Volver al inicio</a>
                <h1 class="font-bold text-3xl mb-8">Pago realizado con exito</h1>
                <h3 class="font-bold">Detalles del evento</h>
                <h4 class="mb-4 text-2xl">{{ $event['name'] }}</h4>
                <div class="flex justify-between mb-3">
                    <span class="font-bold capitalize">{{ $event->category->name }}</span>
                    <span class="font-bold">Arganda del rey</span>
                </div>
                <p>{{ $event['description'] }}</p>
            </div>
            <div class="w-[40%] flex flex-col items-center justify-center">
                <img src="{{ Storage::url($qr_code) }}" alt="Código QR">
                <a href="{{ Storage::url($qr_code) }}" class="btn bg-yellow-200 py-4 px-24 mt-6 rounded-lg" download="qr_code_custom.png"> Descargar QR</a>   
            </div>
        </div>
    </div>

@endsection