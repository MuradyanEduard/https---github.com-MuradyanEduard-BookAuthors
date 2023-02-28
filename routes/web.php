<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckOrder;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::resource('book', BookController::class);
    Route::resource('author', AuthorController::class);
    Route::post('/order/add', [OrderController::class, 'add'])->name('order.add');
    Route::post('/order/remove', [OrderController::class, 'remove'])->name('order.remove');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index')->middleware(CheckOrder::class);
});

// Route::get('/{any}', function () {
//     return view('layouts.vue');
// })->where('any', '.*');
