<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Jadwal\JadwalController;
use App\Http\Controllers\Kelas\KelasController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;



Route::get('/', [HomeController::class, 'index'])->name('home');


Auth::routes();

Route::middleware('auth:mahasiswa,admin,dosen', 'disable.back')->group(function(){
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('permission:jadwal kuliahm|jadwal kuliahd')->group(function(){
        Route::get('jadwal-kuliah', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
        Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');
    });

    Route::middleware('role:admin')->group(function(){
        Route::prefix('managementUser')->group(function(){
            Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    
            Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
        });

        Route::prefix('jadwals')->group(function(){
            Route::get('/table', [JadwalController::class, 'table'])->name('jadwals.table');

            Route::get('/create', [JadwalController::class, 'create'])->name('jadwals.create');
            Route::post('/create', [JadwalController::class, 'store']);

            Route::get('/get-dosen-by-{kelas}', [JadwalController::class, 'getDosenByKelasId']);
            Route::get('/get-matkul-by-{dosen}', [JadwalController::class, 'getMatkulByDosenId']);
        });

        Route::prefix('kelas')->group(function(){
            Route::get('/table', [KelasController::class, 'table'])->name('kelas.table');
        
            Route::get('/create', [KelasController::class, 'create'])->name('kelas.create');
            Route::post('/create', [KelasController::class, 'store']);
        });
        
    });

});