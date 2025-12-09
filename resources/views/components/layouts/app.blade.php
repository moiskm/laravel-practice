<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel + Livewire</title>

    @livewireStyles
</head>

<body style="background:#f4f4f4; padding:40px;">

    {{ $slot }}

    @livewireScripts
</body>
</html>
