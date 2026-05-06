@extends('layouts.admin')

@section('title', 'Edit Produk: ' . $product->name)

@section('content')
<div style="margin-bottom: 32px;">
    <a href="{{ route('admin.products.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none; margin-bottom: 8px; display: inline-block;">← Kembali ke Katalog</a>
    <h1 style="font-size: 1.75rem; font-family: var(--font-display);">Edit Informasi Produk</h1>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="name">Nama Produk</label>
                <input type="text" id="name" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Harga (Rp)</label>
                <input type="number" id="price" name="price" class="form-input @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required min="0">
            </div>

            <div class="form-group">
                <label class="form-label" for="stock">Sisa Stok</label>
                <input type="number" id="stock" name="stock" class="form-input @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" required min="0">
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="description">Deskripsi & Kondisi Barang</label>
                <textarea id="description" name="description" rows="5" class="form-input @error('description') is-invalid @enderror" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="image">Perbarui Foto Produk</label>
                @if($product->image)
                    <div style="margin-bottom: 12px; display: flex; align-items: center; gap: 16px;">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border);">
                        <span style="font-size: 0.8125rem; color: var(--text-muted);">Gambar saat ini. Mengunggah gambar baru akan menimpa gambar ini.</span>
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-input @error('image') is-invalid @enderror" accept="image/*" style="padding: 8px;">
                @error('image')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-solid">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
