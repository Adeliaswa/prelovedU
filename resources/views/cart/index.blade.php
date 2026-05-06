@extends('layouts.app')

@php
    $cartItems = $carts ?? collect();
@endphp

@section('title', 'Keranjang Belanja')

@section('styles')
<style>
    .cart-hero {
        padding: 48px 0 24px;
        border-bottom: 1px solid var(--border);
    }
    .cart-hero h1 {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--text-primary);
    }
    .cart-hero p {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-top: 4px;
    }
    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 32px;
        padding: 40px 0 80px;
    }
    @media (max-width: 768px) {
        .cart-layout { grid-template-columns: 1fr; }
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .cart-item {
        display: grid;
        grid-template-columns: 80px 1fr auto;
        gap: 20px;
        align-items: center;
        padding: 24px 0;
        border-bottom: 1px solid var(--border);
    }
    .cart-item:first-child { border-top: 1px solid var(--border); }
    .cart-item-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        background: var(--bg-subtle);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cart-item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }
    .cart-item-img .no-img {
        width: 80px;
        height: 80px;
        background: #f0f0f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: 1.5rem;
    }
    .cart-item-name {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .cart-item-price {
        font-size: 0.8125rem;
        color: var(--text-muted);
    }
    .cart-item-subtotal {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-top: 8px;
    }
    .cart-item-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
    }

    .qty-control {
        display: flex;
        align-items: center;
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
    }
    .qty-btn {
        width: 34px;
        height: 34px;
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s;
        font-family: inherit;
    }
    .qty-btn:hover { background: var(--bg-subtle); }
    .qty-btn:disabled { opacity: 0.3; cursor: not-allowed; }
    .qty-display {
        width: 40px;
        height: 34px;
        text-align: center;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        border-left: 1px solid var(--border);
        border-right: 1px solid var(--border);
        background: transparent;
        font-family: 'Poppins', sans-serif;
        color: var(--text-primary);
    }
    .qty-display:focus { outline: none; }

    .btn-delete {
        background: transparent;
        border: none;
        cursor: pointer;
        color: var(--text-muted);
        font-size: 0.8125rem;
        padding: 4px 0;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.15s;
        font-family: inherit;
    }
    .btn-delete:hover { color: #e53e3e; }

    .stock-warning {
        font-size: 0.75rem;
        color: #e53e3e;
        margin-top: 4px;
    }

    .cart-summary {
        position: sticky;
        top: 100px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px;
        height: fit-content;
    }
    .cart-summary h2 {
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin-bottom: 20px;
        color: var(--text-primary);
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-bottom: 10px;
    }
    .summary-row span:last-child { color: var(--text-primary); font-weight: 500; }
    .summary-divider {
        height: 1px;
        background: var(--border);
        margin: 16px 0;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 24px;
    }
    .btn-checkout {
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
        text-decoration: none;
        display: block;
        text-align: center;
        letter-spacing: -0.01em;
    }
    .btn-checkout:hover:not(:disabled) {
        opacity: 0.85;
        transform: translateY(-1px);
        color: var(--bg-main);
        text-decoration: none;
    }
    .btn-checkout:disabled {
        opacity: 0.35;
        cursor: not-allowed;
        transform: none;
    }
    .checkout-note {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-align: center;
        margin-top: 12px;
    }

    /* Fallback minimal kalau keranjang kosong */
    .cart-empty-minimal {
        padding: 60px 0;
        color: var(--text-muted);
        font-size: 0.875rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="cart-hero">
        <h1>Keranjang Belanja</h1>
        <p>{{ $cartItems->count() }} item di keranjang kamu</p>
    </div>

    @if(session('success'))
        <div class="alert-toast alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-toast alert-error">{{ session('error') }}</div>
    @endif

    <div class="cart-layout">
        {{-- Cart Items --}}
        <div class="cart-items">
            @forelse($cartItems as $item)
            <div class="cart-item" id="cart-item-{{ $item->id }}">
                <div class="cart-item-img">
                    @if($item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                    @else
                        <div class="no-img">📦</div>
                    @endif
                </div>

                <div class="cart-item-info">
                    <div class="cart-item-name">{{ $item->product->name }}</div>
                    <div class="cart-item-price">Rp {{ number_format($item->product->price, 0, ',', '.') }} / pcs</div>
                    <div class="cart-item-subtotal">
                        Subtotal: Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                    </div>
                    @if($item->quantity > $item->product->stock)
                        <div class="stock-warning">⚠ Stok tidak cukup (tersedia: {{ $item->product->stock }})</div>
                    @endif
                </div>

                <div class="cart-item-actions">
                    <div class="qty-control">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:contents">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                            <button type="submit" class="qty-btn" {{ $item->quantity <= 1 ? 'disabled' : '' }}>−</button>
                        </form>
                        <span class="qty-display">{{ $item->quantity }}</span>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:contents">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button type="submit" class="qty-btn" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                        </form>
                    </div>

                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M1 1l10 10M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="cart-empty-minimal">
                Belum ada item di keranjang.
            </div>
            @endforelse
        </div>

        {{-- Summary --}}
        @php
            $hasStockIssue = $cartItems->contains(fn($i) => $i->quantity > $i->product->stock);
            $total = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        @endphp
        <aside class="cart-summary">
            <h2>Ringkasan Pesanan</h2>

            @foreach($cartItems as $item)
            <div class="summary-row">
                <span>{{ \Illuminate\Support\Str::limit($item->product->name, 22) }} ×{{ $item->quantity }}</span>
                <span>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
            </div>
            @endforeach

            <div class="summary-divider"></div>
            <div class="summary-total">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            @if($hasStockIssue)
                <div style="font-size:0.8rem;color:#e53e3e;margin-bottom:16px;padding:10px;background:#fff5f5;border-radius:8px;border:1px solid #fed7d7;">
                    ⚠ Beberapa item melebihi stok. Harap sesuaikan jumlah sebelum checkout.
                </div>
                <button class="btn-checkout" disabled>Lanjut ke Checkout</button>
            @elseif($cartItems->isEmpty())
                <button class="btn-checkout" disabled>Lanjut ke Checkout</button>
            @else
                <a href="{{ route('checkout.index') }}" class="btn-checkout">Lanjut ke Checkout</a>
            @endif

            <p class="checkout-note">Gratis ongkir untuk semua pesanan 🎉</p>
        </aside>
    </div>
</div>
@endsection