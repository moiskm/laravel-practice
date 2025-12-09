<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Practice</title>

    @livewireStyles

    <style>
        body {
            background: #eef1f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
        }
    </style>
</head>

<body>
    <div class="container">

        <h1> Gestión de Libros</h1>



        <div class="center">
            <a href="{{ route('books.list') }}" class="btn">
                next
            </a>
        </div>

    </div>

    @livewireScripts
</body>
</html>
