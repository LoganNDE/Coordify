@extends('_partials.layout-front')

@section('titlePage', 'Evento')
@section('content')
    <div class="w-full flex flex-col items-center mt-10">
        <div class="bg-gray-100 h-[80%] w-[95%] lg:w-[80%] rounded-lg">
            @if (session('error'))
                <p class="p-4 text-red-600 text-center">{{ session('error') }}</p>
            @endif
            <a class="mt-3 ml-3 px-6 py-3 inline-block bg-gray-300 rounded-lg" href="{{ route('front.index') }}"><- Atras</a>
            <div class="grid grid-cols-1 lg:grid-cols-[500px_1fr] gap-4 h-full p-10">
                <div class="flex flex-col justify-center items-center">
                    <img class="w-[420px] h-[420px] object-cover object-center rounded-lg" src="{{ isset($event['image']) ? Storage::url($event['image']) : asset('/img/default-event.png') }}" alt="{{ $event['name'] }}">
                </div>
                <div class="flex justify-center flex-col p-5">
                    <div class="titleEventShow py-3">
                        <h1 class="text-3xl font-bold">{{ $event['name'] }}</h1>
                    </div>

                    <div class="flex justify-between py-3">
                        <div class="locationInfoShow">
                            <h3 class="font-bold">Ubicacion</h3>    
                            <p>Arganda del rey, Madrid</p>
                        </div>
                        <div class="locationInfoShow">
                            <h3 class="font-bold">Participantes</h3>
                            <p>10</p>
                        </div>
                    </div>

                    <div class="descriptionEventShow py-3">
                        <h3 class="font-bold">Descripcion</h3>
                        <p>{{ $event['description'] }}</p>
                    </div>

                    <div class="priceEvenShow py-3">
                        <span class="text-green-800">                                        
                            @if ($event['price'] == 0)
                                Gratuito
                            @else
                                {{ $event['price'] }}€
                            @endif
                        </span>
                    </div>

                    <div class="actionButtonsShow py-3 flex gap-x-6">
                        <a class="py-3 px-12 bg-yellow-300 rounded-full" href="{{ route('payment.checkout', $event->id)  }}">Comprar</a>
                        <a class="py-3 px-12 border rounded-full" href="">Contactar</a>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection