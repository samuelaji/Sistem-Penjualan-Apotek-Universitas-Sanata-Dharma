<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});

// Rute Laporan Inventaris
Route::get('/laporan/inventaris', [LaporanController::class, 'inventaris']);