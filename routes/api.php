<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/book', [BookController::class, 'index']);
    Route::post('/book/store', [BookController::class, 'store']);
    Route::post('/book/update', [BookController::class, 'update']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Route::POST('/login', 'API\LoginController@login');
// Route::POST('/register', 'API\RegisterController@register');
