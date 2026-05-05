@extends('layouts.app')

@section('title', 'Detail Pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('styles')
<style>
    /* ===== ORDER DETAIL PAGE ===== */
    .order-detail-hero {
        padding: 48px 0 28px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 12px;
    }
    .order-detail-hero h1 {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--text-primary);
    }
    .order-detail-hero p { font-size: 0.875rem; color: var(--text-muted); margin-top: 4px; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 99px;
        font-size: 0.8125rem;
        font-weight: 600;
    }
    .status-badge::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }
    .status-diproses  { background: #fffbeb; color: #b45309; }
    .status-dikirim   { background: #eff6ff; color: #1d4ed8; }
    .status-selesai   { background: #f0fdf4; color: #15803d; }
    .status-default   { background: #f9f9f9; color: #666; }

    .order-detail-content {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 32px;
        padding: 40px 0 80px;
    }
    @media (max-width: 768px) {
        .order-detail-content { grid-template-columns: 1fr; }
    }

    /* Order Items Table */
    .section-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .section-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-card-header h3 {
        font-size: 0.875rem;
        font-weight: 700;
        letter-spacing: -0.01em;
        color: var(--text-primary);
    }
    .item-count {
        font-size: 0.75rem;
        background: var(--bg-subtle);
        color: var(--text-muted);
        padding: 2px 8px;
        border-radius: 99px;
        font-weight: 600;
    }

    .order-items-table { width: 100%; }
    .order-items-table thead tr th {
        padding: 12px 24px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--text-muted);
        background: var(--bg-subtle);
        text-align: left;
    }
    .order-items-table thead tr th:last-child { text-align: right; }
    .order-items-table tbody tr td {
        padding: 16px 24px;
        font-size: 0.875rem;
        color: var(--text-primary);
        border-top: 1px solid var(--border);
        vertical-align: middle;
    }
    .order-items-table tbody tr td:last-child { text-align: right; font-weight: 600; }
    .product-name-cell { font-weight: 500; }
    .product-price-cell { color: var(--text-muted); }

    .order-items-table tfoot tr td {
        padding: 16px 24px;
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-primary);
        border-top: 2px solid var(--border);
    }
    .order-items-table tfoot tr td:last-child { text-align: right; }

    /* Info Sidebar */
    .info-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 16px;
        position: sticky;
        top: 100px;
    }
    .info-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border);
        font-size: 0.8125rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--text-muted);
    }
    .info-card-body { padding: 20px; }
    .info-row {
        display: flex;
        flex-direction: column;
        gap: 3px;
        margin-bottom: 16px;
    }
    .info-row:last-child { margin-bottom: 0; }
    .info-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .info-value {
        font-size: 0.875rem;
        color: var(--text-primary);
        font-weight: 500;
        line-height: 1.4;
    }

    .btn-back-orders {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8125rem;
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.15s;
        margin-top: 4px;
    }
    .btn-back-orders:hover { color: var(--text-primary); text-decoration: none; }
</style>
@endsection

@section('content')
<div class="container">
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

    <div class="order-detail-hero">
        <div>
            <a href="{{ route('orders.index') }}" class="btn-back-orders">← Riwayat Pesanan</a>
            <h1>Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
            <p>{{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
    </div>

    <div class="order-detail-content">
        {{-- Items --}}
        <div>
            <div class="section-card">
                <div class="section-card-header">
                    <h3>Item Pesanan</h3>
                    <span class="item-count">{{ $order->orderDetails->count() }} item</span>
                </div>
                <table class="order-items-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $detail)
                        <tr>
                            <td class="product-name-cell">{{ $detail->product->name ?? 'Produk tidak tersedia' }}</td>
                            <td class="product-price-cell">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Pembayaran</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Info Sidebar --}}
        <aside>
            <div class="info-card">
                <div class="info-card-header">Info Pengiriman</div>
                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Penerima</span>
                        <span class="info-value">{{ $order->receiver_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Alamat</span>
                        <span class="info-value">{{ $order->address }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nomor HP</span>
                        <span class="info-value">{{ $order->phone_number }}</span>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">Info Pesanan</div>
                <div class="info-card-body">
                    <div class="info-row">
                        <span class="info-label">Nomor Pesanan</span>
                        <span class="info-value">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tanggal Pesan</span>
                        <span class="info-value">{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            <span class="status-badge {{ $statusClass }}" style="font-size:0.75rem;padding:4px 10px;">{{ $statusLabel }}</span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Total</span>
                        <span class="info-value" style="font-size:1rem;font-weight:700;">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection