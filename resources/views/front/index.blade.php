@extends('_partials.layout-front')

@section('titlePage', 'Inicio')

@section('content')
<div class="w-full flex flex-col items-center">
    <div class="app w-[85%] lg:w-[80%]">

        <section class="searchBar w-full flex flex-col lg:flex-row items-end justify-center gap-4 pb-3 lg:py-3">
            <form class="w-full lg:w-auto form relative flex flex-col lg:flex-row justify-center gap-3" method="GET">
                {{-- Buscador de nombre destacado --}}
                <div class="relative w-full lg:w-[600px]">

                    <input name="search" value="{{ request('name') }}"
                        class="input rounded-full w-full px-8 py-3 border-2 border-transparent focus:outline-none focus:border-blue-500 placeholder-gray-400 transition-all duration-300 shadow-xs inset-shadow-xs"
                        placeholder="Buscar evento..." type="text" />
                        <button type="submit" class="cursor-pointer text-white absolute end-3 bottom-2 bg-secundary hover:bg-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-4 py-2 dark:bg-secundary dark:hover:bg-black dark:focus:ring-blue-300">Buscar</button>
                
                </div>
            </form>
            <select name="community" id="communityList" data-input="IndexInputCommunity"
                    class="rounded-full px-4 py-3 border-2 border-transparent focus:outline-none focus:border-blue-500 placeholder-gray-400 transition-all duration-300 shadow-xs inset-shadow-xs w-full lg:w-auto">
            </select>
        </section>

        {{-- Filtros activos --}}
        @php
            $activeFilters = request()->only(['search', 'category', 'community']);
        @endphp

        @if (count($activeFilters))
        <section class="filters flex flex-wrap justify-center gap-4 my-4">
            <input type="hidden" id="selectedCommunity" value="{{ request('community') != null ? request('community') : '' }}">
            @foreach ($activeFilters as $key => $value)
                <span class="rounded-full px-4 py-2 bg-gray-100 capitalize">{{ $value }}</span>
            @endforeach
            <div class="flex items-center">
                <a href="{{ route('front.index') }}">
                    <span class="rounded-full px-4 py-2 bg-gray-100 cursor-pointer">X</span>
                </a>
            </div>
        </section>
        @endif

        {{-- Slider de categorías --}}
        <section class="my-6 categories flex justify-center">
            <section class="splide w-full lg:w-[80%]" aria-label="Categorías">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($categories as $category)
                            <li class="splide__slide flex justify-center">
                                <a href="{{ route('front.index', array_merge(request()->except('page'), ['category' => $category['name']])) }}">
                                    <div class="flex justify-center flex-col items-center category-logo">
                                        <img class="w-[36px]" src="{{ asset($category['image']) }}" alt="{{ $category['name'] }}">
                                        <span class="background-categories"></span>
                                        <p class="text-[14px] capitalize">{{ $category['name'] }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </section>

        {{-- Eventos --}}
        <section class="main flex justify-center mt-10 mb-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8 w-full justify-center">
                @foreach ($events as $event)
                    <div class="event {{ $event['promoted'] ? 'eventPromoted' : '' }}">
                        <a href="{{ route('events.showPublic', $event['id']) }}">
                            <img class="bg-white w-full h-[250px] object-cover object-center rounded-lg"
                                src="{{ isset($event['image']) ? Storage::url($event['image']) : asset('/img/default-event.png') }}"
                                alt="{{ $event['name'] }}">
                            <div class="infoEvent">
                                <h3 class="mt-3 nameEvent">{{ $event['name'] }}</h3>
                                <div class="mt-1 infoDate flex justify-between">
                                    <span class="viewDate">{{ $event['startDate'] }}</span>
                                    <span class="viewTime">
                                        {{ $event['startTime'] ? date('H:i', strtotime($event['startTime'])) : '' }}
                                    </span>
                                </div>
                                <span class="priceEvent text-rich-black font-bold">
                                    @if ($event['price'] == 0)
                                        Gratuito
                                    @else
                                        {{ $event['price'] }}€
                                    @endif
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Paginación --}}
        <div class="mt-6">
            {{ $events->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
@endsection
