<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\SettingController;
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
        Route::get('/leads/datatable', [LeadController::class, 'datatable'])
            ->name('leads.datatable');
        Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
        Route::put('/leads/{email_contact}', [LeadController::class, 'update'])
            ->name('leads.update');
        Route::delete('/leads/{email_contact}', [LeadController::class, 'destroy'])
            ->name('leads.destroy');
        Route::post('/leads/import', [LeadController::class, 'import'])->name('leads.import');

        //Campaign Route
        Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign');
        Route::post('/campaign-start', [CampaignController::class, 'start'])
            ->name('start.campaign');
        Route::get('/campaign-status', [CampaignController::class, 'status'])->name('status.campaign');
        Route::get('/campaign-contact', [CampaignController::class, 'mail'])->name('mail.campaign');
        Route::post('/campaign-mail', [CampaignController::class, 'updateTemplate'])
            ->name('update_mail.campaign');
        Route::delete('/campaign-contact/{id}', [CampaignController::class, 'deleteCampaignContact'])
            ->name('delete.campaign');


        //Settings Route
        Route::get('/user-list', [SettingController::class, 'list'])->name('user.list');
        Route::get('/setting', [SettingController::class, 'index'])->name('user.setting');
        Route::post('/users/update-status', [SettingController::class, 'updateStatus'])
            ->name('users.update-status');
        Route::post('/users/add', [SettingController::class, 'store'])->name('user.add');
        Route::put('/users/{id}', [SettingController::class, 'updateAdmin'])->name('users.updateAdmin');
        Route::put('/profile/update', [SettingController::class, 'update'])
            ->name('profile.update');

        //Inquiry Route
        Route::get('/inquiry-list', [InquiryController::class, 'index'])->name('inquiry.list');
        Route::get('/inquiry-archived', [InquiryController::class, 'archived'])->name('inquiry.archived');
        Route::put('/inquiry/update/{inquiry}', [InquiryController::class, 'update'])
            ->name('inquiry.update');
        Route::put('/inquiry/{inquiry}/status', [InquiryController::class, 'updateStatus'])
            ->name('inquiry.updateStatus');

        //Article Route
        Route::get('/article-list', [ArticleController::class, 'index'])->name('article.list');
        Route::get('/article-new', [ArticleController::class, 'new'])->name('article.new');
        Route::get('/article-category', [ArticleController::class, 'category'])->name('article.category');
        Route::get('/article/{slug}/edit', [ArticleController::class, 'edit'])->name('article.edit');
        Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
        Route::post('/article/{article}/upload-image', [ArticleController::class, 'uploadImage'])->name('article.upload-image');
        Route::post('/article/delete-image', [ArticleController::class, 'deleteImage'])->name('article.delete-image');
        Route::put('/article/{article}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
        Route::delete('/article-category/{category}', [ArticleController::class, 'category_destroy'])->name('article-category.destroy');
        Route::post('/article-category', [ArticleController::class, 'store_category'])->name('article-category.store');
    });
});
