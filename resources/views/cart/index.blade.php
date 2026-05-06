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
        .cart-layout {
            grid-template-columns: 1fr;
        }
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 80px 1fr auto;
        gap: 20px;
        align-items: center;
        padding: 20px;
        border: 1px solid var(--border);
        border-radius: 12px;
        background: var(--bg-card);
        transition: border-color 0.18s, background 0.18s;
    }

    .cart-item.has-stock-error {
        background: #fff0f0;
        border-color: #f5c2c2;
    }

    .cart-item-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        background: var(--bg-subtle);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
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
        background: var(--bg-card);
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

    .qty-btn:hover:not(:disabled) {
        background: var(--bg-subtle);
    }

    .qty-btn:disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    .qty-display {
        width: 40px;
        height: 34px;
        text-align: center;
        line-height: 34px;
        font-size: 0.875rem;
        font-weight: 600;
        border-left: 1px solid var(--border);
        border-right: 1px solid var(--border);
        background: transparent;
        font-family: 'Poppins', sans-serif;
        color: var(--text-primary);
    }

    .btn-trash {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid var(--border);
        border-radius: 7px;
        background: transparent;
        cursor: pointer;
        color: var(--text-muted);
        transition: border-color 0.15s, color 0.15s, background 0.15s;
    }

    .btn-trash:hover {
        border-color: #e53e3e;
        color: #e53e3e;
        background: #fff5f5;
    }

    .stock-warning-label {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.78rem;
        font-weight: 500;
        color: #c0392b;
        margin-top: 8px;
    }

    .stock-warning-label::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #e53e3e;
        flex-shrink: 0;
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
        gap: 8px;
    }

    .summary-row span:first-child {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        flex: 1;
    }

    .summary-row span:last-child {
        color: var(--text-primary);
        font-weight: 500;
        white-space: nowrap;
    }

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

    .summary-stock-warning {
        font-size: 0.8rem;
        color: #c0392b;
        margin-bottom: 16px;
        padding: 10px 12px;
        background: #fff0f0;
        border-radius: 8px;
        border: 1px solid #f5c2c2;
        line-height: 1.5;
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

    .cart-empty-minimal {
        padding: 60px 0;
        color: var(--text-muted);
        font-size: 0.875rem;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.32);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
    }

    .modal-overlay.is-open {
        opacity: 1;
        pointer-events: all;
    }

    .modal-box {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 36px 36px;
        max-width: 400px;
        width: 100%;
        text-align: center;
        transform: scale(0.94) translateY(10px);
        transition: transform 0.22s cubic-bezier(.34,1.3,.64,1), opacity 0.18s ease;
        opacity: 0;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.14);
    }

    .modal-overlay.is-open .modal-box {
        transform: scale(1) translateY(0);
        opacity: 1;
    }

    .modal-icon {
        width: 66px;
        height: 66px;
        border-radius: 50%;
        background: #fde8e8;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 22px;
    }

    .modal-title {
        font-size: 1.0625rem;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.02em;
        margin-bottom: 9px;
    }

    .modal-desc {
        font-size: 0.875rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 8px;
    }

    .modal-item-name {
        display: inline-block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-primary);
        background: var(--bg-subtle);
        border-radius: 7px;
        padding: 7px 14px;
        margin-bottom: 28px;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .modal-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .btn-modal-cancel {
        padding: 12px;
        background: transparent;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        color: var(--text-muted);
        cursor: pointer;
        transition: border-color 0.15s, color 0.15s;
    }

    .btn-modal-cancel:hover {
        border-color: var(--text-primary);
        color: var(--text-primary);
    }

    .btn-modal-confirm {
        padding: 12px;
        background: #e05252;
        border: none;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        color: #fff;
        cursor: pointer;
        transition: background 0.15s, transform 0.12s;
    }

    .btn-modal-confirm:hover {
        background: #c53030;
        transform: translateY(-1px);
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
        <div class="cart-items">
            @forelse($cartItems as $item)
                @php
                    $isStockError = $item->quantity > $item->product->stock;
                @endphp

                <div class="cart-item {{ $isStockError ? 'has-stock-error' : '' }}" id="cart-item-{{ $item->id }}">
                    <div class="cart-item-img">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                        @else
                            <div class="no-img">📦</div>
                        @endif
                    </div>

                    <div class="cart-item-info">
                        <div class="cart-item-name">{{ $item->product->name }}</div>
                        <div class="cart-item-price">
                            Rp {{ number_format($item->product->price, 0, ',', '.') }} / pcs
                        </div>

                        <div class="cart-item-subtotal">
                            Subtotal: Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </div>

                        @if($isStockError)
                            <div class="stock-warning-label">
                                Stok tersedia {{ $item->product->stock }} unit
                            </div>
                        @endif
                    </div>

                    <div class="cart-item-actions">
                        <div class="qty-control">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:contents">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                <button type="submit" class="qty-btn" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                    −
                                </button>
                            </form>

                            <span class="qty-display">{{ $item->quantity }}</span>

                            <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:contents">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                <button type="submit" class="qty-btn" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                    +
                                </button>
                            </form>
                        </div>

                        <button
                            type="button"
                            class="btn-trash"
                            onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->product->name) }}')"
                            aria-label="Hapus item"
                        >
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M2 4h11M5.5 4V2.5h4V4M6 7v4.5M9 7v4.5M3.5 4l.75 8.5h7.5L12.5 4"
                                      stroke="currentColor"
                                      stroke-width="1.4"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="cart-empty-minimal">
                    Belum ada item di keranjang.
                </div>
            @endforelse
        </div>

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
                <div class="summary-stock-warning">
                    Beberapa item melebihi stok tersedia. Sesuaikan jumlah sebelum checkout.
                </div>
                <button class="btn-checkout" disabled>Lanjut ke Checkout</button>
            @elseif($cartItems->isEmpty())
                <button class="btn-checkout" disabled>Lanjut ke Checkout</button>
            @else
                <a href="{{ route('checkout.index') }}" class="btn-checkout">Lanjut ke Checkout</a>
            @endif

            <p class="checkout-note">Gratis ongkir untuk semua pesanan</p>
        </aside>
    </div>
</div>

<div class="modal-overlay" id="deleteModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-box">
        <div class="modal-icon">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                <path d="M4 8h20M9.5 8V5.5h9V8M10.5 13v7.5M17.5 13v7.5M6.5 8l1.5 16h12l1.5-16"
                      stroke="#d97070"
                      stroke-width="1.9"
                      stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </div>

        <div class="modal-title" id="modalTitle">Hapus item ini?</div>
        <div class="modal-desc">Item berikut akan dihapus dari keranjang kamu:</div>
        <div class="modal-item-name" id="modalItemName">—</div>

        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
            <button type="button" class="btn-modal-confirm" id="modalConfirmBtn">Hapus Item</button>
        </div>
    </div>
</div>

@foreach($cartItems ?? [] as $item)
    <form
        id="delete-form-{{ $item->id }}"
        action="{{ route('cart.destroy', $item->id) }}"
        method="POST"
        style="display:none;"
    >
        @csrf
        @method('DELETE')
    </form>
@endforeach
@endsection

@section('scripts')
<script>
    let _pendingDeleteId = null;

    function openDeleteModal(itemId, itemName) {
        _pendingDeleteId = itemId;
        document.getElementById('modalItemName').textContent = itemName;
        document.getElementById('deleteModal').classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        _pendingDeleteId = null;
        document.getElementById('deleteModal').classList.remove('is-open');
        document.body.style.overflow = '';
    }

    document.getElementById('modalConfirmBtn').addEventListener('click', function () {
        if (_pendingDeleteId !== null) {
            document.getElementById('delete-form-' + _pendingDeleteId).submit();
        }
    });

    document.getElementById('deleteModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endsection