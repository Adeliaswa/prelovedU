@extends('layouts.app')

@section('title', 'Masuk Ke Akun')

@section('styles')
<style>
    /* Menggunakan class yang sama dengan register untuk konsistensi */
    .auth-layout {
        display: flex;
        justify-content: center;
        padding: 80px 0 120px;
    }
    .auth-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 420px;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 32px;
    }
    .auth-header h1 {
        font-family: var(--font-display);
        font-size: 1.75rem;
        color: var(--text-primary);
    }
</style>
@endsection

@section('content')
<div class="container auth-layout">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Selamat Datang</h1>
            <p style="color: var(--text-muted); font-size: 0.875rem; margin-top: 8px;">Silakan masuk ke akun PreloveU kamu.</p>
        </div>

        @if(session('status'))
            <div class="alert-toast alert-success" style="margin-bottom: 20px;">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="email@contoh.com" required autofocus>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: baseline;">
                    <label class="form-label" for="password">Kata Sandi</label>
                </div>
                <input type="password" id="password" name="password" class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan kata sandi" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-bottom: 24px;">
                <input type="checkbox" name="remember" id="remember" style="accent-color: var(--text-primary);">
                <label for="remember" style="font-size: 0.8125rem; color: var(--text-muted); cursor: pointer;">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-solid btn-full btn-lg">
                Masuk
            </button>
        </form>

        <div class="auth-footer" style="margin-top: 24px; text-align: center; font-size: 0.875rem; color: var(--text-muted);">
            Belum punya akun? <a href="{{ route('register') }}" style="color: var(--text-primary); font-weight: 600; text-decoration: underline;">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection