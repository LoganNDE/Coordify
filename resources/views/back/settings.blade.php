@extends('_partials.layout')
@section('titlePage', 'Configuración')

@section('content')
    <div class="p-5 flex gap-3 flex-col w-[85%] lg:w-4/6 mt-8"> 
        <div class="settingsContainer bg-gray-100 w-full p-6 rounded-lg">
            <h1 class="text-2xl">Configuración</h1>
            @if (session('success'))
                <script>
                    const mylocalstorage = window.localStorage;
                    mylocalstorage.setItem('successLaravel', "{{ session('success') }}");
                </script> 
            @elseif (session('error'))
                <script>
                    console.log("{{ session('error') }}");
                    mylocalstorage = window.localStorage;
                    mylocalstorage.setItem('laravelError', "{{ session('error') }}");
                </script>
            @endif
            <form enctype="multipart/form-data" action="{{ route('user.updateDetails') }}" method="post">
                @csrf
                <div class="relative flex w-full flex-col justify-center items-center p-5">
                <!-- Imagen de perfil -->
                    <label for="profile-image" class="cursor-pointer">
                        <img id="profile-preview" 
                            class="w-32 h-32 rounded-full object-cover object-top border-2 border-gray-300 hover:opacity-80" 
                            src="{{ isset(auth()->user()->image) ? Storage::url(auth()->user()->image) : '/img/default.png'  }}" 
                            alt="Foto de perfil">
                    </label>
                    @error('image')
                            <span class="mt-3 block text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <!-- Input oculto para subir la imagen -->
                    <input type="file" id="profile-image" name="image" accept="image/*" class="hidden">
                </div>
                <!-- Usuario y Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-3 mt-4">
                    <div>
                        <label class="flex justify-between text-gray-700 mb-2" for="userSettings">
                        Usuario
                        @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        </label>

                        <input type="text" id="userSettings" name="name" class="bg-white p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ auth()->user()->name }}">
                    </div>
                    <div>
                        <label class="flex justify-between text-gray-700 mb-2" for="emailSettings">
                        Email
                        @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        </label>
                        <input type="email" id="emailSettings" name="email" class="bg-white p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ auth()->user()->email }}">
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Confirmar
                    </button>
                </div>
            </form>
            <div class="containerChangePassword py-5">
                <form action="{{ route('user.updatePassword') }}" method="POST">
                    @csrf
                    <!-- Contraseñas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-3 mt-8">
                        <div>
                            <label class="flex justify-between text-gray-700 mb-2" for="newPassword">
                            Nueva contraseña
                            @error('newPassword')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            </label>
                            <input type="password" id="newPassword" name="newPassword"
                                    class="bg-white p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="flex justify-between text-gray-700 mb-2" for="confirmNewPassword">
                            Repetir contraseña
                            @error('confirmNewPassword')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            </label>
                            <input type="password" id="confirmNewPassword" name="confirmNewPassword"
                                    class="bg-white p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            Cambiar contraseña
                        </button>
                    </div>
                </form>

                @if (auth()->user()->stripe_subscription_id)
                <div class="containerSubscription py-5"></div>
                    <h2 class="text-xl font-bold">Administrar suscripción</h2>

                    <p class="pr-2">El upgrade de suscripciones esta en desarrollo. Si deseas cambiar de plan a uno superior o inferior, puedes contactar con soporte y te ayudaremos.</p>
                    <div class="flex mt-4 gap-5">
                        <a class="px-4 py-2 bg-primary text-secundary rounded-lg" href="">Contacar</a>
                        <a class="px-4 py-2 bg-red-200 text-red-800 rounded-lg" href="{{ route('subscription.cancel') }}">Cancelar suscripción</a>
                    </div>
                    
                @endif
            </div>
        </div>
    </div>

@endsection