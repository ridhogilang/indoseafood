<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\LoginController;

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

Route::prefix('system')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

        Route::get('/otp/verify', [OTPController::class, 'index'])->name('otp.verify.form');
        Route::post('/otp/verify', [OTPController::class, 'verify'])->name('otp.verify');
        Route::post('/otp/resend', [OTPController::class, 'resend'])->name('otp.resend');
    });
});

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        //Dashboard Route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        //Lead Route
        Route::get('/leads', [LeadController::class, 'index'])->name('leads');
    });
});
