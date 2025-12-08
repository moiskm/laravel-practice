@extends('layouts.app')

{{--
    Vista: book_resources/form.blade.php
    - Página que contiene exclusivamente el formulario Livewire para crear
      o editar un recurso. 
--}}

@section('content')
    <h1>Crear / Editar Recurso del Libro</h1>

    @livewire('book-resource-form')
@endsection
