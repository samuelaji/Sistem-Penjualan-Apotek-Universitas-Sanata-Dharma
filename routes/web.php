<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/transaksi', function () {
    return view('transaksi.index');
});

Route::get('/validasi-blu', function () {
    return view('blu.validasi');
});

Route::get('/resep', function () {
    return view('resep.create');
})
