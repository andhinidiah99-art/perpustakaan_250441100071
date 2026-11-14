<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;

// Rute Baca Buku (Dapat diakses Admin, Petugas, dan Siswa yang sudah login)
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/{id}', [BukuController::class, 'show']);
});

// Rute Tambah, Edit, Hapus (Khusus Admin dan Petugas)
Route::middleware(['web', 'auth', 'role:admin|petugas'])->group(function () {
    Route::post('/buku', [BukuController::class, 'store']);
    Route::put('/buku/{id}', [BukuController::class, 'update']);
    Route::delete('/buku/{id}', [BukuController::class, 'destroy']);
});