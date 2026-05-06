@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('styles')
<style>
    /* ===== ORDERS PAGE ===== */
    .orders-hero {
        padding: 48px 0 24px;
        border-bottom: 1px solid var(--border);
    }
    .orders-hero h1 {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--text-primary);
    }
    .orders-hero p {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-top: 4px;
    }

    .orders-content {
        padding: 40px 0 80px;
    }

    /* Order Cards */
    .order-card {
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 16px;
        background: var(--bg-card);
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .order-card:hover {
        border-color: rgba(0,0,0,0.25);
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 24px;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 8px;
    }
    .order-meta { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
    .order-id {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.01em;
    }
    .order-date {
        font-size: 0.8rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.01em;
    }
    .status-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        flex-shrink: 0;
    }
    .status-diproses  { background: #fffbeb; color: #b45309; }
    .status-dikirim   { background: #eff6ff; color: #1d4ed8; }
    .status-selesai   { background: #f0fdf4; color: #15803d; }
    .status-pending,
    .status-default   { background: #f9f9f9; color: #666; }

    /* Order Body */
    .order-card-body {
        padding: 20px 24px;
    }
    .order-items-preview {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 16px;
    }
    .order-preview-item {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
        color: var(--text-primary);
    }
    .order-preview-item span:first-child {
        color: var(--text-muted);
        flex: 1;
    }
    .order-preview-item span:last-child {
        font-weight: 500;
        white-space: nowrap;
    }

    .order-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-top: 1px solid var(--border);
        background: var(--bg-subtle);
        flex-wrap: wrap;
        gap: 8px;
    }
    .order-total-label { font-size: 0.8125rem; color: var(--text-muted); }
    .order-total-value { font-size: 1rem; font-weight: 700; color: var(--text-primary); }
    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-primary);
        text-decoration: none;
        transition: background 0.15s, border-color 0.15s;
        font-family: 'Poppins', sans-serif;
    }
    .btn-detail:hover {
        background: var(--text-primary);
        border-color: var(--text-primary);
        color: var(--bg-main);
        text-decoration: none;
    }

    /* Empty orders */
    .orders-empty {
        padding: 80px 0;
        text-align: center;
        color: var(--text-muted);
    }
    .orders-empty .empty-icon { font-size: 3rem; margin-bottom: 16px; opacity: 0.3; }
    .orders-empty h3 {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
    .orders-empty p { font-size: 0.875rem; margin-bottom: 24px; }
    .btn-shop {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 12px 24px;
        background: var(--text-primary);
        color: var(--bg-main);
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: opacity 0.15s;
        font-family: 'Poppins', sans-serif;
    }
    .btn-shop:hover { opacity: 0.8; text-decoration: none; color: var(--bg-main); }
</style>
@endsection

@section('content')
<div class="container">
    <div class="orders-hero">
        <h1>Riwayat Pesanan</h1>
        <p>Semua transaksi yang pernah kamu lakukan di PreloveU</p>
    </div>

    <div class="orders-content">
        @if($orders->isEmpty())
            <div class="orders-empty">
                <div class="empty-icon">📦</div>
                <h3>Belum ada pesanan</h3>
                <p>Kamu belum pernah melakukan pembelian. Yuk mulai belanja!</p>
                <a href="{{ route('products.index') }}" class="btn-shop">Mulai Belanja →</a>
            </div>
        @else
            @foreach($orders as $order)
            @php
                $statusClass = match($order->status) {
                    'diproses' => 'status-diproses',
                    'dikirim'  => 'status-dikirim',
                    'selesai'  => 'status-selesai',
                    default    => 'status-default',
                };
                $statusLabel = match($order->status) {
                    'diproses' => 'Diproses',
                    'dikirim'  => 'Dikirim',
                    'selesai'  => 'Selesai',
                    default    => ucfirst($order->status ?? 'Pending'),
                };
            @endphp
            <div class="order-card">
                <div class="order-card-header">
                    <div class="order-meta">
                        <span class="order-id">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <span class="order-date">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><rect x="1" y="2" width="10" height="9" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M4 1v2M8 1v2M1 5h10" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                    <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                </div>

                <div class="order-card-body">
                    <div class="order-items-preview">
                        @foreach($order->orderDetails->take(3) as $detail)
                        <div class="order-preview-item">
                            <span>{{ $detail->product->name ?? 'Produk' }} × {{ $detail->quantity }}</span>
                            <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                        @if($order->orderDetails->count() > 3)
                        <div style="font-size:0.8rem;color:var(--text-muted);">
                            +{{ $order->orderDetails->count() - 3 }} produk lainnya
                        </div>
                        @endif
                    </div>
                </div>

                <div class="order-card-footer">
                    <div>
                        <div class="order-total-label">Total Pembayaran</div>
                        <div class="order-total-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn-detail">
                        Lihat Detail →
                    </a>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection