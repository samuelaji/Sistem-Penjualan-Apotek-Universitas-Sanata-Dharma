<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ApotekerController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi/simpan', [App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');

Route::get('/apoteker', [ApotekerController::class, 'index'])->name('apoteker.dashboard');
Route::post('/apoteker/resep/{id}/approve', [ApotekerController::class, 'approve'])->name('apoteker.resep.approve');
Route::post('/apoteker/resep/{id}/reject', [ApotekerController::class, 'reject'])->name('apoteker.resep.reject');

Route::get('/validasi-blu', function () {
    return view('blu.validasi');
});

Route::get('/resep', function () {
    return view('resep.create');
});

Route::get('/inventaris', function () {
    return view('inventaris.inventaris');
});
