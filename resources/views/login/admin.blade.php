@extends('_partials.layout-login')
@section('titlePage', 'Login')

@section('content')
<div class="w-full flex flex-col justify-center items-center px-4">
    <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl bg-white rounded-xl shadow-lg p-6 space-y-6">

        <div class="flex justify-center">
            <img src="{{ asset('/img/logos/coordify.svg') }}" alt="Logo Coordify" class="h-14">
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-900">Acceso a administradores</h2>

        <form method="POST" action="{{ route('admin.checklogin') }}" class="space-y-5">
            @csrf

            <div>
                <label class="text-base font-medium text-gray-900">Correo o Usuario</label>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="name"
                    placeholder="example@example.com"
                    class="mt-2 w-full h-10 px-3 py-2 border border-gray-300 rounded-md bg-transparent text-base placeholder-gray-400 focus:ring-1 focus:ring-gray-400 focus:outline-none"
                />
            </div>

            <div>
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">
                    <label class="text-base font-medium text-gray-900">Contraseña</label>
                    <a href="#" class="text-sm font-semibold text-black hover:underline mt-1 lg:mt-0">¿Olvidaste tu contraseña?</a>
                </div>
                @error('password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input
                    type="password"
                    name="password"
                    placeholder="********"
                    class="mt-2 w-full h-10 px-3 py-2 border border-gray-300 rounded-md bg-transparent text-base placeholder-gray-400 focus:ring-1 focus:ring-gray-400 focus:outline-none"
                />
            </div>

            <button
                type="submit"
                class="w-full bg-secundary text-white py-2.5 rounded-md font-semibold hover:bg-opacity-90 transition shadow"
            >
                Comenzar
            </button>
        </form>

        <div class="text-sm text-start">
            <a href="{{ route('login') }}" class="hover:underline">Soy usuario</a>
        </div>
    </div>
</div>
@endsection
