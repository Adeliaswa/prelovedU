@extends('layouts.app')

@section('content')
    <h2>Admin - Detail Pesanan</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h3>Data Customer</h3>
    <p>Nama Akun: {{ $order->user->name }}</p>
    <p>Email: {{ $order->user->email }}</p>

    <h3>Data Pengiriman</h3>
    <p>Nama Penerima: {{ $order->receiver_name }}</p>
    <p>Alamat: {{ $order->address }}</p>
    <p>Nomor HP: {{ $order->phone_number }}</p>

    <h3>Status Pesanan</h3>
    <p>Status Saat Ini: {{ $order->status }}</p>

    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <select name="status">
            <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button type="submit">Update Status</button>
    </form>

    <h3>Produk Pesanan</h3>

    @foreach($order->orderDetails as $detail)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p>Produk: {{ $detail->product->name }}</p>
            <p>Harga: Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
            <p>Jumlah: {{ $detail->quantity }}</p>
            <p>Subtotal: Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
        </div>
    @endforeach

    <h3>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>

    <a href="{{ route('admin.orders.index') }}">Kembali</a>
@endsection