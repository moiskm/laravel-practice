@extends('layouts.app')

{{--
    Vista: home.blade.php
--}}

@section('content')
    <div style="padding:1rem;">
        <h1>Bienvenidos</h1>
        <p>Accede a los recursos de libros desde el siguiente enlace:</p>
        <a href="{{ route('book-resources.index') }}">Ver recursos</a>
    </div>
@endsection
