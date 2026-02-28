<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Faq;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_testimonials' => Testimonial::count(),
            'active_testimonials' => Testimonial::where('is_active', true)->count(),
            'total_faqs' => Faq::count(),
            'active_faqs' => Faq::where('is_active', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
