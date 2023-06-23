<?php

use App\Http\Controllers\DaftarHadirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KetentuanController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/jurusan', [JurusanController::class, 'getView'])->name('data.jurusan');
Route::get('/jabatan', [JabatanController::class, 'getView'])->name('data.jabatan');
Route::get('/mapel', [MapelController::class, 'getView'])->name('data.mapel');
Route::get('/kelas', [KelasController::class, 'getView'])->name('data.kelas');
Route::get('/siswa', [SiswaController::class, 'getView'])->name('data.siswa');
Route::get('/guru', [GuruController::class, 'getView'])->name('data.guru');
Route::get('/ketentuan', [KetentuanController::class, 'getView'])->name('data.ketentuan');
Route::get('/daftar_hadir', [DaftarHadirController::class, 'getView'])->name('data.absen');

