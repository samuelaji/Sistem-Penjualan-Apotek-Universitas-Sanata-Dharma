<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\ObatStockController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->middleware('auth')->group(function () {
    Route::middleware('role:admin,apoteker')->group(function () {
        Route::apiResource('obats', ObatController::class);
        Route::patch('obats/{obat}/stock', [ObatStockController::class, 'update']);
    });

    Route::middleware('role:admin,kasir')->group(function () {
        Route::get('sales', [SaleController::class, 'index']);
        Route::post('sales', [SaleController::class, 'store']);
        Route::get('sales/{sale}', [SaleController::class, 'show']);
    });
});
