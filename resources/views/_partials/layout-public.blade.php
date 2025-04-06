<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordify | @yield('titlePage')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="w-full h-[100px] flex justify-center items-center">
        <div class="w-[80%] flex justify-between">
            <div>Coordify</div>
            <div>
                <a class=" px-6 rounded-full py-3 bg-primary text-smoke" href="{{ route('events.index') }}">Crear evento</a>
            </div>
        </div>
    </header>
    @yield('content')
</body>
</html>