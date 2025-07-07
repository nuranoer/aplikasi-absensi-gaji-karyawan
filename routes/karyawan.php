<?php

use App\Http\Controllers\Karyawan\AbsensiController;
use App\Http\Controllers\Karyawan\AuthController;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Karyawan\PerizinanController;
use App\Http\Controllers\Karyawan\RiwayatController;
use App\Http\Controllers\Karyawan\SlipGajiController;

Route::prefix('login')->middleware('guest.karyawan')->group(function () {
    Route::get('/karyawan', [AuthController::class, 'showLoginForm'])->name('karyawan.login');
    Route::post('/karyawan', [AuthController::class, 'login'])->name('karyawan.login.process');
});

Route::middleware(['auth.karyawan'])->group(function () {
    // Logout karyawan
    Route::post('/logout/karyawan', [AuthController::class, 'logout'])->name('karyawan.logout');

    Route::prefix('karyawan')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('karyawan.dashboard');
        // Route::get('/', [DashboardController::class, fn() => view('karyawan.dashboard')])->name('karyawan.dashboard');

        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('karyawan.riwayat');
        Route::get('/riwayat/perizinan', [RiwayatController::class, 'perizinan'])->name('karyawan.riwayat.perizinan');

        Route::get('/perizinan', [PerizinanController::class, 'index'])->name('karyawan.perizinan');
        Route::post('/perizinan', [PerizinanController::class, 'store'])->name('karyawan.perizinan.store');

        Route::get('/absensi', [AbsensiController::class, 'index'])->name('karyawan.absensi');
        Route::post('/absensi', [AbsensiController::class, 'store'])->name('karyawan.absensi.store');

        Route::get('/slip', [SlipGajiController::class, 'index'])->name('karyawan.slip');
        Route::get('/slip/cetak', [SlipGajiController::class, 'cetak'])->name('karyawan.slip.cetak');
    });
});