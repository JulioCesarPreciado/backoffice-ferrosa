<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/pending-reviews', function () {
        return view('pending_reviews.index');
    })->name('pending_reviews');
    //Rutas para los banners sliders
    Route::resource('banner', 'App\Http\Controllers\BannerController');
    //Rutas para los productos con descuento
    Route::resource('product-discount', 'App\Http\Controllers\ProductDiscountController');
    Route::get('banners', function () {
        return view('banners.sliders.index');
    })->name('banners.sliders.index');
    // Ruta que redirige a la vista de productos con descuento
    Route::get('products-discount', function () {
        return view('products.products-discount.index');
    })->name('products.discount.index');
    //Rutas para seo
    Route::resource('seo', 'App\Http\Controllers\SeoController');
    //Rutas para el faq
    Route::resource('faq', 'App\Http\Controllers\FaqController');
    // Ruta que redirige a la vista de faq
    Route::get('faqs', function () {
        return view('site_settings.faq.index');
    })->name('site_settings.faq.index');

    // Rutas para el newsletter
    Route::resource('newsletter', 'App\Http\Controllers\NewsletterController');
    // Ruta que redirige a la vista de newsletter
    Route::get('newsletters', function () {
        return view('newsletters.index');
    })->name('newsletters.index');

    // Ruta para mandar el newsletter
    Route::get('/send_newsletter/{newsletter}', [App\Http\Controllers\NewsletterController::class, 'sendNewsletterEmail'])->name('newsletter.send');

    // Vista previa para ver el correo
    Route::get('preview_newsletter', function () {
        return view('mail.newsletter.template');
    })->name('newsletters.preview');

    // About
    Route::resource('about', 'App\Http\Controllers\AboutController');
    // Dashboard
    Route::resource('dashboards', 'App\Http\Controllers\DashboardController');
    // JGRID FOR REVIEWS
    Route::resource('pendingreviews', 'App\Http\Controllers\PendingReviewsController');
    Route::post('pendingreviews/filter', [App\Http\Controllers\PendingReviewsController::class, 'filter'])->name('pendingreviews.filter');
    // JGRID FOR APIS
    Route::resource('apis', 'App\Http\Controllers\ApiController');
    Route::post('apis/filter', [App\Http\Controllers\ApiController::class, 'filter'])->name('apis.filter');
    // JSGRID FOR COUPONS
    Route::resource('coupons', 'App\Http\Controllers\CouponController');
    Route::post('coupons/filter', [App\Http\Controllers\CouponController::class, 'filter'])->name('coupons.filter');
    // Config
    Route::resource('configs', 'App\Http\Controllers\ConfigController');
    Route::post('/update/site/settings', [App\Http\Controllers\ConfigController::class, 'updateSiteSettings'])->name('configs.update.site_settings');

    Route::post('contact/update', [App\Http\Controllers\ContactController::class, 'update'])->name('update.contact');
    // About
    Route::resource('about', 'App\Http\Controllers\AboutController');

    //Route::post('/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
});
