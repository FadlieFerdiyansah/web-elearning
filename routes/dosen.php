<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\AbsenController;
use App\Http\Controllers\Dosen\KelasController;
use App\Http\Controllers\Dosen\JadwalController;
use App\Http\Controllers\Dosen\MateriController;
use App\Http\Controllers\Dosen\DashboardController;


Route::middleware('auth:dosen')->group(function () {
    Route::prefix('dosen')->get('dashboard', DashboardController::class)->name('dashboard.dosen');
    
    // ** JADWAL **
    Route::get('jadwal-mengajar', [JadwalController::class, 'jadwalMengajar'])->name('jadwals.mengajar');
    Route::get('jadwal-mengajar-pengganti', [JadwalController::class, 'jadwalMengajarPengganti'])->name('jadwals.mengajar_pengganti');

    // ** MATERI **
    Route::resource('materis', MateriController::class);

    // ** KELAS **
    Route::get('mengajar/{kelas}', [KelasController::class, 'masuk'])->name('kelas.masuk');
    Route::post('mengajar/absensi', [KelasController::class, 'storeAbsen'])->name('kelas.store_absen');
    Route::get('materi-mengajar/{jadwal}' , [KelasController::class, 'materi'])->name('kelas.materi');
    
    // ** ABSEN **
    Route::prefix('absensi')->group(function () {
        Route::get('create/{jadwal}', [AbsenController::class, 'create'])->name('absensi.create');
        Route::post('create/store', [AbsenController::class, 'store'])->name('absensi.store');
    });

});
