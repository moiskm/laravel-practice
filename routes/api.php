<?php

//use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookResourceController;

//---------------------------------------------------------
use App\Http\Controllers\BookChapterController;
use App\Http\Controllers\BookController;


Route::get('/book-resources', [BookResourceController::class, 'index']);
Route::post('/book-resources', [BookResourceController::class, 'store']);
Route::delete('/book-resources/{bookResource}', [BookResourceController::class, 'destroy']);
Route::get('/book-resources/{bookResource}', [BookResourceController::class, 'show']);
Route::put('/book-resources/{bookResource}', [BookResourceController::class, 'update']);
Route::patch('/book-resources/{bookResource}', [BookResourceController::class, 'update']);

//---------------------------------------------------------
Route::get('/book-chapters', [BookChapterController::class, 'index']);
Route::post('/book-chapters', [BookChapterController::class, 'store']);
Route::delete('/book-chapters/{bookChapter}', [BookChapterController::class, 'destroy']);
Route::get('/book-chapters/{bookChapter}', [BookChapterController::class, 'show']);
Route::put('/book-chapters/{bookChapter}', [BookChapterController::class, 'update']);
Route::patch('/book-chapters/{bookChapter}', [BookChapterController::class, 'update']);

//---------------------------------------------------------


Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::put('/books/{book}', [BookController::class, 'update']);
Route::patch('/books/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);
