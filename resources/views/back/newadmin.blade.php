@extends('_partials.layout')
@section('titlePage', 'Agregar administrador')

@section('content')
<div class="w-full flex flex-col justify-center items-center px-4">
    <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl bg-white rounded-xl shadow-lg p-6 space-y-6">

        <h2 class="text-center text-2xl font-bold leading-tight text-black">
            Agregar nuevo administrador
        </h2>

        <form class="space-y-5 mt-4" method="POST" action="{{ route('events.newadmin') }}">
            @csrf

            <div>
                <label class="text-base font-medium text-gray-900">
                    Nombre
                </label>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input
                    type="text"
                    name="name"
                    placeholder="Carlos"
                    class="mt-2 w-full h-10 px-3 py-2 border border-gray-300 rounded-md bg-transparent text-base placeholder-gray-400 focus:ring-1 focus:ring-gray-400 focus:outline-none"
                />
            </div>

            <div>
                <label class="text-base font-medium text-gray-900">
                    Correo
                </label>
                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input
                    type="email"
                    name="email"
                    placeholder="carlos@coordify.com"
                    class="mt-2 w-full h-10 px-3 py-2 border border-gray-300 rounded-md bg-transparent text-base placeholder-gray-400 focus:ring-1 focus:ring-gray-400 focus:outline-none"
                />
            </div>

            <button
                type="submit"
                class="w-full bg-primary text-white py-2.5 rounded-md font-semibold hover:bg-opacity-90 transition shadow"
            >
                Agregar administrador
            </button>
        </form>
    </div>
</div>
@endsection
