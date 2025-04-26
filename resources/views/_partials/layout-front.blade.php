<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordify | @yield('titlePage')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    <header class="w-full min-h-[100px] flex justify-center items-center">
        <div class="w-[90%] lg:w-[80%] flex justify-between">
            <div class="w-[50%] lg:w-[30%]">
                <a href="{{ route('front.index') }}">
                    <img class="w-[150px]" src="{{ asset('img/logos/coordify.svg') }}" alt="Coordify"></img>
                </a>
            </div>
            <div class="flex justify-end lg:justify-between items-end w-[50%] lg:w-[70%]">
                <ul class="hidden lg:flex gap-10 items-center">
                    <li><a class="text-lg hover:text-primary hover:scale-110 transition-all duration-350 inline-block" href="{{ route('front.index') }}">Inicio</a></li>
                    <li><a class="text-lg hover:text-primary hover:scale-110 transition-all duration-350 inline-block" href="{{ route('front.tickets') }}">Mis entradas</a></li>
                    <li><a class="text-lg hover:text-primary hover:scale-110 transition-all duration-350 inline-block" href="{{ route('front.subscriptions') }}">Suscripciones</a></li>
                    <li><a class="text-lg hover:text-primary hover:scale-110 transition-all duration-350 inline-block" href="">Perfil</a></li>
                    <li><a class="text-lg hover:text-primary hover:scale-110 transition-all duration-350 inline-block" href="{{ route('events.settings') }}">Ajustes</a></li>
                </ul>
                <a class="px-6 rounded-full py-2 bg-primary text-secundary font-medium" href="{{ route('events.index') }}">Mis eventos</a>
            </div>
        </div>
    </header>
    <main class="flex-grow flex justify-center">
        @yield('content')
    </main>
    
    <div class="w-full flex lg:hidden justify-center sticky bottom-5 lg:bottom-10">
        <nav class="navContainer px-6 lg:mt-4 rounded-3xl bg-gray-100 lg:min-h-18 min-h-16">
            <div class="flex w-full justify-center gap-8 md:gap-10 lg:gap-15 items-center h-full">
            <a href="{{ route('events.index') }}"><img src="{{ asset('img/home.svg') }}" class="min-w-10 h-10" alt="home"></a>
            <!-- Por que tengo que poner min-w para que me funcione -->
            <a href="{{ route('front.index') }}"><img src="{{ asset('img/menu.svg') }}" class="min-w-10 h-10" alt=""></a>
            <a href=""><img src="{{ asset('img/menu/camera.svg') }}" class="min-w-10 h-10" alt=""></a>
            <a href="{{ route('events.settings') }}"><img src="{{ asset('img/setting.svg') }}" class="min-w-10 h-10" alt="settings"></a>
            <a href="{{ route('logout') }}"><img src="{{ asset('img/exit.svg') }}" class="min-w-10 h-10" alt="logout" id="logout"></a>
        </nav>
    </div>

    <footer class="bg-black min-h-[5vh] flex justify-center items-center">
        <p class="text-white">Desarrollado por Logan Naranjo</p>
    </footer>
</body>
</html>