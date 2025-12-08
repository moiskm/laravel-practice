<?php

use App\Http\Controllers\BookResourceController;
use App\Models\BookResource;
use Illuminate\Support\Facades\Route;

// pagina de inicio
Route::get('/', function () {
    return view('home');
})->name('home');

// Rutas web para BookResource (vista + formulario)
Route::prefix('book-resources')->group(function () {
   
    Route::get('/', function () {
        $resources = BookResource::with('book')->get();
        return view('book_resources.index', compact('resources'));
    })->name('book-resources.index');

    // Formulario usando Livewire
    Route::get('/create', function () {
        return view('book_resources.form');
    })->name('book-resources.create');

    // API endpoints
    Route::post('/', [BookResourceController::class, 'store'])->name('book-resources.store');
    Route::delete('/{bookResource}', [BookResourceController::class, 'destroy'])->name('book-resources.destroy');
});
