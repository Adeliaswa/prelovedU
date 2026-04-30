@extends('layouts.app')

@section('content')
<h1>{{ $product->name }}</h1>

@if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" width="300">
@endif

<p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
<p>Stok: {{ $product->stock }}</p>
<p>Deskripsi:</p>
<p>{{ $product->description }}</p>

<form action="{{ route('cart.store', $product->id) }}" method="POST">
    @csrf
    <button type="submit">
        Tambah ke Keranjang
    </button>
</form>

<a href="{{ route('products.index') }}">Kembali ke daftar produk</a>
@endsection