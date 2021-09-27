<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('', HomeController::class)->name('index');


Auth::routes();

Route::middleware('auth:mahasiswa', 'disable.back')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('permission:jadwal kuliahm|jadwal kuliahd')->group(function () {
        Route::get('jadwal-kuliah', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
        Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');

        Route::get('masuk/kelas/{kelas}', [KelasController::class, 'masuk'])->name('kelas.masuk');
        Route::post('masuk/kelas/absen', [KelasController::class, 'absen'])->name('absen');

        // Route::get('materi/{jadwal}', [KelasController::class, 'materi'])->name('materi');
    });



    
});
