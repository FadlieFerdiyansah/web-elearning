<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Elearning\MatkulController;
use App\Http\Controllers\Elearning\FakultasController;
use App\Http\Controllers\Users\{DosenController, MahasiswaController};
use App\Http\Controllers\Elearning\{AbsenController, KelasController, JadwalController, MateriController};


Route::get('', HomeController::class)->name('index');


Auth::routes();

Route::middleware('auth:mahasiswa,admin,dosen', 'disable.back')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('auth:dosen')->group(function () {
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

    Route::middleware('permission:jadwal kuliahm|jadwal kuliahd')->group(function () {
        Route::get('jadwal-kuliah', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
        Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');

        Route::get('masuk/kelas/{kelas}', [KelasController::class, 'masuk'])->name('kelas.masuk');
        Route::post('masuk/kelas/absen', [KelasController::class, 'absen'])->name('absen');

        Route::get('materi/{jadwal}', [KelasController::class, 'materi'])->name('materi');
    });





    Route::middleware('role:admin')->group(function () {
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

        Route::prefix('jadwals')->group(function () {
            Route::get('table', [JadwalController::class, 'table'])->name('jadwals.table');

            Route::get('create', [JadwalController::class, 'create'])->name('jadwals.create');
            Route::post('create', [JadwalController::class, 'store']);
            Route::get('edit/{jadwal}', [JadwalController::class, 'edit'])->name('jadwals.edit');
            Route::put('edit/{jadwal}', [JadwalController::class, 'update']);

            Route::get('get-dosen-by-{kelas}', [JadwalController::class, 'getDosenByKelasId']);
            Route::get('get-matkul-by-{dosen}', [JadwalController::class, 'getMatkulByDosenId']);
            // Route::resource('jadwals',JadwalController::class);
        });

        Route::get('kelas/table', [KelasController::class, 'table'])->name('kelas.table');
        Route::resource('kelas', KelasController::class);

        Route::get('matkuls/table', [MatkulController::class, 'table'])->name('matkuls.table');
        Route::get('matkuls/table=search', [MatkulController::class, 'search'])->name('search');
        Route::resource('matkuls', MatkulController::class);

        Route::get('fakultas/table', [FakultasController::class, 'table'])->name('fakultas.table');
        Route::resource('fakultas', FakultasController::class);
    });
});
