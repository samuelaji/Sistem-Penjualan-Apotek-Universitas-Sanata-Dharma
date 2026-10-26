<?php

use Illuminate\Support\Facades\Route;

Route::get('/resep/create', function () {
    return view('resep.create');
});
