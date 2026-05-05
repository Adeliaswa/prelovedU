@extends('layouts.app')

@section('title', 'Profil Saya')

@section('styles')
<style>
    /* ===== PROFILE PAGE ===== */
    .profile-hero {
        padding: 48px 0 28px;
        border-bottom: 1px solid var(--border);
    }
    .profile-hero h1 {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--text-primary);
    }
    .profile-hero p { font-size: 0.875rem; color: var(--text-muted); margin-top: 4px; }

    .profile-layout {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 32px;
        padding: 40px 0 80px;
    }
    @media (max-width: 768px) {
        .profile-layout { grid-template-columns: 1fr; }
    }

    /* Sidebar */
    .profile-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }
    .profile-avatar-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 28px 20px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        margin-bottom: 12px;
    }
    .avatar-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: var(--text-primary);
        color: var(--bg-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 14px;
        letter-spacing: -0.02em;
    }
    .avatar-name {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.01em;
    }
    .avatar-email {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 3px;
        word-break: break-all;
    }
    .sidebar-nav {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
    }
    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 18px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-muted);
        text-decoration: none;
        border-bottom: 1px solid var(--border);
        transition: background 0.15s, color 0.15s;
    }
    .sidebar-nav a:last-child { border-bottom: none; }
    .sidebar-nav a:hover, .sidebar-nav a.active {
        background: var(--bg-subtle);
        color: var(--text-primary);
        text-decoration: none;
    }
    .sidebar-nav a.active { font-weight: 600; }

    /* Main content */
    .profile-main {}
    .profile-section {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .profile-section-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .profile-section-header h2 {
        font-size: 0.9375rem;
        font-weight: 700;
        letter-spacing: -0.01em;
        color: var(--text-primary);
    }
    .profile-section-body { padding: 24px; }

    /* Form styles */
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    @media (max-width: 640px) { .form-grid-2 { grid-template-columns: 1fr; } }
    .form-group { margin-bottom: 18px; }
    .form-group:last-child { margin-bottom: 0; }
    .form-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 7px;
    }
    .form-input {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
        color: var(--text-primary);
        background: var(--bg-main);
        transition: border-color 0.15s;
        box-sizing: border-box;
    }
    .form-input:focus { outline: none; border-color: var(--text-primary); }
    .form-input.is-invalid { border-color: #e53e3e; }
    .form-input:disabled {
        background: var(--bg-subtle);
        color: var(--text-muted);
        cursor: not-allowed;
    }
    .form-error {
        font-size: 0.75rem;
        color: #e53e3e;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .form-hint { font-size: 0.75rem; color: var(--text-muted); margin-top: 5px; }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }
    .btn-save {
        padding: 11px 24px;
        background: var(--text-primary);
        color: var(--bg-main);
        border: none;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: opacity 0.15s, transform 0.15s;
        letter-spacing: -0.01em;
    }
    .btn-save:hover { opacity: 0.8; transform: translateY(-1px); }
    .btn-cancel {
        padding: 11px 20px;
        background: transparent;
        color: var(--text-muted);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: border-color 0.15s, color 0.15s;
        text-decoration: none;
    }
    .btn-cancel:hover {
        border-color: var(--text-primary);
        color: var(--text-primary);
        text-decoration: none;
    }

    /* Alert toasts inside page */
    .inline-alert {
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.875rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .inline-alert-success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .inline-alert-error   { background: #fff5f5; color: #c53030; border: 1px solid #fed7d7; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="profile-hero">
        <h1>Profil Saya</h1>
        <p>Kelola informasi akun dan keamanan kamu</p>
    </div>

    <div class="profile-layout">
        {{-- Sidebar --}}
        <aside class="profile-sidebar">
            <div class="profile-avatar-block">
                <div class="avatar-circle">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="avatar-name">{{ Auth::user()->name }}</div>
                <div class="avatar-email">{{ Auth::user()->email }}</div>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('profile.index') }}" class="active">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><circle cx="7" cy="4.5" r="2.5" stroke="currentColor" stroke-width="1.3"/><path d="M2 12c0-2.21 2.239-4 5-4s5 1.79 5 4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                    Profil
                </a>
                <a href="{{ route('orders.index') }}">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1.5" y="1.5" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.3"/><path d="M4 5h6M4 7.5h6M4 10h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                    Pesanan
                </a>
            </nav>
        </aside>

        {{-- Main --}}
        <main class="profile-main">
            {{-- Success / Error alerts --}}
            @if(session('success'))
                <div class="inline-alert inline-alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="inline-alert inline-alert-error">
                    ⚠ {{ session('error') }}
                </div>
            @endif

            {{-- Edit Profile Form --}}
            <div class="profile-section">
                <div class="profile-section-header">
                    <h2>Informasi Akun</h2>
                </div>
                <div class="profile-section-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    value="{{ old('name', Auth::user()->name) }}"
                                    placeholder="Nama lengkap kamu"
                                >
                                @error('name')
                                    <div class="form-error">
                                        <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="#e53e3e"/><path d="M6 4v3M6 8.5v.5" stroke="#e53e3e" stroke-linecap="round"/></svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">Alamat Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    placeholder="email@contoh.com"
                                >
                                @error('email')
                                    <div class="form-error">
                                        <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="#e53e3e"/><path d="M6 4v3M6 8.5v.5" stroke="#e53e3e" stroke-linecap="round"/></svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Change Password --}}
            <div class="profile-section">
                <div class="profile-section-header">
                    <h2>Ubah Kata Sandi</h2>
                </div>
                <div class="profile-section-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-label" for="current_password">Kata Sandi Lama</label>
                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="form-input {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                placeholder="Masukkan kata sandi saat ini"
                            >
                            @error('current_password')
                                <div class="form-error">
                                    <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="#e53e3e"/><path d="M6 4v3M6 8.5v.5" stroke="#e53e3e" stroke-linecap="round"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="new_password">Kata Sandi Baru</label>
                                <input
                                    type="password"
                                    id="new_password"
                                    name="new_password"
                                    class="form-input {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                    placeholder="Min. 8 karakter"
                                >
                                @error('new_password')
                                    <div class="form-error">
                                        <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="#e53e3e"/><path d="M6 4v3M6 8.5v.5" stroke="#e53e3e" stroke-linecap="round"/></svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="new_password_confirmation">Konfirmasi Kata Sandi</label>
                                <input
                                    type="password"
                                    id="new_password_confirmation"
                                    name="new_password_confirmation"
                                    class="form-input"
                                    placeholder="Ulangi kata sandi baru"
                                >
                            </div>
                        </div>

                        <div class="form-hint" style="margin-top: -10px; margin-bottom: 4px;">
                            Kata sandi minimal 8 karakter. Biarkan kosong jika tidak ingin mengubah.
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">Ubah Kata Sandi</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection