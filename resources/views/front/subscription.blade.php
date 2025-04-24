@extends('_partials.layout-front')

@section('titlePage', 'Suscripciones')

@section('content')
    @if(session('error'))
        <script>
            mylocalStorage = window.localStorage;
            mylocalStorage.setItem('laravelError', "{{ session('error') }}");
        </script>
    @endif
    <div class="w-full flex flex-col items-center">
        <div class="app w-[85%] lg:w-[80%] flex flex-col items-center">
            
            @if (auth()->user())
                <div class="containerActualSub flex flex-col lg:flex-row w-[100%] lg:w-[50%] bg-gray-100 rounded-lg mt-4">
                    <div class="w-[100%] lg:w-[70%] p-5">
                        <p class="text-2xl">Tu suscripcion actual es: <span class="font-bold">{{ auth()->user()->subscription->name }}</span></p>
                        <ul class="list-disc ml-8 mt-4">
                            <li>Uso completo y gratuito de Coordify</li>
                            <li>Posibilidad de crear hasta 3 eventos</li>
                            <li>Tarifa del 15% en los eventos de pago</li>
                            <li>Sin tarjetas de debito o credito</li>
                        </ul>
                    </div>
                    
                    <div class="w-[100%] lg:w-[30%] flex justify-center lg:justify-end px-12 items-center">
                    <picture class="w-[200px] block animate-float">
                        <source srcset="{{ asset('img/subscription/'. auth()->user()->subscription->image) }}" type="image/webp">
                        <img src="{{ asset('img/subscription/' . auth()->user()->subscription->aux_image) }}" alt="Suscripción " . {{ auth()->user()->subscription->name }}>
                    </picture>
                    </div>
                </div>
            @endif

            <div class="flex justify-center items-center flex-col mt-8">
                <h1 class="text-3xl font-bold">Coordina como un profesional</h1>
                <div class="ContainerSubscriptions w-[100%] lg:w-[70%] flex flex-col lg:flex-row gap-6 mt-8 mb-12">
                    <div class="subSilver w-[100%] lg:w-[33%] bg-gray-100 py-8 px-8 rounded-lg flex flex-col gap-8">
                        <div>
                            <h2 class="text-xl text-black">Plan plata | 5,99</h2>
                            <ul class="list-disc ml-6 mt-4">
                                <li>Hasta 8 eventos</li>
                                <li>Posibilidad de destacar 1 evento</li>
                                <li>Acceso anticipado a nuevas funcionalidades</li>
                                <li>Tarifa del 10% en los eventos con entrada de pago</li>
                            </ul>
                        </div>
                        <p class="text-sm">Ideal para organizadores ocasionales que buscan más capacidad y visibilidad sin grandes compromisos.</p>
                        <form method="POST" action="{{ route('subscription.checkout') }}">
                            @csrf
                            <input type="hidden" name="price_id" value="price_1RFCTZP2SqHd0rALLDdtlgAl">
                            <input type="hidden" name="plan_id" value="2">
                            <button type="submit" class="cursor-pointer px-6 rounded-full py-2 bg-secundary text-white font-medium text-center hover:bg-black hover:scale-103 transition duration-360">
                                Obtener Plan plata
                            </button>
                        </form>

                    </div>
                    <div class="subGold w-[100%] lg:w-[33%] bg-secundary py-8 px-8 rounded-lg flex flex-col gap-8 ring-1 ring-primary lg:scale-[1.04]">
                        <div>
                            <h2 class="text-xl text-white">Plan oro | 12,99</h2>
                            <ul class="list-disc ml-6 mt-4">
                                <li class="text-white">Hasta 20 eventos</li>
                                <li class="text-white">Posibilidad de destacar hasta 5 eventos</li>
                                <li class="text-white">Acceso anticipado a nuevas funcionalidades</li>
                                <li class="text-white">Reducción de la tarifa al 5% en los eventos con entrada de pago</li>
                            </ul>
                        </div>
                        <p class="text-white text-sm">Pensado para usuarios activos que gestionan varios eventos al mes y necesitan mayor alcance y ventajas económicas.</p>
                        <form method="POST" action="{{ route('subscription.checkout') }}">
                            @csrf
                            <input type="hidden" name="price_id" value="price_1RFCU0P2SqHd0rALAIjkEdxg">
                            <input type="hidden" name="plan_id" value="3">
                            <button type="submit" class="cursor-pointer px-6 rounded-full py-2 bg-gray-100 text-secundary font-medium text-center hover:bg-primary hover:scale-103 transition duration-360">
                                Obtener Plan oro
                            </button>
                        </form>
                    </div>
                    <div class="subDiamond w-[100%] lg:w-[33%] bg-gray-100 py-8 px-8 rounded-lg flex flex-col gap-8">
                        <div>
                            <h2 class="text-xl text-black">Plan diamante | 29,99</h2>
                            <ul class="list-disc ml-6 mt-4">
                                <li>Eventos ilimitados</li>
                                <li>Posibilidad de destacar hasta 15 eventos</li>
                                <li>Acceso completo a nuevas funcionalidades</li>
                                <li>Comisiones al 0% en los eventos con entrada de pago</li>
                            </ul>
                        </div>
                        <p class="text-sm">La opción más completa para profesionales: eventos ilimitados, máxima visibilidad y sin comisiones por venta de entradas.</p>
                        <form method="POST" action="{{ route('subscription.checkout') }}">
                            @csrf
                            <input type="hidden" name="price_id" value="price_1RFCUOP2SqHd0rAL73mMrNF0">
                            <input type="hidden" name="plan_id" value="4">
                            <button type="submit" class="cursor-pointer px-6 rounded-full py-2 bg-secundary text-white font-medium text-center hover:bg-black hover:scale-103 transition duration-360">
                                Obtener Plan diamante
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection