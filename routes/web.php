<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/transaksi', function () {
    return view('transaksi.index');
});

Route::get('/validasi-blu', function () {
    return view('blu.validasi');
});

Route::get('/resep', function () {
    return view('resep.create');
});

Route::get('/inventaris', function () {
    return view('inventaris.inventaris');
});
