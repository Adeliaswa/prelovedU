@extends('layouts.app')

@php
    $cartItems = $carts ?? collect();
@endphp

@section('title', 'Checkout')

@section('styles')
<style>
    .checkout-hero {
        padding: 48px 0 24px;
        border-bottom: 1px solid var(--border);
    }
    .checkout-hero h1 {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--text-primary);
    }
    .checkout-hero p {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .checkout-steps {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 16px;
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    .step { display: flex; align-items: center; gap: 6px; }
    .step-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        font-weight: 700;
    }
    .step-dot.done { background: var(--text-primary); color: var(--bg-main); }
    .step-dot.active { background: var(--text-primary); color: var(--bg-main); }
    .step-dot.pending { background: var(--bg-subtle); color: var(--text-muted); border: 1px solid var(--border); }
    .step-line { width: 32px; height: 1px; background: var(--border); }

    .checkout-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 32px;
        padding: 40px 0 80px;
    }
    @media (max-width: 768px) {
        .checkout-layout { grid-template-columns: 1fr; }
    }

    .checkout-form-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 32px;
    }
    .form-section-title {
        font-size: 0.8125rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 20px;
    }
    .form-group { margin-bottom: 20px; }
    .form-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 7px;
    }
    .form-label span.required { color: #e53e3e; margin-left: 2px; }
    .form-input,
    .form-textarea {
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
    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--text-primary);
    }
    .form-input.is-invalid,
    .form-textarea.is-invalid { border-color: #e53e3e; }
    .form-textarea { resize: vertical; min-height: 88px; }
    .form-error {
        font-size: 0.75rem;
        color: #e53e3e;
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

    /* Error cart kosong — inline di form, bukan halaman terpisah */
    .cart-empty-error {
        padding: 14px 16px;
        background: #fff5f5;
        border: 1px solid #fed7d7;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.8125rem;
        color: #c53030;
    }

    .order-summary-card {
        position: sticky;
        top: 100px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px;
        height: fit-content;
    }
    .order-summary-card h2 {
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin-bottom: 20px;
        color: var(--text-primary);
    }
    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
    }
    .order-item-left { flex: 1; }
    .order-item-name {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--text-primary);
        line-height: 1.4;
    }
    .order-item-qty {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 2px;
    }
    .order-item-price {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-primary);
        white-space: nowrap;
    }
    .summary-divider {
        height: 1px;
        background: var(--border);
        margin: 16px 0;
    }
    .summary-total-row {
        display: flex;
        justify-content: space-between;
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 24px;
    }
    .btn-order {
        width: 100%;
        padding: 14px;
        background: var(--text-primary);
        color: var(--bg-main);
        border: none;
        border-radius: 10px;
        font-size: 0.9375rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.15s;
        letter-spacing: -0.01em;
    }
    .btn-order:hover:not(:disabled) {
        opacity: 0.85;
        transform: translateY(-1px);
    }
    .btn-order:disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8125rem;
        color: var(--text-muted);
        text-decoration: none;
        margin-top: 14px;
        transition: color 0.15s;
        width: 100%;
        justify-content: center;
    }
    .btn-back:hover { color: var(--text-primary); text-decoration: none; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="checkout-hero">
        <h1>Checkout</h1>
        <p>Isi data pengiriman dan konfirmasi pesananmu</p>
        <div class="checkout-steps">
            <div class="step">
                <div class="step-dot done">✓</div>
                <span>Keranjang</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-dot active">2</div>
                <span style="color: var(--text-primary); font-weight:600;">Pengiriman</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-dot pending">3</div>
                <span>Konfirmasi</span>
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="alert-toast alert-error" style="margin-top:20px;">{{ session('error') }}</div>
    @endif

    <div class="checkout-layout">
        <div>
            <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                @csrf
                <div class="checkout-form-card">
                    <div class="form-section-title">Data Pengiriman</div>

                    {{-- Error cart kosong — validasi inline, bukan halaman terpisah --}}
                    @if($cartItems->isEmpty())
                        <div class="cart-empty-error">
                            ⚠ Keranjang kamu kosong. Tambahkan produk sebelum checkout.
                        </div>
                    @endif

                    {{-- Nama Penerima --}}
                    <div class="form-group">
                        <label class="form-label" for="receiver_name">
                            Nama Penerima <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="receiver_name"
                            name="receiver_name"
                            class="form-input {{ $errors->has('receiver_name') ? 'is-invalid' : '' }}"
                            value="{{ old('receiver_name', Auth::user()->name) }}"
                            placeholder="Nama lengkap penerima"
                            autocomplete="name"
                        >
                        @error('receiver_name')
                            <div class="form-error">
                                <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="#e53e3e"/><path d="M6 4v3M6 8.5v.5" stroke="#e53e3e" stroke-linecap="round"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label class="form-label" for="address">
                            Alamat Lengkap <span class="required">*</span>
                        </label>
                        <textarea
                            id="address"
                            name="address"
                            class="form-textarea {{ $errors->has('address') ? 'is-invalid' : '' }}"
                            placeholder="Jl. Contoh No. 1, Kelurahan, Kecamatan, Kota, Kode Pos"
                        >{{ old('address') }}</textarea>
                        @error('address')
                            <div class="form-error">
                                <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="#e53e3e"/><path d="M6 4v3M6 8.5v.5" stroke="#e53e3e" stroke-linecap="round"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-hint">Tuliskan alamat lengkap agar pengiriman tepat sasaran.</div>
                    </div>

                    {{-- Nomor HP --}}
                    <div class="form-group">
                        <label class="form-label" for="phone_number">
                            Nomor HP <span class="required">*</span>
                        </label>
                        <input
                            type="tel"
                            id="phone_number"
                            name="phone_number"
                            class="form-input {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                            value="{{ old('phone_number') }}"
                            placeholder="08xxxxxxxxxx"
                            autocomplete="tel"
                        >
                        @error('phone_number')
                            <div class="form-error">
                                <svg width="12" height="12" viewBox="0 0 12 12"><circle cx="6" cy="6" r="5.5" stroke="#e53e3e"/><path d="M6 4v3M6 8.5v.5" stroke="#e53e3e" stroke-linecap="round"/></svg>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-hint">Akan dihubungi jika ada masalah pengiriman.</div>
                    </div>
                </div>
            </form>
        </div>

        <aside class="order-summary-card">
            <h2>Ringkasan Pesanan</h2>

            @php $total = 0; @endphp
            @foreach($cartItems as $item)
                @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                <div class="order-item">
                    <div class="order-item-left">
                        <div class="order-item-name">{{ $item->product->name }}</div>
                        <div class="order-item-qty">{{ $item->quantity }} pcs</div>
                    </div>
                    <div class="order-item-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                </div>
            @endforeach

            <div class="summary-divider"></div>
            <div class="summary-total-row">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <button
                type="submit"
                form="checkout-form"
                class="btn-order"
                {{ $cartItems->isEmpty() ? 'disabled' : '' }}
                onclick="return confirm('Konfirmasi pesanan ini?')"
            >
                Buat Pesanan
            </button>
            <a href="{{ route('cart.index') }}" class="btn-back">
                ← Kembali ke Keranjang
            </a>
        </aside>
    </div>
</div>
@endsection