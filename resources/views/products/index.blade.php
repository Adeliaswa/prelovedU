@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('styles')
<style>
    /* ===== PRODUCT LISTING PAGE ===== */
    .products-hero {
        padding: 48px 0 32px;
        border-bottom: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    @media (min-width: 768px) {
        .products-hero {
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
        }
    }

    .products-hero-text h1 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--text-primary);
        line-height: 1.2;
    }

    .products-hero-text p {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin-top: 6px;
    }

    /* Search Bar */
    .search-form {
        display: flex;
        gap: 8px;
        width: 100%;
        max-width: 400px;
    }

    .search-input {
        flex: 1;
        /* Mewarisi .form-input dari app.blade.php */
    }

    /* Grid Layout */
    .products-layout {
        padding: 40px 0 80px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 24px;
    }

    /* Product Card */
    .product-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: border-color var(--t-mid), box-shadow var(--t-mid), transform var(--t-mid);
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
    }

    .product-card:hover {
        border-color: rgba(0,0,0,0.2);
        box-shadow: 0 8px 24px rgba(0,0,0,0.04);
        transform: translateY(-2px);
    }

    .product-image-wrapper {
        aspect-ratio: 4/3;
        width: 100%;
        overflow: hidden;
        background: var(--bg-subtle);
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-faint);
        font-size: 0.875rem;
        background: var(--bg-subtle);
    }

    .product-info {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-name {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--text-primary);
        line-height: 1.4;
        margin-bottom: 6px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price {
        font-size: 1.0625rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 12px;
    }

    .product-meta {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 16px;
        flex: 1;
    }

    /* Empty State */
    .products-empty {
        grid-column: 1 / -1;
        padding: 80px 0;
        text-align: center;
        color: var(--text-muted);
        background: var(--bg-card);
        border: 1px dashed var(--border);
        border-radius: var(--radius-lg);
    }

    .products-empty h3 {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="products-hero">
        <div class="products-hero-text">
            <h1>Katalog Produk</h1>
            <p>Temukan barang preloved favoritmu dari sesama mahasiswa.</p>
        </div>
        
        <!-- Form Pencarian -->
        <form action="{{ route('products.index') }}" method="GET" class="search-form">
            <input type="text" name="search" class="form-input search-input" placeholder="Cari nama barang..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-solid">Cari</button>
        </form>
    </div>

    <div class="products-layout">
        @if(request('search'))
            <p style="margin-bottom: 20px; font-size: 0.875rem; color: var(--text-muted);">
                Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
            </p>
        @endif

        <div class="products-grid">
            <!-- Looping Data Produk -->
            @forelse($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-card">
                    <div class="product-image-wrapper">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="no-image">Tidak ada gambar</div>
                        @endif
                    </div>
                    
                    <div class="product-info">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="product-meta">
                            Sisa stok: {{ $product->stock }}
                        </div>
                        
                        <!-- Tombol Lihat Detail mengadopsi class btn-outline dari app.blade.php -->
                        <button class="btn btn-outline btn-full" style="pointer-events: none;">
                            Lihat Detail
                        </button>
                    </div>
                </a>
            @empty
                <!-- Tampilan Jika Produk Tidak Ditemukan -->
                <div class="products-empty">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; opacity: 0.4;">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <h3>Barang tidak ditemukan</h3>
                    <p>Coba gunakan kata kunci lain atau periksa kembali nanti saat ada barang baru.</p>
                    @if(request('search'))
                        <a href="{{ route('products.index') }}" class="btn btn-outline" style="margin-top: 16px;">Tampilkan Semua Barang</a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination (Opsional, jika menggunakan $products->links() di Backend) -->
        @if(method_exists($products, 'links'))
            <div style="margin-top: 40px;">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection