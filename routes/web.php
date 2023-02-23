<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => false]);

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [BookController::class, 'index']);
    Route::resource('book', BookController::class);
    Route::resource('author', AuthorController::class);
});

