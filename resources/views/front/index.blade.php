@extends('_partials.layout-front')

@section('titlePage', 'Inicio')
@section('content')
    <div class="min-h-[95vh] w-full flex flex-col items-center">
        <div class="app w-[80%]">
            <header class="w-full h-[100px] flex justify-between items-center">
                <div>Coordify</div>
                <div>
                    <a class=" px-6 rounded-full py-3 bg-primary text-smoke" href="{{ route('events.index') }}">Crear evento</a>
                </div>
            </header>
            <section class="searchBar w-full h-[100px] flex items-end justify-center py-3">
                <form class="form relative">
                    <button class="absolute left-2 -translate-y-1/2 top-1/2 p-1">
                        <svg
                        width="17"
                        height="16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        role="img"
                        aria-labelledby="search"
                        class="w-5 h-5 text-gray-700"
                        >
                        <path
                            d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                            stroke="currentColor"
                            stroke-width="1.333"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        </svg>
                </button>
                <input class="input rounded-full w-[600px] px-8 py-3 border-2 border-transparent focus:outline-none focus:border-blue-500 placeholder-gray-400 transition-all duration-300 shadow"
                placeholder="Search..."
                required=""
                type="text"/>
            </section>

            <section class="main main flex-1 flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-[repeat(5,_300px)] gap-4 w-[90%] justify-center">
                    @foreach ($events as $event)
                        <div class="p-4">
                            <img class="bg-white w-full h-[250px] object-cover object-center rounded-lg" src="{{ Storage::url($event['image']) }}" alt="{{ $event['name'] }}">
                            <div class="infoEvent">
                                <h3 class="mt-6 nameEvent">{{ $event['name'] }}</h3>
                                <div class="mt-3 infoDate flex justify-between">
                                    <span class="viewDate">{{ $event['startDate'] }}</span>
                                    <span class="viewTime"> {{ $event['startTime'] }}</span>
                                </div>
                                <span class="price">
                                    @if ($event['price'] == 0)
                                        Gratuito
                                    @else
                                        {{ $event['price'] }}€
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <footer class="bg-red-100 min-h-[5vh]">
        <p>Desarrollado por Logan Naranjo</p>
    </footer>
@endsection