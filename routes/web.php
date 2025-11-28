<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/products', 'produk')->name('produk');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/workflow', 'workflow')->name('workflow');
    Route::get('/getaqoute', 'quote')->name('quote');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/article', 'article')->name('article');
    Route::get('/article/{slug}', 'article_show')->name('article_show');

    //Post Route
    Route::post('/getaqoute', 'quote_store')->name('quote.store');
});