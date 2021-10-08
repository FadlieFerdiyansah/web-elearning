<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\AbsenController;
use App\Http\Controllers\Dosen\KelasController;
use App\Http\Controllers\Dosen\JadwalController;
use App\Http\Controllers\Dosen\MateriController;
use App\Http\Controllers\Dosen\DashboardController;


Route::middleware('auth:dosen')->group(function () {
    Route::prefix('dosen')->get('dashboard', DashboardController::class)->name('dashboard.dosen');

    Route::get('jadwal-mengajar', [JadwalController::class, 'jadwalMengajar'])->name('jadwalMengajar');
    Route::get('jadwal-mengajar-pengganti', [JadwalController::class, 'jadwalMengajarPengganti'])->name('jadwalMengajarPengganti');

    Route::prefix('materi')->group(function () {
        Route::get('table', [MateriController::class, 'table'])->name('materi.table');
        Route::get('upload', [MateriController::class, 'upload'])->name('materi.upload');
        Route::post('upload', [MateriController::class, 'store'])->name('materi.store');
        Route::delete('{materi}/delete', [MateriController::class, 'destroy'])->name('materi.delete');
        Route::put('{materi}/edit', [MateriController::class, 'edit'])->name('materi.edit');
    });

    Route::get('mengajar/{kelas}', [KelasController::class, 'masuk'])->name('kelas.masuk');
    Route::post('mengajar/absensi', [KelasController::class, 'storeRekap'])->name('storeRekap');

    Route::get('materi-mengajar/{jadwal}' , [KelasController::class, 'materi'])->name('materi');

    Route::prefix('absensi')->group(function () {

        Route::get('create/{jadwal}', [AbsenController::class, 'create'])->name('absensi.create');
        Route::post('create/store', [AbsenController::class, 'store'])->name('absensi.store');
        Route::get('kelas', [AbsenController::class, 'kelas'])->name('absensi.kelas');
        Route::get('kelas/{kelas:kd_kelas}/detail', [AbsenController::class, 'detail'])->name('absensi.detail');
    });
});
