<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');

    Route::resource('buku', BukuController::class);

    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');

    Route::get('/petugas/dashboard', function () {
        return view('dashboard');
    })->name('petugas.dashboard');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return redirect()->back();
    })->name('profile.edit');

    Route::get('/buku-cari', [App\Http\Controllers\Api\BukuController::class, 'cari']);

    Route::get('/buku/{id}/hapus', [App\Http\Controllers\Api\BukuController::class, 'destroy']);
});

require __DIR__.'/auth.php';