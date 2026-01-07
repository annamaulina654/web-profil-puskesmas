<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Halaman Dashboard (Hanya bisa diakses kalau sudah login)
Route::get('/dashboard', function () {
    return '<h1>Halo Admin! Anda berhasil login.</h1> <a href="/logout">Logout</a>';
})->middleware('auth');

// Proses Logout
Route::get('/logout', [AuthController::class, 'logout']);
