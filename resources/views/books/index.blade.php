<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de libros</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2;}
        .btn-delete { background-color: #ff4d4d; color: white; border: none; padding: 5px 10px; cursor: pointer;}
    </style>
</head>
<body>
    <h1>gestion de libros</h1>

    @if(session('success'))
        <p style="color: green; font-weight: bold;"> {{session('success')}}</p>
    @endif

    <a href="{{ route('books.create')}}">Creando nuevo libro</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>ISBN</th>
                <th>Autor</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ number_format($book->price, 2) }}</td>
                <td>{{ $book->stock }}</td>
                <td>{{ $book->is_active ? 'Activo' : 'inactivo'}}</td>
                <td>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Eliminar este libro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>