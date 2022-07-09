<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController;
use App\Http\Controllers\Mahasiswa\KelasController;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'confirm' => false, 'forgot' => false]);

Route::get('/',fn () => view('index'));
Route::get('forgot-password', [ForgotPasswordController::class, 'showPageForgotPassword'])->name('forgot.password');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendEmail']);
Route::get('riset-password', [ForgotPasswordController::class, 'showPageRisetPassword'])->name('riset.password');
Route::patch('riset-password', [ForgotPasswordController::class, 'updatePassword']);

Route::middleware('auth:mahasiswa', 'disable.back')->group(function () {
    Route::prefix('user')->get('dashboard', DashboardController::class)->name('dashboard.mahasiswa');

    Route::get('jadwal-kuliah', [JadwalController::class, 'jadwalKuliah'])->name('jadwalKuliah');
    // Route::get('jadwal-pengganti', [JadwalController::class, 'jadwalPengganti'])->name('jadwalPengganti');

    Route::get('masuk/kelas/{jadwal}', [KelasController::class, 'masuk'])->name('mahasiswa.masukKelas');
    Route::post('kelas/absen', [KelasController::class, 'absen'])->name('absen');
    Route::get('materi/{jadwal}', [KelasController::class, 'materi'])->name('materi.mhs');
    Route::get('assignment/{jadwal}', [KelasController::class, 'tugas'])->name('tugas.mhs');
    Route::get('send-assignment/{jadwal}/{tugas}', [KelasController::class, 'sendTugas'])->name('sendTugas');
    Route::post('send-assignment/{jadwal}/{tugas}', [KelasController::class, 'store']);
});
