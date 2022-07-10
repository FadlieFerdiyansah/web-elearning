<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\Exports\{ExportNilaiController, ExportAbsensiController};
use App\Http\Controllers\Dosen\Laporan\{LaporanNilaiController, LaporanAbsensiController};
use App\Http\Controllers\Dosen\{AbsenController, KelasController, JadwalController, MateriController, DashboardController, NilaiController, TugasController};

Route::middleware('auth:dosen')->group(function () {
    Route::prefix('dosen')->get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.dosen');
    Route::prefix('dosen')->post('dashboard/update-profile', [DashboardController::class, 'updateProfile'])->name('dashboard.dosen_updateProfile');
    
    // ** JADWAL **
    Route::get('jadwal-mengajar', [JadwalController::class, 'jadwalMengajar'])->name('jadwals.mengajar');
    Route::get('jadwal-mengajar-pengganti', [JadwalController::class, 'jadwalMengajarPengganti'])->name('jadwals.mengajar_pengganti');

    // ** MATERI **
    Route::get('materis/create/{jadwal}', [MateriController::class, 'create'])->name('materis.create');
    Route::resource('materis', MateriController::class)->except('index', 'create');

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

    // ** TUGAS **
    Route::get('tugas/{jadwal}', [TugasController::class, 'index'])->name('tugas');
    Route::get('tugas/{tugas}/show', [TugasController::class, 'show'])->name('tugas.show');
    Route::get('tugas/create/{jadwal}', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('tugas/create', [TugasController::class, 'store'])->name('tugas.store');
    Route::delete('tugas/{tugas}/delete', [TugasController::class, 'destroy'])->name('tugas.destroy');
    Route::get('tugas/{tugas}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::put('tugas/{tugas}/edit', [TugasController::class, 'update']);

    Route::get('tugas/{tugas}/tanggapi', [NilaiController::class, 'create'])->name('nilai.create');
    Route::post('tugas/{tugas}/tanggapi', [NilaiController::class, 'store'])->name('nilai.store');

    // ** Laporan **
    Route::get('nilai/mahasiswa', LaporanNilaiController::class)->name('laporan.nilai');
    Route::get('absensi/mahasiswa', LaporanAbsensiController::class)->name('laporan.absensi');

    // ** Exports **
    Route::get('nilai/mahasiswa/export-excel/{kelas}/{matkul}', ExportNilaiController::class)->name('laporan.nilai.export_excel');
    Route::get('absensi/mahasiswa/export-excel/{kelas}/{matkul}', ExportAbsensiController::class)->name('laporan.absensi.export_excel');
});
