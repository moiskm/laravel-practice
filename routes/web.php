<?php

use App\Http\Controllers\BookResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas CRUD para BookResource
Route::prefix('book-resources')->group(function () {
    Route::get('/', [BookResourceController::class, 'index'])->name('book-resources.index');
    Route::post('/', [BookResourceController::class, 'store'])->name('book-resources.store');
    Route::delete('/{bookResource}', [BookResourceController::class, 'destroy'])->name('book-resources.destroy');
});
