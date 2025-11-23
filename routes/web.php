<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/products', 'produk')->name('produk');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/workflow', 'workflow')->name('workflow');
});