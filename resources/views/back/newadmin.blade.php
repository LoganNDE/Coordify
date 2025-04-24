@extends('_partials.layout')
@section('titlePage', 'Agregar administrador')

@section('content')
  <div class="p-5 flex gap-3 flex-col w-[85%] lg:w-4/6 h-full justify-center">
    <section>
  <div
    class="flex bg-white items-center justify-center px-4 py-10 sm:px-6 sm:py-16 lg:px-8 lg:py-8">
    <div class="xl:mx-auto xl:w-full shadow-md p-4 xl:max-w-sm 2xl:max-w-md">
      <div class="mb-2 flex justify-center"></div>
      <h2 class="text-center text-2xl font-bold leading-tight text-black">
        Agregar nuevo administrador
      </h2>
      <form class="mt-8" method="POST" action="{{ route('events.newadmin') }}">
        @csrf
        <div class="space-y-5">
          <div>
            <label class="text-base font-medium text-gray-900">
              Nombre
            </label>
            @error('name')
              <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mt-2">
              <input
                placeholder="Carlos"
                type="text"
                class="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                name="name"
                />
            </div>
          </div>
        <div class="space-y-5">
          <div>
            <label class="text-base font-medium text-gray-900">
              Correo
            </label>
            @error('email')
              <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mt-2">
              <input
                placeholder="example@example.com"
                type="email"
                class="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                name="email"
                />
            </div>
          </div>
          <div>
            <button
              class="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-2.5 font-semibold leading-7 text-white hover:bg-black/80"
              type="submit"
            >
              Agregar
            </button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>

@endsection