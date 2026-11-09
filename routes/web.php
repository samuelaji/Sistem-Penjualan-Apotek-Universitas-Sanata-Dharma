<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\ObatController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi/simpan', [App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{id}/struk', [App\Http\Controllers\TransaksiController::class, 'struk'])->name('transaksi.struk');

Route::get('/apoteker', [ApotekerController::class, 'index'])->name('apoteker.dashboard');
Route::post('/apoteker/resep/{id}/approve', [ApotekerController::class, 'approve'])->name('apoteker.resep.approve');
Route::post('/apoteker/resep/{id}/reject', [ApotekerController::class, 'reject'])->name('apoteker.resep.reject');

Route::get('/apoteker/obat', [ObatController::class, 'index'])->name('apoteker.obat.index');
Route::post('/apoteker/oba`t', [ObatController::class, 'store'])->name('apoteker.obat.store');
Route::put('/apoteker/obat/{id}', [ObatController::class, 'update'])->name('apoteker.obat.update');
Route::delete('/apoteker/obat/{id}', [ObatController::class, 'destroy'])->name('apoteker.obat.destroy');

Route::get('/validasi-blu', function () {
    return view('blu.validasi');
});

Route::get('/resep', function () {
    return view('resep.create');
});

Route::get('/inventaris', function () {
    return view('inventaris.inventaris');
});
