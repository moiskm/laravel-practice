<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Vite (assets JS/CSS) --}}
    @if (function_exists('vite'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="/build/assets/app.css">
        <script src="/build/assets/app.js" defer></script>
    @endif


    {{-- Livewire styles --}}
    @livewireStyles

    <style>
        /* estilos mínimos */
        body { font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; margin: 0; padding: 0; }
        .container { max-width: 960px; margin: 24px auto; padding: 0 16px; }
        .nav { background:#0d6efd; color:#fff; padding:12px 0; }
        .nav a { color:#fff; margin-left:12px; text-decoration:none }
        .flash { padding:12px; background:#d1e7dd; border:1px solid #badbcc; color:#0f5132; margin-bottom:12px; }
    </style>
</head>
<body>
    <header class="nav">
        <div class="container">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ url('/book-resources') }}">Recursos</a>
        </div>
    </header>

    <main class="container">
        {{--
            Mensajes flash (ej. confirmaciones de guardado)

            - Usa `session()->flash('message', '...')` en controladores o componentes para mostrar
              una notificación simple en la parte superior de la página.
            - Estilo mínimo ya definido arriba en el `head`.
        --}}
        {{-- Mensajes flash --}}
        @if (session()->has('message'))
            <div class="flash">{{ session('message') }}</div>
        @endif

        {{-- Contenido principal --}}
        @yield('content')
    </main>

    {{-- Livewire scripts (si está instalado) --}}
    @livewireScripts

</body>
</html>
