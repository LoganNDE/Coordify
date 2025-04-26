@extends('_partials.layout-front')
@section('title', 'Entradas')

@section('content')
    <div class="flex gap-3 flex-col w-[85%] lg:w-[80%] h-full mt-8">
        @if (isset($eventGroups))
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8 w-[100%] justify-center">
        @foreach ($eventGroups as $events)
            @php
                $event = $events->first();
                $count = $events->count();
            @endphp
                <div class="event relative {{ $event['promoted'] ? 'eventPromoted' : '' }}">
                    <a href="{{ route('events.showPublic', $event['id']) }}">
                        <span class="w-[30px] h-[30px] bg-primary absolute right-[5px] top-[-5px] flex justify-center items-center rounded-full">{{ $count }}</span>
                        <img class="bg-white w-full h-[250px] object-cover object-center rounded-lg" src="{{ isset($event['image']) ? Storage::url($event['image']) : asset('/img/default-event.png') }}" alt="{{ $event['name'] }}">
                        <div class="infoEvent">
                            <h3 class="mt-3 nameEvent">{{ $event['name'] }}</h3>
                            <div class="mt-1 infoDate flex justify-between">
                                <span class="viewDate">{{ $event['startDate'] }}</span>
                                <span class="viewTime"> {{ $event['startTime'] }}</span>
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
        @else
            <div class="flex justify-center mt-8"></div>
            <p class="text-center text-gray-500 mt-10">No tienes entradas activas para ningún evento. 😮</p>
        @endif
    </div>
@endsection