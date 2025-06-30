<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SlipGajiController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('karyawan', KaryawanController::class);

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/{id}/approve', [AbsensiController::class, 'approve'])->name('absensi.approve');
    Route::post('/absensi/{id}/reject', [AbsensiController::class, 'reject'])->name('absensi.reject');

    Route::prefix('slip-gaji')->middleware('auth')->group(function () {
    Route::get('/', [SlipGajiController::class, 'index'])->name('slip-gaji.index');
    Route::patch('/approve/{id}', [SlipGajiController::class, 'approve'])->name('slip-gaji.approve');
    Route::get('/export/{id}', [SlipGajiController::class, 'exportPdf'])->name('slip-gaji.export');
    });

});



require __DIR__.'/auth.php';
