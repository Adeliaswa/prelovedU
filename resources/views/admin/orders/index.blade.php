@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
<div style="margin-bottom: 32px;">
    <h1 style="font-size: 1.75rem; font-family: var(--font-display);">Pesanan Masuk</h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;">Pantau dan proses pesanan dari pelanggan.</p>
</div>

@if(session('success'))
    <div style="padding: 12px 16px; background: var(--green-bg); color: var(--green); border: 1px solid var(--green); border-radius: var(--radius-sm); margin-bottom: 24px; font-size: 0.875rem; font-weight: 500;">
        {{ session('success') }}
    </div>
@endif

<div class="card" style="padding: 0; overflow-x: auto;">
    <table class="admin-table" style="margin-top: 0;">
        <thead>
            <tr>
                <th style="padding-left: 24px;">ID Pesanan</th>
                <th>Tanggal</th>
                <th>Pembeli (Penerima)</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th style="padding-right: 24px; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="padding-left: 24px; font-weight: 600;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                <td style="color: var(--text-muted);">{{ $order->created_at->format('d M Y, H:i') }}</td>
                <td>
                    <div style="font-weight: 500;">{{ $order->receiver_name }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $order->phone_number }}</div>
                </td>
                <td style="font-weight: 600;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td>
                    @php
                        $bg = match($order->status) {
                            'pending' => 'var(--bg-subtle)',
                            'diproses' => 'var(--yellow-bg)',
                            'dikirim' => 'var(--blue-bg)',
                            'selesai' => 'var(--green-bg)',
                            default => 'var(--bg-subtle)'
                        };
                        $color = match($order->status) {
                            'pending' => 'var(--text-muted)',
                            'diproses' => 'var(--yellow)',
                            'dikirim' => 'var(--blue)',
                            'selesai' => 'var(--green)',
                            default => 'var(--text-muted)'
                        };
                    @endphp
                    <span style="padding: 4px 10px; border-radius: 99px; font-size: 0.75rem; font-weight: 700; background: {{ $bg }}; color: {{ $color }}; text-transform: uppercase;">
                        {{ $order->status }}
                    </span>
                </td>
                <td style="padding-right: 24px; text-align: right;">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-outline" style="padding: 6px 12px; font-size: 0.8125rem;">Proses / Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 48px 0;">Belum ada data pesanan dalam sistem.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
