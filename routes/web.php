<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipController;


/*
|--------------------------------------------------------------------------
| HOME SISWA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

// Menampilkan halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// Proses login
Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');


// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| SIMPAN KUNJUNGAN SISWA
|--------------------------------------------------------------------------
*/

Route::post('/kunjungan', [KunjunganController::class, 'store'])
    ->name('kunjungan.store');


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DATA KUNJUNGAN
        |--------------------------------------------------------------------------
        */

        // Menampilkan semua data kunjungan
        Route::get('/kunjungan', [KunjunganController::class, 'index'])
            ->name('kunjungan.index');


        // Detail kunjungan
        Route::get('/kunjungan/{id}', [KunjunganController::class, 'show'])
            ->name('kunjungan.show');


        // Hapus kunjungan
        Route::delete('/kunjungan/{id}', [KunjunganController::class, 'destroy'])
            ->name('kunjungan.destroy');


        /*
        |--------------------------------------------------------------------------
        | ARSIP KUNJUNGAN
        |--------------------------------------------------------------------------
        */

        // Halaman arsip
        Route::get('/arsip', [ArsipController::class, 'index'])
            ->name('arsip.index');


        // Detail arsip berdasarkan minggu
        Route::get('/arsip/{tanggal}', [ArsipController::class, 'show'])
            ->name('arsip.show');

    });
