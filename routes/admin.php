<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\MatkulController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\Users\{DosenController, MahasiswaController};

Route::get('dashboard', DashboardController::class)->name('dashboard');

Auth::routes();

Route::middleware('auth:admin')->group(function () {

    Route::prefix('management-user')->group(function () {
        Route::prefix('dosen')->group(function () {
            Route::get('table', [DosenController::class, 'table'])->name('dosen.table');
            Route::delete('table', [DosenController::class, 'delete_checkbox']);
            Route::get('create', [DosenController::class, 'create'])->name('dosen.create');
            Route::post('create', [DosenController::class, 'store']);
            Route::get('{dosen:nip}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
            Route::put('{dosen:nip}/edit', [DosenController::class, 'update']);
            Route::delete('{dosen:nip}/delete', [DosenController::class, 'destroy'])->name('dosen.delete');
        });

        Route::prefix('mahasiswa')->group(function () {
            Route::get('table', [MahasiswaController::class, 'table'])->name('mahasiswa.table');
            Route::delete('table', [MahasiswaController::class, 'delete_checkbox']);
            Route::get('create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
            Route::post('create', [MahasiswaController::class, 'store']);
            Route::get('{mahasiswa:nim}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
            Route::put('{mahasiswa:nim}/edit', [MahasiswaController::class, 'update']);
            Route::delete('{mahasiswa:nim}/delete', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');
        });
    });



    Route::get('kelas/table', [KelasController::class, 'table'])->name('kelas.table');
    Route::resource('kelas', KelasController::class);

    Route::get('matkuls/table', [MatkulController::class, 'table'])->name('matkuls.table');
    Route::get('matkuls/table=search', [MatkulController::class, 'search'])->name('search');
    Route::resource('matkuls', MatkulController::class);

    Route::get('fakultas/table', [FakultasController::class, 'table'])->name('fakultas.table');
    Route::resource('fakultas', FakultasController::class);

    Route::prefix('jadwals')->group(function () {
        Route::get('jadwal-kuliah', [JadwalController::class, 'table'])->name('jadwals.kuliah');
        Route::get('jadwal-pengganti', [JadwalController::class, 'table'])->name('jadwals.pengganti');

        Route::get('create', [JadwalController::class, 'create'])->name('jadwals.create');
        Route::post('create', [JadwalController::class, 'store']);
        Route::get('edit/{jadwal}', [JadwalController::class, 'edit'])->name('jadwals.edit');
        Route::put('edit/{jadwal}', [JadwalController::class, 'update']);

        Route::get('get-dosen-by-{kelas}', [JadwalController::class, 'getDosenByKelasId']);
        Route::get('get-matkul-by-{dosen}', [JadwalController::class, 'getMatkulByDosenId']);
        // Route::resource('jadwals',JadwalController::class);
    });
});
