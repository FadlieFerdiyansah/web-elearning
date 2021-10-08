<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController;
use App\Http\Controllers\Mahasiswa\KelasController;
use Illuminate\Support\Facades\Auth;

Auth::routes();


Route::middleware('auth:mahasiswa', 'disable.back')->group(function () {
    Route::prefix('user')->get('dashboard', DashboardController::class)->name('dashboard.mahasiswa');

    Route::get('jadwal-kuliah', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
    Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');

    Route::get('masuk/kelas/{kelas}', [KelasController::class, 'masuk'])->name('mahasiswa.masukKelas');
    Route::post('kelas/absen', [KelasController::class, 'absen'])->name('absen');
    Route::get('materi/{jadwal}', [KelasController::class, 'materi'])->name('materi.mhs');
});
