@extends('layout.app')
@section('head')
    <meta charset="UTF-8">
    <title>Editar Libro</title>
    <style>
        form { max-width: 600px; margin: 20px 0; }
        div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px;}
        input, select, textarea { width: 100%; padding: 8px; }
        button { padding: 10px 20px; cursor: pointer; background-color: #4CAF50; color: white; border: none; }
    </style>

@endsection


@section('content')
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

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Título:</label>
            <input class="form-control" type="text" name="title" value="{{ old('title', $book->title) }}" required>
        </div>

        <div class="row g-3">
            <div class="mb-3 col-md-6">
                <label class="form-label">ISBN:</label>
                <input class="form-control" type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Autor:</label>
                <input class="form-control" type="text" name="author" value="{{ old('author', $book->author) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Editorial (Publisher):</label>
            <input class="form-control" type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}">
        </div>

        <div  class="mb-3" style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label class="form-label">Edición:</label>
                <input class="form-control" type="text" name="edition" value="{{ old('edition', $book->edition) }}">
            </div>
            <div style="flex: 1;">
                <label class="form-label">Año Publicación:</label>
                <input class="form-control" type="number" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}">
            </div>
        </div>
        <div class="row g-3">
            <div class="mb-3 col-md-6">
                <label class="form-label">Materia:</label>
                <input class="form-control" type="text" name="subject" value="{{ old('subject', $book->subject) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label">Nivel Educativo:</label>
                <input class="form-control" type="text" name="educational_level" value="{{ old('educational_level', $book->educational_level) }}">
            </div>
        </div>

        <div class="mb-3" style="display: flex; gap: 10px;">
            <div style="flex: 1;">
            <label class="form-label">Precio:</label>
            <input class="form-control" type="number" step="0.01" name="price" value="{{ old('price', $book->price) }}" required>
            </div>
            <div style="flex: 1;">
            <label class="form-label">Stock:</label>
            <input class="form-control" type="number" name="stock" value="{{ old('stock', $book->stock) }}" required>
            </div>
        </div>

        <div class="row g-3">
            <div class="mb-3 col-md-3">
                <label class="form-label">Estado:</label>
                <select class="form-select" name="is_active">
                <option value="1" {{ old('is_active', $book->is_active) == 1 ? 'selected' : '' }}>Sí, Activo</option>
                <option value="0" {{ old('is_active', $book->is_active) == 0 ? 'selected' : '' }}>No, Inactivo</option>
                </select>
            </div>

            <div class="mb-3 col-md-9" >
                <label class="form-label">URL Imagen de Portada:</label>
                <input class="form-control" type="text" name="cover_image" value="{{ old('cover_image', $book->cover_image) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea class="form-control" name="description" rows="4">{{ old('description', $book->description) }}</textarea>
        </div>
    <div class="d-flex gap-2">
        <button class="btn btn-primary"type="submit">Actualizar Libro</button>
        <a class="btn btn-danger" href="{{ route('books.index') }}">Cancelar y Volver</a>
    </div>
    </form>
    

@endsection