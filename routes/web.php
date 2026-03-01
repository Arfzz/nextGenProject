<?php

use Illuminate\Support\Facades\Route;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransWebhookController;

// Landing page
Route::get('/', function () {
    $testimonials = Testimonial::where('is_active', true)->latest()->get();
    $faqs = Faq::where('is_active', true)->latest()->get();

    return view('welcome', compact('testimonials', 'faqs'));
});

// Checkout
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout-finish', [CheckoutController::class, 'finish'])->name('checkout.finish');
Route::get('/checkout/{package}', [CheckoutController::class, 'show'])->name('checkout');

// Midtrans Webhook (excluded from CSRF in bootstrap/app.php)
Route::post('/midtrans/webhook', [MidtransWebhookController::class, 'handle'])->name('midtrans.webhook');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('testimonials', TestimonialController::class)->names('admin.testimonials');
        Route::resource('faqs', FaqController::class)->names('admin.faqs');
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    });
});
