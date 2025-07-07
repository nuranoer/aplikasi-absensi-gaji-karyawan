<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\PerizinanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SlipGajiController;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/', [DashboardController::class, fn()=>view('admin.dashboard')])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

    Route::resource('karyawan', KaryawanController::class)->names('admin.karyawan');

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('admin.absensi');
    Route::post('/absensi/{id}/approve', [AbsensiController::class, 'approve'])->name('admin.absensi.approve');
    Route::post('/absensi/{id}/reject', [AbsensiController::class, 'reject'])->name('admin.absensi.reject');
    
    Route::get('/perizinan', [PerizinanController::class, 'index'])->name('admin.perizinan');
    Route::post('/perizinan/{id}/approve', [PerizinanController::class, 'approve'])->name('admin.perizinan.approve');
    Route::post('/perizinan/{id}/reject', [PerizinanController::class, 'reject'])->name('admin.perizinan.reject');


    Route::get('/slip', [SlipGajiController::class, 'index'])->name('admin.slip');
    Route::post('/slip', [SlipGajiController::class, 'store'])->name('admin.slip.store');
    Route::put('/slip/{id}', [SlipGajiController::class, 'update'])->name('admin.slip.update');
    Route::delete('/slip/{id}', [SlipGajiController::class, 'destroy'])->name('admin.slip.destroy');
    Route::get('/slip/cetak', [SlipGajiController::class, 'cetak'])->name('admin.slip.cetak');
});