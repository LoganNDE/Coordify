@extends('_partials.layout-login')
@section('titlePage', 'Login')

@section('content')
<div class="w-full flex flex-col justify-center items-center px-4">
    <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl bg-white rounded-xl shadow-lg p-6 space-y-6">
        
        <div class="flex justify-center">
            <img src="{{ asset('/img/logos/coordify.svg') }}" alt="Logo Coordify" class="h-14">
        </div>

        <form method="POST" action="{{ route('checkLogin') }}" class="space-y-5">
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
                class="w-full bg-primary text-white py-2.5 rounded-md font-semibold hover:bg-opacity-90 transition shadow"
            >
                Comenzar
            </button>
        </form>

        <div class="space-y-3">
            <a href="{{ route('auth.google.redirect') }}"
                type="button"
                class="w-full inline-flex items-center justify-center border border-gray-400 bg-white text-gray-700 font-semibold py-2.5 rounded-md hover:bg-gray-100 transition"
            >
                <svg class="w-6 h-6 mr-2 text-rose-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.283 10.356h-8.327v3.451h4.792c-.446 2.193-2.313 3.453-4.792 3.453a5.27 5.27 0 0 1-5.279-5.28 5.27 5.27 0 0 1 5.279-5.279c1.259 0 2.397.447 3.29 1.178l2.6-2.599c-1.584-1.381-3.615-2.233-5.89-2.233a8.908 8.908 0 0 0-8.934 8.934 8.907 8.907 0 0 0 8.934 8.934c4.467 0 8.529-3.249 8.529-8.934 0-.528-.081-1.097-.202-1.625z"></path>
                </svg>
                Iniciar sesión con Google
            </a>

            <div class="flex justify-between text-sm font-medium">
                <a href="{{ route('admin.checklogin') }}" class="hover:underline">Soy administrador</a>
                <a href="{{ route('user.register') }}" class="hover:underline">¿Aún no tienes cuenta?</a>
            </div>
        </div>
    </div>
</div>
@endsection
