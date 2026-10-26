<?php

use Illuminate\Support\Facades\Route;

Route::get('/transaksi', function () {
    return view('transaksi.index');
});
