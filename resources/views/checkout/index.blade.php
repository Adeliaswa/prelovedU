@extends('layouts.app')

@section('content')
    <h2>Checkout</h2>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <h3>Ringkasan Pesanan</h3>

    @foreach($carts as $cart)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p>Produk: {{ $cart->product->name }}</p>
            <p>Harga: Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
            <p>Jumlah: {{ $cart->quantity }}</p>
            <p>Subtotal: Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
        </div>
    @endforeach

    <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Penerima</label><br>
            <input type="text" name="receiver_name" value="{{ old('receiver_name') }}">
            @error('receiver_name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Alamat</label><br>
            <textarea name="address">{{ old('address') }}</textarea>
            @error('address')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Nomor HP</label><br>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}">
            @error('phone_number')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">Buat Pesanan</button>
    </form>
@endsection