<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PrelovedU') — PrelovedU</title>

    {{-- Fonts: Poppins untuk body, DM Serif Display untuk aksen --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    /* ============================================================
       PRELOVEDU — DESIGN SYSTEM & LAYOUT
       Minimalist black/white/neutral — font Poppins
       Hover animations tipis, clean typography
    ============================================================ */

    *, *::before, *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        /* Colors */
        --bg-main:      #fafafa;
        --bg-card:      #ffffff;
        --bg-subtle:    #f4f4f4;
        --border:       #e5e5e5;
        --border-hover: #c8c8c8;
        --text-primary: #0f0f0f;
        --text-muted:   #888888;
        --text-faint:   #bbbbbb;

        /* Status colors */
        --red:          #dc2626;
        --red-bg:       #fef2f2;
        --red-border:   #fecaca;
        --green:        #16a34a;
        --green-bg:     #f0fdf4;
        --green-border: #bbf7d0;
        --yellow:       #b45309;
        --yellow-bg:    #fffbeb;
        --blue:         #1d4ed8;
        --blue-bg:      #eff6ff;

        /* Type */
        --font-body:    'Poppins', sans-serif;
        --font-display: 'DM Serif Display', Georgia, serif;

        /* Layout */
        --container:    1120px;
        --navbar-h:     64px;
        --radius-sm:    6px;
        --radius:       10px;
        --radius-lg:    16px;

        /* Transitions */
        --t-fast:       0.12s ease;
        --t-mid:        0.2s ease;
    }

    html {
        font-size: 16px;
        scroll-behavior: smooth;
    }

    body {
        font-family: var(--font-body);
        background: var(--bg-main);
        color: var(--text-primary);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        line-height: 1.6;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    a { color: inherit; }
    button, input, textarea, select { font-family: var(--font-body); }
    img { display: block; max-width: 100%; }

    /* ===========================
       CONTAINER
    =========================== */
    .container {
        max-width: var(--container);
        margin: 0 auto;
        padding: 0 28px;
    }
    @media (max-width: 640px) {
        .container { padding: 0 16px; }
    }

    /* ===========================
       NAVBAR
    =========================== */
    .site-navbar {
        position: sticky;
        top: 0;
        z-index: 200;
        height: var(--navbar-h);
        background: rgba(250, 250, 250, 0.88);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid var(--border);
    }

    .navbar-inner {
        max-width: var(--container);
        margin: 0 auto;
        padding: 0 28px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }
    @media (max-width: 640px) {
        .navbar-inner { padding: 0 16px; }
    }

    /* Brand */
    .navbar-brand {
        text-decoration: none;
        display: flex;
        align-items: baseline;
        gap: 1px;
        flex-shrink: 0;
    }
    .navbar-brand-name {
        font-family: var(--font-display);
        font-size: 1.25rem;
        color: var(--text-primary);
        letter-spacing: -0.01em;
        line-height: 1;
    }
    .navbar-brand-tag {
        font-family: var(--font-body);
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--text-faint);
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-left: 6px;
        align-self: center;
    }

    /* Nav links */
    .navbar-nav {
        display: flex;
        align-items: center;
        gap: 2px;
        list-style: none;
    }
    .navbar-nav a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--text-muted);
        text-decoration: none;
        border-radius: var(--radius-sm);
        transition: background var(--t-fast), color var(--t-fast);
        position: relative;
    }
    .navbar-nav a:hover {
        background: var(--bg-subtle);
        color: var(--text-primary);
    }
    .navbar-nav a.active {
        background: var(--bg-subtle);
        color: var(--text-primary);
        font-weight: 600;
    }

    /* Cart badge */
    .nav-cart-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 17px;
        height: 17px;
        padding: 0 4px;
        background: var(--text-primary);
        color: var(--bg-card);
        border-radius: 99px;
        font-size: 0.625rem;
        font-weight: 700;
        line-height: 1;
    }

    /* Right side actions */
    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    /* User info */
    .nav-user {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 5px 10px;
        border-radius: var(--radius-sm);
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--text-muted);
        background: var(--bg-subtle);
    }
    .nav-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--text-primary);
        color: var(--bg-card);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.625rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* Logout button */
    .btn-nav-logout {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 13px;
        background: transparent;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
        transition: border-color var(--t-fast), color var(--t-fast), background var(--t-fast);
        text-decoration: none;
    }
    .btn-nav-logout:hover {
        border-color: var(--text-primary);
        color: var(--text-primary);
        background: var(--bg-subtle);
    }

    /* Mobile: hide some nav items */
    @media (max-width: 640px) {
        .navbar-nav .nav-hide-mobile { display: none; }
        .nav-user-name { display: none; }
    }

    /* ===========================
       MAIN CONTENT
    =========================== */
    .site-main {
        flex: 1;
    }

    /* ===========================
       GLOBAL ALERTS
    =========================== */
    .alert-toast {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 12px 16px;
        border-radius: var(--radius);
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 20px;
        animation: toast-in 0.18s ease;
    }
    @keyframes toast-in {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .alert-success {
        background: var(--green-bg);
        color: var(--green);
        border: 1px solid var(--green-border);
    }
    .alert-error {
        background: var(--red-bg);
        color: var(--red);
        border: 1px solid var(--red-border);
    }

    /* ===========================
       FOOTER
    =========================== */
    .site-footer {
        border-top: 1px solid var(--border);
        padding: 28px;
        margin-top: auto;
    }
    .site-footer-inner {
        max-width: var(--container);
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .footer-brand {
        font-family: var(--font-display);
        font-size: 1rem;
        color: var(--text-primary);
    }
    .footer-copy {
        font-size: 0.8rem;
        color: var(--text-faint);
    }

    /* ===========================
       SHARED FORM COMPONENTS
       (dipakai di semua halaman)
    =========================== */
    .form-group { margin-bottom: 18px; }
    .form-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 7px;
    }
    .form-label .req { color: var(--red); margin-left: 2px; }
    .form-input,
    .form-textarea {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        font-family: var(--font-body);
        color: var(--text-primary);
        background: var(--bg-card);
        transition: border-color var(--t-fast);
    }
    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--text-primary);
    }
    .form-input.is-invalid,
    .form-textarea.is-invalid { border-color: var(--red); }
    .form-textarea { resize: vertical; min-height: 88px; }
    .form-error {
        font-size: 0.75rem;
        color: var(--red);
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .form-hint {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 5px;
    }

    /* ===========================
       SHARED BUTTON COMPONENTS
    =========================== */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 20px;
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        font-weight: 600;
        font-family: var(--font-body);
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: opacity var(--t-fast), transform var(--t-fast), background var(--t-fast), border-color var(--t-fast), color var(--t-fast);
    }
    .btn:hover { transform: translateY(-1px); }
    .btn-solid {
        background: var(--text-primary);
        color: var(--bg-card);
    }
    .btn-solid:hover { opacity: 0.82; color: var(--bg-card); text-decoration: none; }
    .btn-outline {
        background: transparent;
        color: var(--text-primary);
        border: 1.5px solid var(--border);
    }
    .btn-outline:hover {
        border-color: var(--text-primary);
        text-decoration: none;
        color: var(--text-primary);
    }
    .btn-ghost {
        background: transparent;
        color: var(--text-muted);
        border: none;
        padding: 8px 12px;
    }
    .btn-ghost:hover { background: var(--bg-subtle); color: var(--text-primary); }
    .btn-lg { padding: 13px 28px; font-size: 0.9375rem; border-radius: var(--radius); }
    .btn-sm { padding: 6px 13px; font-size: 0.8rem; }
    .btn-full { width: 100%; }
    .btn:disabled {
        opacity: 0.35;
        cursor: not-allowed;
        transform: none;
        pointer-events: none;
    }

    /* ===========================
       STATUS BADGES
    =========================== */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 11px;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        flex-shrink: 0;
    }
    .badge-yellow  { background: var(--yellow-bg);  color: var(--yellow); }
    .badge-blue    { background: var(--blue-bg);    color: var(--blue); }
    .badge-green   { background: var(--green-bg);   color: var(--green); }
    .badge-neutral { background: var(--bg-subtle);  color: var(--text-muted); }

    /* ===========================
       SECTION CARD
    =========================== */
    .card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }
    .card-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .card-header h2,
    .card-header h3 {
        font-size: 0.9375rem;
        font-weight: 700;
        letter-spacing: -0.01em;
        color: var(--text-primary);
    }
    .card-body { padding: 24px; }
    .card-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--border);
        background: var(--bg-subtle);
    }

    /* ===========================
       DIVIDERS
    =========================== */
    .divider {
        height: 1px;
        background: var(--border);
        margin: 16px 0;
    }

    /* ===========================
       PAGE HERO
    =========================== */
    .page-hero {
        padding: 44px 0 24px;
        border-bottom: 1px solid var(--border);
    }
    .page-hero h1 {
        font-size: 1.875rem;
        font-weight: 700;
        letter-spacing: -0.035em;
        color: var(--text-primary);
        line-height: 1.2;
    }
    .page-hero p {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-top: 5px;
    }

    /* ===========================
       UTILITY
    =========================== */
    .sr-only {
        position: absolute;
        width: 1px; height: 1px;
        padding: 0; margin: -1px;
        overflow: hidden;
        clip: rect(0,0,0,0);
        white-space: nowrap;
        border-width: 0;
    }

    </style>

    {{-- Per-page styles --}}
    @yield('styles')
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <header class="site-navbar">
        <div class="navbar-inner">

            {{-- Brand --}}
            <a href="{{ route('products.index') }}" class="navbar-brand">
                <span class="navbar-brand-name">PrelovedU</span>
                <span class="navbar-brand-tag">prelovedU</span>
            </a>

            {{-- Nav Links --}}
            @auth
            <nav>
                <ul class="navbar-nav">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <rect x="1" y="1" width="5.5" height="5.5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                                <rect x="7.5" y="1" width="5.5" height="5.5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                                <rect x="1" y="7.5" width="5.5" height="5.5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                                <rect x="7.5" y="7.5" width="5.5" height="5.5" rx="1.2" stroke="currentColor" stroke-width="1.3"/>
                            </svg>
                            <span class="nav-hide-mobile">Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}"
                           class="{{ request()->routeIs('cart.*') ? 'active' : '' }}">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M1 1h1.5l1.8 6.5h6.4l1.3-4.5H4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="6" cy="11.5" r="1" fill="currentColor"/>
                                <circle cx="10" cy="11.5" r="1" fill="currentColor"/>
                            </svg>
                            Keranjang
                            @php $cartCount = Auth::user()->carts()->count() ?? 0; @endphp
                            @if($cartCount > 0)
                                <span class="nav-cart-badge">{{ $cartCount > 9 ? '9+' : $cartCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-hide-mobile">
                        <a href="{{ route('orders.index') }}"
                           class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <rect x="1.5" y="1.5" width="11" height="11" rx="1.8" stroke="currentColor" stroke-width="1.3"/>
                                <path d="M4 5h6M4 7h4.5M4 9h3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                            </svg>
                            Pesanan
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- User Actions --}}
            <div class="navbar-actions">
                <a href="{{ route('profile.index') }}" class="nav-user {{ request()->routeIs('profile.*') ? '' : '' }}" style="text-decoration:none;">
                    <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span class="nav-user-name" style="font-size:0.8125rem;">{{ Illuminate\Support\Str::limit(Auth::user()->name, 14) }}</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-nav-logout">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                            <path d="M5 1.5H2.5A1 1 0 001.5 2.5v8a1 1 0 001 1H5M9 9.5l3-3-3-3M12 6.5H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav-hide-mobile">Keluar</span>
                    </button>
                </form>
            </div>
            @else
            {{-- Guest --}}
            <div class="navbar-actions">
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-solid btn-sm">Daftar</a>
            </div>
            @endauth

        </div>
    </header>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="site-main">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="site-footer">
        <div class="site-footer-inner">
            <span class="footer-brand">PrelovedU</span>
            <span class="footer-copy">© {{ date('Y') }} PrelovedU — Platform jual beli barang preloved.</span>
        </div>
    </footer>

    {{-- Per-page scripts --}}
    @yield('scripts')

</body>
</html>