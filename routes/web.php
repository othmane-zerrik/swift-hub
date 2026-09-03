<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Models\Client;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'clientsCount' => Client::count(),
    ]);
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class)
        ->only(['index', 'store', 'update', 'destroy']);
})->middleware('auth');
 