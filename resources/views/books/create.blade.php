<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Libro</title>
    <style>
        form { max-width: 600px; margin: 20px 0; }
        div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px;}
        input, select, textarea { width: 100%; padding: 8px; }
        button { padding: 10px 20px; cursor: pointer; background-color: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>

    <h1>Registrar Nuevo Libro</h1>

    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label>Título:</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label>ISBN:</label>
            <input type="text" name="isbn" value="{{ old('isbn') }}" required>
        </div>

        <div>
            <label>Autor:</label>
            <input type="text" name="author" value="{{ old('author') }}" required>
        </div>

        <div>
            <label>Editorial (Publisher):</label>
            <input type="text" name="publisher" value="{{ old('publisher') }}">
        </div>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label>Edición:</label>
                <input type="text" name="edition" value="{{ old('edition') }}">
            </div>
            <div style="flex: 1;">
                <label>Año Publicación:</label>
                <input type="number" name="publication_year" value="{{ old('publication_year') }}">
            </div>
        </div>

        <div>
            <label>Materia:</label>
            <input type="text" name="subject" value="{{ old('subject') }}">
        </div>

        <div>
            <label>Nivel Educativo:</label>
            <input type="text" name="educational_level" value="{{ old('educational_level') }}">
        </div>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label>Precio:</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
            </div>
            <div style="flex: 1;">
                <label>Stock:</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required>
            </div>
        </div>

        <div>
            <label>Estado (Activo):</label>
            <select name="is_active">
                <option value="1" selected>Sí, Activo</option>
                <option value="0">No, Inactivo</option>
            </select>
        </div>

        <div>
            <label>URL Imagen de Portada:</label>
            <input type="text" name="cover_image" placeholder="http://ejemplo.com/imagen.jpg" value="{{ old('cover_image') }}">
        </div>

        <div>
            <label>Descripción:</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <button type="submit">Guardar Libro</button>
    </form>
    
    <a href="{{ route('books.index') }}">Volver al listado</a>

</body>
</html>