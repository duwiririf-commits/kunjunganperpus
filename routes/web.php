<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ProfileController;

// halaman home untuk siswa/pengunjung
Route::get('/', function () {
    return view('home');
})->name('home');

// halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// proses login & logout
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// simpan kunjungan siswa
Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');

// dashboard admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');


// route khusus admin (perlu login)
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        // daftar & detail kunjungan
        Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
        Route::get('/kunjungan/{id}', [KunjunganController::class, 'show'])->name('kunjungan.show');
        Route::delete('/kunjungan/{id}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');

        // arsip kunjungan
        Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
        Route::get('/arsip/{tahun}/{bulan}', [ArsipController::class, 'show'])->name('arsip.show');
        Route::get('/arsip/{tahun}/{bulan}/pengunjung', [ArsipController::class, 'pengunjung'])->name('arsip.pengunjung');

        // ubah profile admin
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    });