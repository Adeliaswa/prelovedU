@extends('layouts.app')

@section('content')
<h1>Daftar Produk PreloveU</h1>

<form action="{{ route('products.index') }}" method="GET">
    <input type="text" name="search" placeholder="Cari produk..." value="{{ $keyword }}">
    <button type="submit">Cari</button>
</form>

<hr>

@if($products->count())
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;">
        @foreach($products as $product)
            <div style="border: 1px solid #ddd; padding: 12px;">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" width="100%">
                @endif

                <h3>{{ $product->name }}</h3>
                <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Stok: {{ $product->stock }}</p>

                <a href="{{ route('products.show', $product->id) }}">Lihat Detail</a>
            </div>
        @endforeach
    </div>

    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
@else
    <p>Produk tidak ditemukan.</p>
@endif
@endsection