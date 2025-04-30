@extends('_partials.layout-front')
@section('titlePage', 'Administradores')

@section('content')
    <div class="flex gap-3 flex-col items-center justify-center w-[85%] lg:w-[80%] h-full">
        <h1 class="text-4xl font-bold w-[1000px] text-center">Ups... Los administradores no tienen acceso a las funcionalidades públicas 😕</h1>
        <div class="flex justify-center gap-5">
            <a class="mt-3 px-4 py-3 bg-secundary text-white rounded-lg" id="logout" href="{{ route('admin.register') }}">Registrase como usuario</a>
            <a class="mt-3 px-6 py-3 bg-primary text-secundary rounded-lg" href="{{ route('events.index') }}">Gestionar eventos</a>    
        </div>
        
    </div>
@endsection