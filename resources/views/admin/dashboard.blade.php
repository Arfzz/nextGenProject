@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--blue">{{ $stats['total_testimonials'] }}</div>
            <div>
                <div class="stat-card__value">{{ $stats['total_testimonials'] }}</div>
                <div class="stat-card__label">Total Testimonials</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--green">{{ $stats['active_testimonials'] }}</div>
            <div>
                <div class="stat-card__value">{{ $stats['active_testimonials'] }}</div>
                <div class="stat-card__label">Active Testimonials</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--yellow">{{ $stats['total_faqs'] }}</div>
            <div>
                <div class="stat-card__value">{{ $stats['total_faqs'] }}</div>
                <div class="stat-card__label">Total FAQs</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--green">{{ $stats['active_faqs'] }}</div>
            <div>
                <div class="stat-card__value">{{ $stats['active_faqs'] }}</div>
                <div class="stat-card__label">Active FAQs</div>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 12px;">Selamat Datang, {{ Auth::user()->name }}</h3>
        <p style="color: var(--color-text-muted); font-size: 14px;">
            Gunakan sidebar di kiri untuk mengelola testimonials dan FAQ di landing page NextGen.
        </p>
    </div>
@endsection