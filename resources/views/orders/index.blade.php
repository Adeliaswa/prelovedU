@extends('layouts.app')

@section('content')
    <h2>Riwayat Pesanan</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <p>Order ID: {{ $order->id }}</p>
                <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Tanggal: {{ $order->created_at }}</p>

                <a href="{{ route('orders.show', $order->id) }}">Lihat Detail</a>
            </div>
        @endforeach
    @else
        <p>Belum ada pesanan.</p>
    @endif
@endsection