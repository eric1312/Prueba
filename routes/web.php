<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::get('/{any?}', function () {
    return view('app'); // Vista que carga React
})->where('any', '.*');