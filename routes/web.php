<?php

use Illuminate\Support\Facades\Route;


use App\Livewire\Books\BooksList;
use App\Livewire\Books\BookShow;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/books', \App\Livewire\Books\BooksList::class)->name('books.list');
Route::get('/books/{book}', \App\Livewire\Books\BookShow::class)->name('books.show');









