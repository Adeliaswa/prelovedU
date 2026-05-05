@extends('layouts.app')

@section('title', 'Pesanan Berhasil!')

@section('styles')
<style>
    .success-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 0;
    }
    .success-card {
        max-width: 520px;
        width: 100%;
        text-align: center;
        padding: 56px 48px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 20px;
    }
    .success-icon {
        width: 72px;
        height: 72px;
        background: #f0fdf4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 2rem;
    }
    .success-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    .success-card p {
        font-size: 0.9rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 32px;
    }
    .order-number-badge {
        display: inline-block;
        background: var(--bg-subtle);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 32px;
        letter-spacing: 0.02em;
    }
    .success-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .btn-primary {
        padding: 13px;
        background: var(--text-primary);
        color: var(--bg-main);
        border-radius: 9px;
        font-size: 0.9rem;
        font-weight: 600;
        font-family: var(--font);
        text-decoration: none;
        transition: opacity 0.15s, transform 0.15s;
        display: block;
    }
    .btn-primary:hover {
        opacity: 0.8;
        transform: translateY(-1px);
        text-decoration: none;
        color: var(--bg-main);
    }
    .btn-secondary {
        padding: 13px;
        background: transparent;
        color: var(--text-muted);
        border: 1.5px solid var(--border);
        border-radius: 9px;
        font-size: 0.9rem;
        font-weight: 600;
        font-family: var(--font);
        text-decoration: none;
        transition: border-color 0.15s, color 0.15s;
        display: block;
    }
    .btn-secondary:hover {
        border-color: var(--text-primary);
        color: var(--text-primary);
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="success-page">
        <div class="success-card">
            <div class="success-icon">✓</div>
            <h1>Pesanan Berhasil!</h1>
            <p>Terima kasih sudah belanja di PreloveU. Pesananmu sedang diproses oleh tim kami.</p>
            @if(isset($order))
                <div class="order-number-badge">
                    Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                </div>
            @endif
            <div class="success-actions">
                <a href="{{ route('orders.index') }}" class="btn-primary">Lihat Pesanan</a>
                <a href="{{ route('products.index') }}" class="btn-secondary">Lanjut Belanja</a>
            </div>
        </div>
    </div>
</div>
@endsection