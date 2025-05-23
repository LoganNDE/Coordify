<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordify | @yield('titlePage')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if(session('success'))
        <script>
            console.log("{{ session('success') }}");
            mylocalStorage = window.localStorage;
            mylocalStorage.setItem('successLaravel', "{{ session('success') }}");
        </script>
    @endif
    @if(session('error'))
        <script>
            mylocalStorage = window.localStorage;
            mylocalStorage.setItem('laravelError', "{{ session('error') }}");
        </script>
    @endif
    <div class="flex flex-col items-center justify-center h-[100vh]">
        @yield('content')
    </div>
</body>
</html>