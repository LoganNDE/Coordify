@extends('_partials.layout-login')
@section('titlePage', 'Registro')

@section('content')
    <div class="main w-full lg:w-4/6 h-11/12 flex flex-col justify-center gap-5">
        <div class="flex bg-white items-center justify-center sm:px-6 sm:py-16 lg:px-8 lg:py-8">
            <div class="xl:mx-auto xl:w-full shadow-md p-4 xl:max-w-sm 2xl:max-w-md">
                <div class="mb-2 flex justify-center"></div>
                <h2 class="text-center text-2xl font-bold leading-tight text-black">
                    Crea tu cuenta en Coordify
                </h2>
                @if(session('error'))
                    <script>
                        const mylocalStorage = window.localStorage;
                        mylocalStorage.setItem('laravelError', "{{ session('error') }}");
                    </script>
                @endif
                <form class="mt-8" method="POST" action="{{ route('user.register') }}">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="text-base font-medium text-gray-900">Nombre de usuario</label>
                            @error('name')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <input
                                    type="text"
                                    name="name"
                                    placeholder="tuusuario"
                                    class="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="text-base font-medium text-gray-900">Correo electrónico</label>
                            @error('email')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <input
                                    type="email"
                                    name="email"
                                    placeholder="example@example.com"
                                    class="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="text-base font-medium text-gray-900">Contraseña</label>
                            @error('password')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <input
                                    type="password"
                                    name="password"
                                    placeholder="********"
                                    class="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="text-base font-medium text-gray-900">Repite la contraseña</label>
                            @error('verifyPassword')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <input
                                    type="password"
                                    name="verifyPassword"
                                    placeholder="********"
                                    class="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-base placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1"
                                />
                            </div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-2.5 font-semibold leading-7 text-white hover:bg-black/80"
                            >
                                Registrarse
                            </button>
                        </div>
                    </div>
                </form>
                <div class="mt-3 text-sm">
                    ¿Ya tienes cuenta? 
                    <a href="{{ route('login') }}" class="text-black font-semibold hover:underline">
                        Inicia sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
