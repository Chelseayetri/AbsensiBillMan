<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;

/*
|--------------------------------------------------------------------------
| ROUTE UMUM
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login-test');
})->name('login');


/*
|--------------------------------------------------------------------------
| ROUTE PETUGAS
| sementara TANPA auth & cekperan
|--------------------------------------------------------------------------
| Tujuan: supaya halaman petugas bisa dilihat dulu
| Auth & middleware akan dipasang lagi nanti
*/

// ❌ COMMENT DULU middleware auth & cekperan
// Route::middleware(['auth', 'cekperan:petugas'])->group(function () {

    // ✅ TAMBAH route dashboard (ini yang bikin 404 kemarin)
    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');

    // ⚠️ SESUAIKAN dengan NAMA METHOD di controller kamu
    Route::get('/petugas/absen', [AbsensiController::class, 'formAbsen'])
        ->name('petugas.absen');

    Route::post('/petugas/absen', [AbsensiController::class, 'simpanAbsen'])
        ->name('petugas.absen.store');

    Route::get('/petugas/riwayat', [AbsensiController::class, 'riwayatPetugas'])
        ->name('petugas.riwayat');

// }); // ❌ COMMENT DULU
