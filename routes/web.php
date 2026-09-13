<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ProfileController;

// Home siswa pengunjung //
Route::get('/', function () {return view('home');})->name('home');
// Menampilkan halaman login //
Route::get('/login', function () {return view('auth.login');})->name('login');
// Proses login //
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
// Logout //
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//Simpan kunjungan siswa//
Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
// admin dashboard //
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');
// Admin //
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

// Menampilkan semua data kunjungan //
Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
// Detail kunjungan //
Route::get('/kunjungan/{id}', [KunjunganController::class, 'show'])->name('kunjungan.show');
// Hapus kunjungan //
Route::delete('/kunjungan/{id}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');

// Halaman arsip //
Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
// Detail arsip berdasarkan TAHUN dan BULAN //
Route::get('/arsip/{tahun}/{bulan}', [ArsipController::class, 'show'])->name('arsip.show');
// Data pengunjung berdasarkan TAHUN dan BULAN //
Route::get('/arsip/{tahun}/{bulan}/pengunjung', [ArsipController::class, 'pengunjung'])->name('arsip.pengunjung');

// Halaman ubah profile //
Route::get('/profile', [ProfileController::class, 'edit']) ->name('profile.edit');
// Proses ubah profile //
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});