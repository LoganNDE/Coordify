@extends('_partials.layout')
@section('titlePage', 'Inicio')

@section('content')
        <div class="flex gap-3 flex-col w-[90%] lg:w-4/6 mt-2 lg:mt-8 mx-auto">
            <section class="flex lg:flex-row flex-col align-center items-center w-full max-w-full gap-3 lg:gap-4">
                <div class="conatinerBtn flex justify-between items-center h-full lg:w-[27%] w-[100%] gap-2">
                    <a class="bg-primary text-secundary hover:text-white transition duration-290 py-2 px-7 lg:px-6 lg:py-3 rounded-lg lg:text-base text-[15px]" href="{{ route('events.create') }}">Crear evento</a>
                    <a class="bg-secundary text-white py-2 px-7 lg:px-6 lg:py-3 rounded-lg lg:text-base text-[15px]" id="btnImportEvent" href="#">Importar evento</a>
                </div>
                <div class="containerSearchBar flex items-center h-full lg:w-[73%] w-[100%]">
                    <form class="w-full mx-auto" action="{{ route('events.index') }}" method="GET">   
                        <label for="default-search" class="mb-2 lg:font-md sm:font-xs text-gray-900 sr-only dark:text-white">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" name="search" class="block w-full p-3 ps-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 text-base dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Busca tu evento..." value="{{ request()->input('search') ?? '' }}" required />
                            @if (request()->input('search'))
                                <a href="{{ route('events.index') }}" class="cursor-pointer text-white absolute end-24 bottom-1.5 bg-gray-300 hover:bg-secundary transition duration-290 font-medium rounded-full text-sm w-9 h-9 flex justify-center items-center">X</a>
                            @endif
                            <button type="submit" class="cursor-pointer text-white absolute end-3 bottom-2 bg-secundary hover:bg-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-4 py-2 dark:bg-secundary dark:hover:bg-black dark:focus:ring-blue-300">Buscar</button>
                        </div>
                    </form>
                </div>
            </section>
            
            @if (isset($events))
            <section class="events w-full flex lg:flex-row flex-col gap-3">
                <div class="containerEventList lg:w-5/6 min-h-[450px] max-h-[450px] w-full flex overflow-auto bg-gray-100 rounded-md">
                    <div class="flex flex-col gap-3 w-full p-3 items-center">
                        @forelse ($events as $event)
                            <div class="info flex w-full justify-between p-3 rounded-lg bg-gray-200">
                                <a href="{{ route('events.show', $event['id']) }}" class="lg:w-[80%] w-[60%] inline-block">
                                    <div class="flex lg:flex-row flex-col gap-2 lg:gap-50">
                                        <span class="nameEvent">{{ $event['name'] }}</span>
                                        <span><i class="fa-regular fa-circle-user"></i> {{ count($event->participants) }}</span>
                                    </div>
                                </a>
                                <div class="actionBtns flex lg:gap-4 gap-2 lg:w-[20%] w-[40%]">
                                    @if ( $maxPromotedEvents > $promotedEvents) <a href="{{ route('events.promote', $event['id']) }}"><img src="{{ asset("img/actions/star.svg") }}" class="w-7" alt="Promote"></a> @endif
                                    <a href="{{ route('events.edit', $event['id']) }}"><img src="{{ asset("img/actions/edit.svg") }}" class="w-7" alt="Edit"></a>
                                    <a href="{{ route('events.archive', $event['id']) }}"><img src="{{ asset("img/actions/archive.svg") }}" class="w-7" alt="Archive"></a>
                                    <a href="{{ route('events.delete', $event['id']) }}"><img src="{{ asset("img/actions/delete.svg") }}" class="w-7 btnRemove" alt="Delete"></a>
                                </div>
                            </div>
                        @empty
                            @if (request()->input('search'))
                                <p class="text-lg">No se encontraron eventos. Asegurese que el evento buscado se encuentre activo 😣</p>
                            @else
                                <p class="text-lg">Ningún evento creado 😮</p>
                            @endif
                        @endforelse
                    </div>
                </div>
                <div class="flex justify-center p-3 containerAdminList lg:w-1/6 w-[100%] rounded-lg bg-gray-100 overflow-auto">
                    <div class="flex gap-4 flex-col">
                        <div class="infoAdminList flex justify-center items-center flex-col">
                            <h3 class="text-center">Administradores</h3>
                            <a class="bg-primary text-secundary py-1 px-8 text-sm rounded-lg text-center" href="{{ route('events.newadmin') }}">Agregar</a>     
                        </div>
                        <div class="adminList pt-3 flex flex-col gap-5">

                            @if ($mainAdmin->name != auth()->user()->name)
                                <div class="infoAdmin flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset($mainAdmin->image) ? Storage::url($mainAdmin->image) : asset('img/default.png') }}" alt="{{ $mainAdmin->name }} photo">
                                    <span class="userName adminUser" >{{ $mainAdmin->name }} </span>
                                </div>
                            @endif

                            <div class="infoAdmin flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset(auth()->user()->image) ? Storage::url(auth()->user()->image) : asset('img/default.png') }}" alt="{{ auth()->user()->name }} photo">
                                    <span class="userName" >{{ auth()->user()->name }} </span>
                                    <span class="active ml-2"></span>
                                </div>
                            
                            @foreach ($administrators as $administrator)
                                @if ($administrator->name != auth()->user()->name)
                                    <div class="flex items-center gap-4">
                                        <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset($administrator->image) ? Storage::url($administrator->image) : '/img/default.png' }}" alt="{{ $administrator->name }} photo">
                                        <span>{{ $administrator->name }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @else (isset($archives))
                <section class="events w-full flex lg:flex-row flex-col gap-3">
                    <div class="containerEventList lg:w-5/6 min-h-[450px] max-h-[450px] w-full flex overflow-auto bg-gray-100 rounded-md">
                        <div class="flex flex-col gap-3 w-full p-3 items-center">
                            @forelse ($archives as $archive)
                                <div class="info flex w-full justify-between p-3 rounded-lg bg-gray-200">
                                    <a href="{{ route('events.show', $archive['id']) }}" class="w-[80%] inline-block">
                                        <div class="flex gap-50">
                                            <span class="nameEvent">{{ $archive['name'] }}</span>
                                        </div>
                                    </a>
                                    <div class="actionBtns flex gap-4 w-[20%]">
                                        <a href="{{ route('events.edit', $archive['id']) }}"><img src="{{ asset("img/actions/edit.svg") }}" class="w-7" alt="Edit"></a>
                                        <a href="{{ route('events.unarchive', $archive['id']) }}"><img src="{{ asset("img/actions/archive.svg") }}" class="w-7" alt="Archive"></a>
                                        <a href="{{ route('events.delete', $archive['id']) }}"><img src="{{ asset("img/actions/delete.svg") }}" class="w-7 btnRemove" alt="Delete"></a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-lg">Ningún evento archivado 😮</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex justify-center p-3 containerAdminList lg:w-1/6 w-[100%] rounded-lg bg-gray-100 overflow-auto">
                        <div class="flex gap-4 flex-col">
                            <div class="infoAdminList flex justify-center items-center flex-col">
                                <h3 class="text-center">Administradores</h3>
                                <a class="bg-primary text-secundary py-1 px-8 text-sm rounded-lg text-center" href="{{ route('events.newadmin') }}">Agregar</a>     
                            </div>
                            <div class="adminList pt-3 flex flex-col gap-5">

                                @if ($mainAdmin->name != auth()->user()->name)
                                    <div class="infoAdmin flex items-center gap-4">
                                        <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset($mainAdmin->image) ? Storage::url($mainAdmin->image) : asset('img/default.png') }}" alt="{{ $mainAdmin->name }} photo">
                                        <span class="userName adminUser" >{{ $mainAdmin->name }} </span>
                                    </div>
                                @endif

                                <div class="infoAdmin flex items-center gap-4">
                                        <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset(auth()->user()->image) ? Storage::url(auth()->user()->image) : asset('img/default.png') }}" alt="{{ auth()->user()->name }} photo">
                                        <span class="userName" >{{ auth()->user()->name }} </span>
                                        <span class="active ml-2"></span>
                                    </div>
                                
                                @foreach ($administrators as $administrator)
                                    @if ($administrator->name != auth()->user()->name)
                                        <div class="flex items-center gap-4">
                                            <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset($administrator->image) ? Storage::url($administrator->image) : '/img/default.png' }}" alt="{{ $administrator->name }} photo">
                                            <span>{{ $administrator->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            
            <section class="stats grid grid-cols-2 lg:grid-cols-4 gap-4 w-full">
                <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><a href="{{ route('events.index') }}"><span class="flex w-full justify-center text-2xl font-bold">{{ isset($activeEvents) ? $activeEvents: ""  }}</span><p>Evento activo/s</p></a></div>
                <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><a href="{{ route('events.archives') }}"><span class="flex w-full justify-center text-2xl font-bold">{{ isset($totalArchives) ? $totalArchives: ""   }}</span><p>Evento/s archivado/s</p></a></div>
                @if ($maxEvents == null || $maxEvents > 0)
                    <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><span class="flex w-full justify-center text-2xl font-bold"> {{ $totalEvents . '/' . ($maxEvents == null ? '∞' : $maxEvents) }} </span><p>Eventos creados</p></div>
                @endif
                <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><span class="flex w-full justify-center text-2xl font-bold">{{ isset($promotedEvents) ? $promotedEvents . "/" . $maxPromotedEvents : "" }}</span><p>Eventos promocionados</p></div>

            </section>
        </div>
@endsection