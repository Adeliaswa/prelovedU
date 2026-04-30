@extends('layouts.app')

@section('content')
    <h2>Detail Pesanan</h2>

    <p>Nama Penerima: {{ $order->receiver_name }}</p>
    <p>Alamat: {{ $order->address }}</p>
    <p>Nomor HP: {{ $order->phone_number }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

    <h3>Produk</h3>

    @foreach($order->orderDetails as $detail)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p>Produk: {{ $detail->product->name }}</p>
            <p>Harga: Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
            <p>Jumlah: {{ $detail->quantity }}</p>
            <p>Subtotal: Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
        </div>
    @endforeach

    <a href="{{ route('orders.index') }}">Kembali</a>
@endsection