<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin PreloveU')</title>

    <!-- Menggunakan font yang sama dengan halaman customer -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== ROOT VARIABLES (Sama dengan app.blade.php) ===== */
        :root {
            --bg-main: #fafafa;
            --bg-card: #ffffff;
            --bg-subtle: #f4f4f4;
            --border: #e5e5e5;
            --text-primary: #0f0f0f;
            --text-muted: #888888;
            --red: #dc2626; --red-bg: #fef2f2;
            --green: #16a34a; --green-bg: #f0fdf4;
            --font-body: 'Poppins', sans-serif;
            --font-display: 'DM Serif Display', Georgia, serif;
            --radius-sm: 6px; --radius: 10px; --radius-lg: 16px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: var(--font-body);
            background: var(--bg-main);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
        }

        /* ===== ADMIN LAYOUT ===== */
        .admin-sidebar {
            width: 260px;
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .admin-brand {
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            font-family: var(--font-display);
            font-size: 1.25rem;
            border-bottom: 1px solid var(--border);
        }

        .admin-nav { padding: 24px 16px; flex: 1; }
        
        .admin-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 8px;
            transition: all 0.2s;
        }

        .admin-nav a:hover, .admin-nav a.active {
            background: var(--bg-subtle);
            color: var(--text-primary);
            font-weight: 600;
        }

        .admin-main {
            flex: 1;
            margin-left: 260px; /* Offset for sidebar */
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            height: 64px;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .admin-content {
            padding: 32px;
            flex: 1;
        }

        /* ===== SHARED COMPONENTS (Card, Button, Table) ===== */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
        }

        .btn-solid {
            background: var(--text-primary);
            color: var(--bg-main);
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            border: none;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1.5px solid var(--border);
            padding: 9px 18px;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .admin-table th {
            text-align: left;
            padding: 16px;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border);
        }

        .admin-table td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            font-size: 0.875rem;
            color: var(--text-primary);
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar Admin -->
    <aside class="admin-sidebar">
        <div class="admin-brand">PreloveU Admin</div>
        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Manajemen Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">Manajemen Pesanan</a>
        
        <div style="height: 1px; background: var(--border); margin: 8px 16px;"></div>
        
        <a href="{{ route('products.index') }}">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Lihat Katalog
        </a>
        </nav>

    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <header class="admin-header">
            <h2 style="font-size: 1rem; font-weight: 600;">Panel Kontrol</h2>
            <div style="display: flex; gap: 16px; align-items: center;">
                <span style="font-size: 0.875rem; font-weight: 500;">Admin</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-outline" style="padding: 6px 12px; border-color: var(--red); color: var(--red);">Keluar</button>
                </form>
            </div>
        </header>

        <div class="admin-content">
            @yield('content')
        </div>
    </main>

</body>
</html>