@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('styles')
<style>
    .auth-layout {
        display: flex;
        justify-content: center;
        padding: 60px 0 100px;
    }
    .auth-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 32px;
    }
    .auth-header h1 {
        font-family: var(--font-display);
        font-size: 1.75rem;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    .auth-header p {
        font-size: 0.875rem;
        color: var(--text-muted);
    }
    .auth-footer {
        margin-top: 24px;
        text-align: center;
        font-size: 0.875rem;
        color: var(--text-muted);
    }
    .auth-footer a {
        color: var(--text-primary);
        font-weight: 600;
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="container auth-layout">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Mulai di PreloveU</h1>
            <p>Daftar sekarang untuk mulai mencari barang favoritmu.</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap <span class="req">*</span></label>
                <input type="text" id="name" name="name" class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <div class="form-error">
                        <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="currentColor"/><path d="M6 4v3M6 8.5v.5" stroke="currentColor" stroke-linecap="round"/></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email <span class="req">*</span></label>
                <input type="email" id="email" name="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Kata Sandi <span class="req">*</span></label>
                <input type="password" id="password" name="password" class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Min. 8 karakter" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi <span class="req">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ulangi kata sandi" required>
            </div>

            <button type="submit" class="btn btn-solid btn-full btn-lg" style="margin-top: 10px;">
                Daftar Akun
            </button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection