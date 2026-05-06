@extends('layouts.app')

@section('title', 'Login Administrator')

@section('styles')
<style>
    .admin-login-layout {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 40px 0;
    }
    .admin-login-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-top: 4px solid var(--text-primary);
        border-radius: var(--radius-lg);
        padding: 48px 40px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }
    .admin-badge {
        display: inline-block;
        background: var(--text-primary);
        color: var(--bg-main);
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 99px;
        margin-bottom: 16px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }
</style>
@endsection

@section('content')
<div class="container admin-login-layout">
    <div class="admin-login-card">
        <div style="text-align: center; margin-bottom: 32px;">
            <span class="admin-badge">Admin Portal</span>
            <h1 style="font-family: var(--font-display); font-size: 1.75rem; color: var(--text-primary);">Otorisasi Sistem</h1>
        </div>

        @if($errors->any())
            <div style="padding: 12px; background: var(--red-bg); color: var(--red); border: 1px solid var(--red-border); border-radius: 8px; margin-bottom: 24px; font-size: 0.875rem;">
                Kredensial administrator tidak valid atau Anda tidak memiliki hak akses.
            </div>
        @endif

        <!-- Pastikan route 'admin.login.submit' sesuai dengan nama route di web.php Anda -->
        <form action="{{ route('admin.login.submit') ?? route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email Admin</label>
                <input type="email" id="email" name="email" class="form-input" required autofocus>
            </div>
            <div class="form-group" style="margin-bottom: 32px;">
                <label class="form-label" for="password">Kata Sandi Akses</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-solid btn-full btn-lg">Akses Dasbor</button>
        </form>
    </div>
</div>
@endsection
