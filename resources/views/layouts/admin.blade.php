<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — NextGen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
</head>

<body>
    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar__brand">
            <img src="{{ asset('images/logo.png') }}" alt="NextGen Logo" class="sidebar__logo">
            <span class="sidebar__name">NEXTGEN</span>
        </div>
        <ul class="sidebar__nav">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar__link {{ request()->routeIs('admin.dashboard') ? 'sidebar__link--active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="sidebar__link {{ request()->routeIs('admin.testimonials.*') ? 'sidebar__link--active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                    Testimonials
                </a>
            </li>
            <li>
                <a href="{{ route('admin.faqs.index') }}"
                    class="sidebar__link {{ request()->routeIs('admin.faqs.*') ? 'sidebar__link--active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                    FAQ
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}"
                    class="sidebar__link {{ request()->routeIs('admin.orders.*') ? 'sidebar__link--active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    Orders
                </a>
            </li>
        </ul>
        <div class="sidebar__footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar__logout">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <main class="main">
        <header class="topbar">
            <h1 class="topbar__title">@yield('page-title', 'Dashboard')</h1>
            <div class="topbar__user">
                <span>{{ Auth::user()->name }}</span>
                <div class="topbar__avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            </div>
        </header>
        <div class="content">
            @if(session('success'))
                <div class="alert alert--success">Sukses {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert--error">Gagal {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>
</body>

</html>