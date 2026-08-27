<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KunjunganController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/admin/kunjungan', [KunjunganController::class, 'index'])
    ->middleware('auth')
    ->name('admin.kunjungan.index');