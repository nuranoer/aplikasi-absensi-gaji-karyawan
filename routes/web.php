<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SlipGajiController;
use App\Http\Controllers\KaryawanAuthController;
use App\Http\Controllers\AbsensiKameraController;


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

// FORM login karyawan
Route::get('/login/karyawan', [KaryawanAuthController::class, 'showLoginForm'])->name('karyawan.login');

// POST login karyawan
Route::post('/login/karyawan', [KaryawanAuthController::class, 'login']);

// Logout karyawan
Route::post('/logout/karyawan', [KaryawanAuthController::class, 'logout'])->name('karyawan.logout');

// Dashboard khusus karyawan, pakai guard 'karyawan'
Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard_auth', function () {
        return view('dashboard_2');
    })->name('dashboard.karyawan');
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/absensi/kamera', [AbsensiKameraController::class, 'index'])->name('absensi.kamera');
    Route::post('/absensi/kamera', [AbsensiKameraController::class, 'store'])->name('absensi.kamera.store');
});





require __DIR__.'/auth.php';
