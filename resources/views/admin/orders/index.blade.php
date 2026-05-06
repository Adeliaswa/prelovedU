@extends('layouts.admin')

@section('title', 'Admin - Daftar Pesanan')

@section('styles')
<style>
    /* Styling khusus jika layout admin belum memuatnya secara penuh */
    .status-badge {
        padding: 4px 10px;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
    }
    .status-pending { background: var(--bg-subtle, #f4f4f4); color: var(--text-muted, #888888); }
    .status-diproses { background: #fef08a; color: #a16207; } /* Kuning */
    .status-dikirim { background: #bfdbfe; color: #1d4ed8; } /* Biru */
    .status-selesai { background: var(--green-bg, #f0fdf4); color: var(--green, #16a34a); } /* Hijau */
</style>
@endsection

@section('content')
<div style="margin-bottom: 32px; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h1 style="font-size: 1.75rem; font-family: var(--font-display); color: var(--text-primary);">Daftar Pesanan Pelanggan</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Kelola dan pantau seluruh transaksi yang masuk ke sistem.</p>
    </div>
</div>

<!-- Alert Notifikasi -->
@if(session('success'))
    <div style="padding: 12px 16px; background: var(--green-bg, #f0fdf4); color: var(--green, #16a34a); border: 1px solid var(--green, #16a34a); border-radius: var(--radius-sm, 6px); margin-bottom: 24px; font-size: 0.875rem; font-weight: 500;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 4px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        {{ session('success') }}
    </div>
@endif

<!-- Tabel Pesanan -->
<div class="card" style="padding: 0; overflow-x: auto; background: var(--bg-card, #ffffff); border: 1px solid var(--border, #e5e5e5); border-radius: var(--radius-lg, 16px);">
    <table class="admin-table" style="width: 100%; border-collapse: collapse; margin-top: 0;">
        <thead style="background: var(--bg-subtle, #f4f4f4);">
            <tr>
                <th style="padding: 16px 24px; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">ID Pesanan</th>
                <th style="padding: 16px; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Pelanggan</th>
                <th style="padding: 16px; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Tanggal</th>
                <th style="padding: 16px; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Total Bayar</th>
                <th style="padding: 16px; text-align: left; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Status</th>
                <th style="padding: 16px 24px; text-align: right; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($orders->count() > 0)
                @foreach($orders as $order)
                <tr style="border-top: 1px solid var(--border, #e5e5e5);">
                    <td style="padding: 16px 24px; font-weight: 600; color: var(--text-primary);">
                        #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                    </td>
                    <td style="padding: 16px;">
                        <div style="font-weight: 500; color: var(--text-primary);">{{ $order->user->name ?? 'Anonim' }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $order->user->email ?? '-' }}</div>
                    </td>
                    <td style="padding: 16px; color: var(--text-muted); font-size: 0.875rem;">
                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}
                    </td>
                    <td style="padding: 16px; font-weight: 600; color: var(--text-primary);">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td style="padding: 16px;">
                        <!-- Logika Pewarnaan Badge Status -->
                        @php
                            $statusClass = 'status-pending'; // Default
                            $statusText = strtolower($order->status);
                            if (in_array($statusText, ['diproses', 'dikemas'])) $statusClass = 'status-diproses';
                            if (in_array($statusText, ['dikirim', 'perjalanan'])) $statusClass = 'status-dikirim';
                            if (in_array($statusText, ['selesai', 'diterima'])) $statusClass = 'status-selesai';
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding: 16px 24px; text-align: right;">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-outline" style="padding: 6px 12px; font-size: 0.8125rem; border: 1.5px solid var(--border, #ccc); border-radius: 6px; text-decoration: none; color: var(--text-primary); font-weight: 600; transition: 0.2s;">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center; padding: 48px 0; color: var(--text-muted);">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; opacity: 0.5;"><circle cx="12" cy="12" r="10"></circle><path d="M16 16s-1.5-2-4-2-4 2-4 2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                        <p>Belum ada pesanan.</p>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
