<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\MasukanController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil/{kategori}', [HomeController::class, 'showProfil'])->name('public.profil');

Route::get('/layanan', [HomeController::class, 'indexLayanan'])->name('public.layanan');

Route::get('/informasi', [HomeController::class, 'indexInformasi'])->name('public.informasi');
Route::get('/informasi/{id}', [HomeController::class, 'showInformasi'])->name('public.informasi.show');

Route::get('/kontak', [HomeController::class, 'kontak'])->name('public.kontak');
Route::post('/kontak', [HomeController::class, 'kirimPesan'])->name('public.kirim_pesan');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('admin/profil', ProfilController::class);

    Route::resource('admin/layanan', LayananController::class);

    Route::resource('admin/informasi', InformasiController::class);

    Route::resource('admin/pesan', MasukanController::class)->only(['index', 'destroy']);

});