<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordify | @yield('titlePage')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if (auth()->check())
        <script>
                const mylocalstorage = window.localStorage;
                mylocalstorage.setItem('csrf_token', "{{ csrf_token() }}");
        </script>    
    @endif
    <div class="flex flex-col items-center justify-center w-full lg:max-h-[90%] lg:h-[90%]">
        @yield('content')
    </div>
    <div class="w-full flex justify-center sticky bottom-0 lg:bottom-10">
        <nav class="navContainer px-10 lg:mt-4 rounded-3xl bg-gray-100 lg:min-h-18 min-h-16">
            <div class="flex w-full justify-center gap-8 md:gap-10 lg:gap-15 items-center h-full">
            <a href="{{ route('events.index') }}"><img src="{{ asset('img/home.svg') }}" class="lg:w-10 lg:h-10 min-w-8 h-8" alt="home"></a>
            <!-- Por que tengo que poner min-w para que me funcione -->
            <a href=""><img src="{{ asset('img/menu.svg') }}" class="lg:w-10 lg:h-10 min-w-8 h-8" alt=""></a>
            <a href=""><img src="{{ asset('img/history.svg') }}" class="lg:w-10 lg:h-10 min-w-8 h-8" alt=""></a>
            <a href="{{ route('events.settings') }}"><img src="{{ asset('img/setting.svg') }}" class="lg:w-10 lg:h-10 min-w-8 h-8" alt="settings"></a>
            <a href="{{ route('logout') }}"><img src="{{ asset('img/exit.svg') }}" class="lg:w-10 lg:h-10 min-w-8 h-8" alt="logout" id="logout"></a>
        </nav>
    </div>
</body>
</html>