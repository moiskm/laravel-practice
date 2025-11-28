<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookResourceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/book-resources', [BookResourceController::class, 'index']);
Route::post('/book-resources', [BookResourceController::class, 'store']);
Route::delete('/book-resources/{bookResource}', [BookResourceController::class, 'destroy']);
Route::get('/book-resources/{bookResource}', [BookResourceController::class, 'show']);
Route::put('/book-resources/{bookResource}', [BookResourceController::class, 'update']);
Route::patch('/book-resources/{bookResource}', [BookResourceController::class, 'update']);

