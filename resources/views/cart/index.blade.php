@extends('layouts.app')

@section('content')
    <h2>Keranjang Belanja</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if($carts->count() > 0)
        @foreach($carts as $cart)
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h3>{{ $cart->product->name }}</h3>
                <p>Harga: Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                <p>Stok: {{ $cart->product->stock }}</p>

                <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1">
                    <button type="submit">Update</button>
                </form>

                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" style="margin-top: 5px;">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Hapus</button>
                </form>

                <p>Subtotal: Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
            </div>
        @endforeach

        <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>

        <a href="{{ route('checkout.index') }}">Lanjut Checkout</a>
    @else
        <p>Keranjang masih kosong.</p>
    @endif
@endsection