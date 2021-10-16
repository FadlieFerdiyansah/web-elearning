<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\{AbsenController, KelasController, JadwalController, MateriController, DashboardController};


Route::middleware('auth:dosen')->group(function () {
    Route::prefix('dosen')->get('dashboard', DashboardController::class)->name('dashboard.dosen');
    
    // ** JADWAL **
    Route::get('jadwal-mengajar', [JadwalController::class, 'jadwalMengajar'])->name('jadwals.mengajar');
    Route::get('jadwal-mengajar-pengganti', [JadwalController::class, 'jadwalMengajarPengganti'])->name('jadwals.mengajar_pengganti');

    // ** MATERI **
    Route::get('materis/create/{jadwal}', [MateriController::class, 'create'])->name('materis.create');
    Route::resource('materis', MateriController::class)->except('create');

    // ** KELAS **
    Route::get('mengajar/{jadwal}', [KelasController::class, 'masuk'])->name('kelas.masuk');
    Route::post('mengajar/absensi', [KelasController::class, 'storeAbsen'])->name('kelas.store_absen');
    Route::get('materi-mengajar/{jadwal}' , [KelasController::class, 'materi'])->name('kelas.materi');
    
    // ** ABSEN **
    Route::prefix('absensi')->group(function () {
        Route::get('', [AbsenController::class, 'index'])->name('absensi.index');
        Route::get('create/{jadwal}', [AbsenController::class, 'create'])->name('absensi.create');
        Route::post('create/store', [AbsenController::class, 'store'])->name('absensi.store');
        Route::get('edit/{absen}', [AbsenController::class, 'edit'])->name('absensi.edit');
        Route::patch('edit/{absen}', [AbsenController::class, 'update'])->name('absensi.update');
        Route::delete('delete/{absen}', [AbsenController::class, 'destroy'])->name('absensi.delete');
    });

});
