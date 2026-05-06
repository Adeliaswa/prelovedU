@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .stat-card {
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .stat-title {
        font-size: 0.8125rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        font-weight: 600;
    }

    .stat-value {
        font-size: 2rem;
        font-family: var(--font-display);
        color: var(--text-primary);
        line-height: 1;
    }
</style>
@endsection

@section('content')
<div style="margin-bottom: 32px;">
    <h1 style="font-size: 1.75rem; font-family: var(--font-display);">Ringkasan Sistem</h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;">Status terkini dari platform PreloveU.</p>
</div>

<div class="stats-grid">
    <div class="card stat-card">
        <span class="stat-title">Total Produk Aktif</span>
        <span class="stat-value">{{ $totalProducts ?? 0 }}</span>
    </div>
    
    <div class="card stat-card">
        <span class="stat-title">Pesanan Masuk</span>
        <span class="stat-value">{{ $totalOrders ?? 0 }}</span>
    </div>

    <div class="card stat-card">
        <span class="stat-title">Pendapatan (Selesai)</span>
        <span class="stat-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</span>
    </div>
</div>

<div class="card">
    <h3 style="font-size: 1rem; margin-bottom: 16px;">Pesanan Terbaru</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Pembeli</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders ?? [] as $order)
            <tr>
                <td>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $order->receiver_name }}</td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td>
                    <span style="padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; background: var(--bg-subtle);">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" style="color: var(--text-primary); font-weight: 600; font-size: 0.8125rem;">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted);">Belum ada pesanan terbaru.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection