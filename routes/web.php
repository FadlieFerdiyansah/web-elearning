<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Jadwal\JadwalController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;



Route::get('/ata', [HomeController::class, 'aha'])->name('ata');


Auth::routes();

Route::middleware('auth:mahasiswa,admin,dosen', 'disable.back')->group(function(){
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('permission:jadwal kuliahm|jadwal kuliahd')->group(function(){
        Route::get('jadwal-kuliah', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
        Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');
    });

    Route::middleware('role:admin')->prefix('managementUser')->group(function(){
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    });

});