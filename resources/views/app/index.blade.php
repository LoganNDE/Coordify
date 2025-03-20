@extends('_partials.layout')
@section('titlePage', 'Inicio')

@section('content')
    @if(session('success'))
        <script>
            console.log("{{ session('success') }}");
            const mylocalStorage = window.localStorage;
            mylocalStorage.setItem('successLaravel', "{{ session('success') }}");
        </script>
    @endif
    <div class="main lg:w-4/6 w-6/6 p-5 h-10/12 flex flex-col justify-center gap-3">
        <section class="flex lg:flex-row flex-col align-center items-center w-full max-w-full gap-3 lg:gap-4">
            <div class="conatinerBtn flex justify-between items-center h-full lg:w-[28%] w-[100%] gap-2">
                <a class="bg-blue-700 hover:bg-blue-500 text-white py-2 px-7 lg:px-6 rounded-lg lg:text-base text-[15px]" href="{{ route('events.create') }}">Crear evento</a>
                <a class="bg-blue-700 hover:bg-blue-500 text-white py-2 px-7 lg:px-6 rounded-lg lg:text-base text-[15px]" id="btnImportEvent" href="#">Importar evento</a>
            </div>
            <div class="containerSearchBar flex items-center h-full lg:w-[72%] w-[100%]">
                <form class="w-full mx-auto">   
                    <label for="default-search" class="mb-2 lg:font-md sm:font-xs text-gray-900 sr-only dark:text-white">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-3 ps-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Busca tu evento..." required />
                        <button type="submit" class="text-white absolute end-2 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                    </div>
            </div>
        </section>
        
        <section class="events w-full max-h-[100%] h-[100%] flex lg:flex-row flex-col gap-3">
            <div class="containerEventList lg:w-5/6 lg:h-full h-[300px] w-full flex overflow-auto">
                <div class="flex flex-col gap-3 w-full p-3 rounded-md bg-gray-100 items-center">
                        @forelse ($events as $event)
                        <div class="info flex w-full justify-between p-3 rounded-lg bg-gray-200">
                                <span class="nameEvent">{{ $event['name'] }}</span>
                                <span>12/24</span>
                                <div class="actionBtns flex gap-4">
                                    <a href="{{ route('events.edit', $event['id']) }}"><img src="img/edit.svg" class="w-7" alt=""></a>
                                    <a href="{{ route('events.archive', $event['id']) }}"><img src="img/archive.svg" class="w-6" alt=""></a>
                                    <a href="{{ route('events.delete', $event['id']) }}"><img src="img/delete.svg" class="w-6 btnRemove" alt=""></a>
                                </div>
                        </div>
                        @empty
                            <p class="text-lg">Ningún evento creado 😮</p>
                        @endforelse
                </div>
            </div>
            <div class="flex justify-center p-3 containerAdminList lg:w-1/6 w-[100%] rounded-lg bg-gray-100 overflow-auto">
                <div class="flex gap-4 flex-col">
                    <div class="infoAdminList flex justify-center items-center flex-col">
                        <h3 class="text-center">Administradores</h3>
                        <a class="bg-blue-700 hover:bg-blue-500 text-white py-1 px-8 text-sm rounded-lg text-center" href="{{ route('events.newadmin') }}">Agregar</a>     
                    </div>
                    <div class="adminList pt-3 flex flex-col gap-5">

                        @if ($mainAdmin->name != auth()->user()->name)
                            <div class="infoAdmin flex items-center gap-4">
                                <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset($mainAdmin->image) ? Storage::url($mainAdmin->image) : '/img/default.png' }}" alt="{{ $mainAdmin->name }} photo">
                                <span class="userName adminUser" >{{ $mainAdmin->name }} </span>
                            </div>
                        @endif

                        <div class="infoAdmin flex items-center gap-4">
                                <img class="w-10 h-10 rounded-full object-cover object-top" src="{{ isset(auth()->user()->image) ? Storage::url(auth()->user()->image) : '/img/default.png' }}" alt="{{ auth()->user()->name }} photo">
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
        <section class="stats grid grid-cols-2 lg:grid-cols-4 gap-4 w-full">
            <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><span class="flex w-full justify-center text-2xl font-bold">{{ count($events)  }}</span><p>Evento activo/s</p></div>
            <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><span class="flex w-full justify-center text-2xl font-bold">{{ $eventsArchive }}</span><p>Evento/s archivado/s</p></div>
            <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><span class="flex w-full justify-center text-2xl font-bold">2</span><p>Elementos eliminados</p></div>
            <div class="infoStats w-full p-5 rounded-lg bg-gray-100 text-center"><span class="flex w-full justify-center text-2xl font-bold">16</span><p>Elementos creados</p></div>
        </section>
    </div>
    @if(session('error'))
        <script>
            mylocalStorage = window.localStorage;
            mylocalStorage.setItem('laravelError', "{{ session('error') }}");
        </script>
    @endif
@endsection