<?php

use App\Http\Controllers\Karyawan\AbsensiController;
use App\Http\Controllers\Karyawan\AuthController;
use App\Http\Controllers\Karyawan\DashboardController;
use App\Http\Controllers\Karyawan\SlipGajiController;

Route::prefix('login')->group(function () {
    Route::get('/karyawan', [AuthController::class, 'showLoginForm'])->name('karyawan.login');
    Route::post('/karyawan', [AuthController::class, 'login'])->name('karyawan.login.process');
});

// Dashboard khusus karyawan, pakai guard 'karyawan'
Route::middleware(['auth:karyawan'])->group(function () {
    // Logout karyawan
    Route::post('/logout/karyawan', [AuthController::class, 'logout'])->name('karyawan.logout');

    Route::prefix('karyawan')->group(function () {
        // Route::get('/', [DashboardController::class, 'index'])->name('karyawan.dashboard');
        Route::get('/', [DashboardController::class, fn() => view('karyawan.dashboard')])->name('karyawan.dashboard');

        Route::get('/absensi', [AbsensiController::class, 'history'])->name('karyawan.absensi');
        Route::get('/absensi/pengajuan', [AbsensiController::class, 'index'])->name('karyawan.absensi.pengajuan');
        Route::post('/absensi/pengajuan', [AbsensiController::class, 'store'])->name('karyawan.absensi.pengajuan.store');
        Route::get('/kamera', [AbsensiController::class, 'kamera'])->name('karyawan.absensi.kamera');
        Route::post('/kamera', [AbsensiController::class, 'absen'])->name('karyawan.absensi.kamera.store');

        Route::get('/slip', [SlipGajiController::class, 'index'])->name('karyawan.slip');
        Route::get('/slip/cetak', [SlipGajiController::class, 'cetak'])->name('karyawan.slip.cetak');
    });
});