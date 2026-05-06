@extends('layouts.app')

@section('title', $product->name . ' - PreloveU')

@section('styles')
<style>
    /* ===== PRODUCT DETAIL PAGE ===== */
    .product-detail-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        padding: 24px 0 80px;
    }
    
    @media (max-width: 768px) {
        .product-detail-layout {
            grid-template-columns: 1fr;
            gap: 32px;
        }
    }

    /* Bagian Gambar */
    .product-image-wrapper {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        color: var(--text-muted);
        font-size: 1rem;
        background: var(--bg-subtle);
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Bagian Informasi */
    .product-details {
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-family: var(--font-display);
        font-size: 2.25rem;
        color: var(--text-primary);
        line-height: 1.2;
        margin-bottom: 12px;
        letter-spacing: -0.02em;
    }

    .product-price {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 24px;
    }

    .product-meta {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
        align-items: center;
    }

    .product-desc-title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
        letter-spacing: -0.01em;
    }

    .product-desc-text {
        font-size: 0.875rem;
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 32px;
        white-space: pre-wrap; /* Mempertahankan enter/baris baru dari database */
    }

    .action-container {
        margin-top: auto;
        padding-top: 24px;
    }

    /* Tombol Kembali */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.875rem;
        color: var(--text-muted);
        text-decoration: none;
        margin-bottom: 16px;
        transition: color var(--t-fast);
        padding-top: 24px;
    }
    
    .btn-back:hover {
        color: var(--text-primary);
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Tombol Kembali (sesuai kerangka Anda) -->
    <a href="{{ route('products.index') }}" class="btn-back">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Kembali ke daftar produk
    </a>

    <div class="product-detail-layout">
        <!-- Kiri: Gambar Produk -->
        <div class="product-image-wrapper">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
            @else
                <div class="no-image">Tidak ada gambar tersedia</div>
            @endif
        </div>

        <!-- Kanan: Detail Produk -->
        <div class="product-details">
            <h1 class="product-title">{{ $product->name }}</h1>
            
            <div class="product-price">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>
            
            <!-- Menggunakan komponen badge dari layout/app.blade.php -->
            <div class="product-meta">
                <span class="badge badge-neutral">Stok: {{ $product->stock }}</span>
                @if($product->stock > 0)
                    <span class="badge badge-green">Tersedia</span>
                @else
                    <span class="badge" style="background: var(--red-bg); color: var(--red);">Habis</span>
                @endif
            </div>

            <!-- Menggunakan komponen divider dari layout/app.blade.php -->
            <div class="divider"></div>

            <div>
                <h3 class="product-desc-title">Deskripsi Barang</h3>
                <!-- Tag p untuk deskripsi sesuai kerangka -->
                <p class="product-desc-text">{{ $product->description }}</p>
            </div>

            <!-- Form Tambah ke Keranjang -->
            <div class="action-container">
                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                    @csrf
                    <!-- Logika tambahan: Jika stok 0, tombol disabled agar tidak error di backend -->
                    <button type="submit" class="btn btn-solid btn-full btn-lg" {{ $product->stock < 1 ? 'disabled' : '' }}>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                            <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        {{ $product->stock < 1 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection