<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth:admin,dosen,mahasiswa')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});

Route::middleware('auth:mahasiswa', 'disable.back')->group(function () {

    Route::get('jadwal-kuliah', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
    Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');

    Route::get('masuk/kelas/{kelas}', [KelasController::class, 'masuk'])->name('kelas.masuk');
    Route::post('masuk/kelas/absen', [KelasController::class, 'absen'])->name('absen');
});
