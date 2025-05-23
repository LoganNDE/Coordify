@extends('_partials.layout-front')
@section('titlePage', 'QR Code')
@section('content')
<div class="w-full flex flex-col items-center lg:mt-8">
    <div class="bg-gray-100 w-[95%] lg:w-[80%] rounded-xl shadow-xl overflow-hidden">

        <a class="mt-3 ml-3 px-6 py-2 inline-block bg-secundary text-white font-semibold rounded-md shadow hover:bg-opacity-80 transition" href="{{ route('front.index') }}">
            ← Atrás
        </a>

        <div class="splide p-6" id="splideQR" aria-label="Códigos QR">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($data as $item)
                        <li class="splide__slide flex flex-col items-center justify-center gap-4">
                            <p class="text-gray-700 text-lg font-semibold">Nombre: {{ $item['name'] }}</p>
                            <img src="{{ $item['qrCode'] }}" alt="QR Code de {{ $item['name'] }}" class="w-64 h-64 object-contain border border-gray-300 rounded-md shadow">
                            <a href="{{ $item['qrCode'] }}" download class="cursor-pointer bg-secundary text-white px-4 py-2 rounded-md">
                                Descargar
                            </a>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
