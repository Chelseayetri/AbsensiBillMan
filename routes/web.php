<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;

// ================= HOME =================
Route::get('/', function () {
    return redirect()->route('login');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:web');

// ================= PETUGAS =================
Route::middleware(['auth:web', 'cekperan:Petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');
        Route::get('/absen', [AbsensiController::class, 'formAbsen'])->name('absen');
        Route::post('/absen', [AbsensiController::class, 'simpanAbsen'])->name('simpan');
        Route::get('/riwayat', [AbsensiController::class, 'riwayatPetugas'])->name('riwayat');
    });

// ================= ADMIN =================
Route::middleware(['auth:web', 'cekperan:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/monitoring', [AbsensiController::class, 'monitoring'])->name('monitoring');
        Route::post('/kontrol-absen', [AbsensiController::class, 'bukaTutup'])->name('kontrol');
        Route::get('/export', [AbsensiController::class, 'exportExcel'])->name('export');
    });