@extends('_partials.layout-login')
@section('titlePage', 'Registro')

@section('content')
<div class="w-full flex flex-col justify-center items-center px-4">
    <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl bg-white rounded-xl shadow-lg p-6 space-y-6">

        <div class="flex justify-center">
            <img src="{{ asset('/img/logos/coordify.svg') }}" alt="Logo Coordify" class="h-14">
        </div>

        <h2 class="text-center text-2xl font-bold text-gray-900">Crea tu cuenta con un solo click</h2>

        <form method="POST" action="{{ route('user.register') }}" class="space-y-5">
            @csrf

            <div>
                <label class="text-base font-medium text-gray-900">Nombre de usuario</label>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="name"
                    placeholder="tuusuario"
                    class="mt-2 w-full h-10 px-3 py-2 border border-gray-300 rounded-md bg-transparent text-base placeholder-gray-400 focus:ring-1 focus:ring-gray-400 focus:outline-none"
                />
            </div>

            <div>
                <label class="text-base font-medium text-gray-900">Correo electrónico</label>
                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input
                    type="email"
                    name="email"
                    placeholder="example@example.com"
                    class="mt-2 w-full h-10 px-3 py-2 border border-gray-300 rounded-md bg-transparent text-base placeholder-gray-400 focus:ring-1 focus:ring-gray-400 focus:outline-none"
                />
            </div>

            <div>
                <label class="text-base font-medium text-gray-900">Contraseña</label>
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

            <div>
                <label class="text-base font-medium text-gray-900">Repite la contraseña</label>
                @error('verifyPassword')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input
                    type="password"
                    name="verifyPassword"
                    placeholder="********"
                    class="mt-2 w-full h-10 px-3 py-2 border border-gray-300 rounded-md bg-transparent text-base placeholder-gray-400 focus:ring-1 focus:ring-gray-400 focus:outline-none"
                />
            </div>

            <button
                type="submit"
                class="w-full bg-primary text-white py-2.5 rounded-md font-semibold hover:bg-opacity-90 transition shadow"
            >
                Registrarse
            </button>
        </form>

        <div class="text-sm text-center">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-black font-semibold hover:underline">
                Inicia sesión
            </a>
        </div>
    </div>
</div>
@endsection
