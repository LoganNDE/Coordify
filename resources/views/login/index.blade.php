@extends('_partials.layout-login')
@section('titlePage', 'Login')

@section('content')
    <div class="main w-full lg:w-4/6 h-11/12 flex flex-col justify-center gap-5">
  <div
    class="flex bg-white items-center justify-center sm:px-6 sm:py-16 lg:px-8 lg:py-8"
  >
    <div class="xl:mx-auto xl:w-full shadow-md p-4 xl:max-w-sm 2xl:max-w-md">
      <div class="mb-2 flex justify-center"></div>
      <h2 class="text-center text-2xl font-bold leading-tight text-black">
        Bienvenido a Coordify
      </h2>
      @if(session('error'))
        <script>
            console.log("{{ session('error') }}");
            const mylocalStorage = window.localStorage;
            mylocalStorage.setItem('laravelError', "{{ session('error') }}");
          </script>
      @endif
      <form class="mt-8" method="POST" action="{{ route('checkLogin') }}">
        @csrf
        <div class="space-y-5">
          <div>
            <label class="text-base font-medium text-gray-900">
              Correo | Usuario
            </label>
            @error('name')
              <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mt-2">
              <input
                placeholder="example@example.com"
                type="text"
                class="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                name="name"
                />
            </div>
          </div>
          <div>
            <div class="flex lg:items-center flex-col lg:flex-row lg:justify-between">
              <label class="text-base font-medium text-gray-900">
                Contraseña
              </label>
              <a
                class="text-sm font-semibold text-black hover:underline"
                title=""
                href="#"
              >
                ¿Olvidaste tu contraseña?
              </a>
            </div>
            @error('password')
              <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <div class="mt-2">
              <input
                placeholder="*********"
                type="password"
                class="flex h-10 w-full rounded-md border border-gray-300 text-base bg-transparent px-3 py-2 placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                name="password"
                />
            </div>
          </div>
          <div>
            <button
              class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-2.5 font-semibold leading-7 text-white hover:bg-black/80"
              type="submit"
            >
              Comenzar
            </button>
          </div>
        </div>
      </form>
      <div class="mt-3 space-y-3">
        <button
          class="relative inline-flex w-full items-center justify-center rounded-md border border-gray-400 bg-white px-3.5 py-2.5 font-semibold text-gray-700 transition-all duration-200 hover:bg-gray-100 hover:text-black focus:bg-gray-100 focus:text-black focus:outline-none"
          type="button"
        >
          <span class="mr-2 inline-block">
            <svg
              fill="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6 text-rose-500"
            >
              <path
                d="M20.283 10.356h-8.327v3.451h4.792c-.446 2.193-2.313 3.453-4.792 3.453a5.27 5.27 0 0 1-5.279-5.28 5.27 5.27 0 0 1 5.279-5.279c1.259 0 2.397.447 3.29 1.178l2.6-2.599c-1.584-1.381-3.615-2.233-5.89-2.233a8.908 8.908 0 0 0-8.934 8.934 8.907 8.907 0 0 0 8.934 8.934c4.467 0 8.529-3.249 8.529-8.934 0-.528-.081-1.097-.202-1.625z"
              ></path>
            </svg>
          </span>
          Sign in with Google
        </button>
        <div class="flex justify-between">
          <a class="flex justify-start hover:underline" href="{{ route('admin.checklogin') }}">Soy administrador</a>
          <a class="flex justify-start hover:underline" href="{{ route('user.register') }}">¿Aún no tienes cuenta?</a>
        </div>
      </div>
    </div>
  </div>
</section>

    </div>
@endsection