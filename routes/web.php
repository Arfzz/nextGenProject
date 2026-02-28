<?php

use Illuminate\Support\Facades\Route;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FaqController;

// Landing page — fetch active testimonials & faqs from DB
Route::get('/', function () {
    $testimonials = Testimonial::where('is_active', true)->latest()->get();
    $faqs = Faq::where('is_active', true)->latest()->get();

    return view('welcome', compact('testimonials', 'faqs'));
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Guest routes (login)
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    // Authenticated admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('testimonials', TestimonialController::class)->names('admin.testimonials');
        Route::resource('faqs', FaqController::class)->names('admin.faqs');
    });
});
