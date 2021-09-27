<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\AbsenController;
use App\Http\Controllers\Dosen\KelasController;
use App\Http\Controllers\Dosen\JadwalController;
use App\Http\Controllers\Dosen\MateriController;

Auth::routes();

Route::middleware('auth:dosen')->group(function () {
    Route::get('jadwal-mengajar', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
    Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');

    Route::get('masuk/kelas/{kelas}', [KelasController::class, 'masuk'])->name('kelas.masuk');
    Route::post('masuk/kelas/absen', [KelasController::class, 'absen'])->name('absen');
        Route::get('materi/{jadwal}', [KelasController::class, 'materi'])->name('materi');


    Route::get('materi/upload', [MateriController::class, 'upload'])->name('materi.upload');
    Route::post('materi/upload', [MateriController::class, 'store'])->name('materi.store');
    Route::get('materi/table', [MateriController::class, 'table'])->name('materi.table');
    Route::delete('materi/{materi}/delete', [MateriController::class, 'destroy'])->name('materi.delete');
    Route::put('materi/{materi}/edit', [MateriController::class, 'edit'])->name('materi.edit');

    Route::prefix('absensi')->group(function () {
        Route::get('table', [AbsenController::class, 'table'])->name('absensi.table');
        Route::get('create', [AbsenController::class, 'create'])->name('absensi.create');
        Route::post('create', [AbsenController::class, 'store']);
        Route::get('kelas', [AbsenController::class, 'kelas'])->name('absensi.kelas');
        Route::get('kelas/{kelas:kd_kelas}/detail', [AbsenController::class, 'detail'])->name('absensi.detail');
    });
});
