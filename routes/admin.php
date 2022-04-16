<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\{DosenController, MahasiswaController};
use App\Http\Controllers\Admin\{DashboardController, KelasController, JadwalController, MatkulController, FakultasController};
use App\Models\Mahasiswa;

// Route::get('dashboard', DashboardController::class)->name('dashboard');


Route::middleware('auth:admin')->group(function () {

    Route::prefix('admin')->get('dashboard', DashboardController::class)->name('dashboard.admin');

    Route::prefix('management-user')->group(function () {
        // Route::prefix('dosen')->group(function () {
            // Route::get('table', [DosenController::class, 'table'])->name('dosen.table');
            // Route::get('create', [DosenController::class, 'create'])->name('dosen.create');
            // Route::post('create', [DosenController::class, 'store']);
            // Route::get('{dosen:nip}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
            // Route::put('{dosen:nip}/edit', [DosenController::class, 'update']);
            // Route::delete('{dosen:nip}/delete', [DosenController::class, 'destroy'])->name('dosen.delete');
            Route::delete('dosens', [DosenController::class, 'delete_checkbox']);
            Route::resource('dosens', DosenController::class);
        // });

        // Route::prefix('mahasiswa')->group(function () {
        //     Route::get('table', [MahasiswaController::class, 'table'])->name('mahasiswa.table');
            Route::delete('mahasiswa', [MahasiswaController::class, 'delete_checkbox']);
            Route::resource('mahasiswa', MahasiswaController::class);

        //     Route::get('create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        //     Route::post('create', [MahasiswaController::class, 'store']);
        //     Route::get('{mahasiswa:nim}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        //     Route::put('{mahasiswa:nim}/edit', [MahasiswaController::class, 'update']);
        //     Route::delete('{mahasiswa:nim}/delete', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');
        // });
    });

    
    // ** KELAS **
    Route::resource('kelas', KelasController::class)->except('show');

    // ** MATAKULIAH **
    Route::get('matkuls/search', [MatkulController::class, 'search'])->name('matkuls.search');
    Route::resource('matkuls', MatkulController::class)->except('show');

    // ** FAKULTAS **
    Route::resource('fakultas', FakultasController::class)->except('show');

    // ** JADWAL **
    Route::prefix('jadwals')->group(function () {
        Route::get('jadwal-pengganti', [JadwalController::class, 'index'])->name('jadwals.pengganti');
        Route::get('get-dosen-by-{kelas}', [JadwalController::class, 'getDosenByKelasId']);
        Route::get('get-matkul-by-{dosen}', [JadwalController::class, 'getMatkulByDosenId']);
    });
    Route::resource('jadwals', JadwalController::class)->except('show');
});
