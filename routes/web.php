<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/products', 'produk')->name('produk');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/workflow', 'workflow')->name('workflow');
    Route::get('/getaqoute', 'quote')->name('quote');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/article', 'article')->name('article');
    Route::get('/article/{slug}', 'article_show')->name('article_show');
    Route::get('/article', 'article')->name('article');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/terms-and-conditions', 'terms')->name('terms');
    //Post Route
    Route::post('/getaqoute', 'quote_store')->name('quote.store');


Route::get('/test-email-brevo', function () {

    Mail::send([], [], function ($message) {
        $message
            ->from('info@indoseafoods.com', 'IndoSeafood Test')
            ->to('ridhogilang693@gmail.com')
            ->subject('Brevo Test Email')
            ->html('<p>This email is sent via <b>Brevo SMTP</b>.</p>');
    });

    return 'Test email sent. Check inbox & email headers.';
});

Route::get('/test-mail', function () {
    Mail::raw('Brevo AUTH OK', function ($m) {
        $m->to('ridhogilang693@gmail.com')
          ->subject('SMTP Auth Test');
    });

    return 'sent';
});

Route::get('/debug-mail', function () {
    dd([
        'MAIL_MAILER' => config('mail.default'),
        'MAIL_HOST' => config('mail.mailers.smtp.host'),
        'MAIL_PORT' => config('mail.mailers.smtp.port'),
        'MAIL_USERNAME' => config('mail.mailers.smtp.username'),
        'MAIL_PASSWORD_STARTS_WITH' => substr(config('mail.mailers.smtp.password'), 0, 10),
    ]);
});

});

Route::prefix('system')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

        //Reset Password Route
        Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('forgot.password');
        Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

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
        Route::get('/campaign/datatable', [CampaignController::class, 'datatable'])
            ->name('campaign.datatable');
        Route::post('/campaign-start', [CampaignController::class, 'start'])
            ->name('start.campaign');
        Route::get('/campaign-status', [CampaignController::class, 'status'])->name('status.campaign');
        Route::get('/campaign/status/datatable', [CampaignController::class, 'statusDatatable'])
            ->name('campaign.status.datatable');
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
        Route::post('/user/notification-toggle', [SettingController::class, 'toggleNotification'])
            ->name('user.notification.toggle');


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

        //Product Route
        Route::get('/products', [ProductController::class, 'index'])->name('product.list');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::post('/products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('products.toggle-active');
        Route::post('/products/{product}/change-category', [ProductController::class, 'changeCategory'])->name('products.change-category');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/products-category', [ProductController::class, 'category'])->name('product.category');
        Route::post('/product-category/store',  [ProductController::class, 'storeCategory'])->name('product-category.store');
        Route::put('/product-category/{productCategory}/update', [ProductController::class, 'updateCategory'])->name('product-category.update');
        Route::delete('/product-category/{productCategory}', [ProductController::class, 'destroyCategory'])->name('product-category.destroy');
    });
});
