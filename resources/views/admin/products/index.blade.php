@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
    <div>
        <h1 style="font-size: 1.75rem; font-family: var(--font-display);">Katalog Produk</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Kelola seluruh inventaris barang bekas.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn-solid">
        + Tambah Produk Baru
    </a>
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
                <th style="padding-left: 24px;">Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th style="padding-right: 24px; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td style="padding-left: 24px;">
                    <div style="width: 48px; height: 48px; border-radius: 6px; overflow: hidden; background: var(--bg-subtle);">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Img" style="width: 100%; height: 100%; object-fit: cover;">
                        @endif
                    </div>
                </td>
                <td style="font-weight: 500;">{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <span style="padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600; {{ $product->stock > 0 ? 'background: var(--green-bg); color: var(--green);' : 'background: var(--red-bg); color: var(--red);' }}">
                        {{ $product->stock }} Pcs
                    </span>
                </td>
                <td style="padding-right: 24px; text-align: right; display: flex; justify-content: flex-end; gap: 8px;">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-outline" style="padding: 6px 12px;">Edit</a>
                    
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-outline" style="padding: 6px 12px; border-color: var(--red); color: var(--red);">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 48px 0;">Tidak ada produk dalam sistem.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection