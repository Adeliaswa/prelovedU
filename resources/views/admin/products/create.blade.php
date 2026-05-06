@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div style="margin-bottom: 32px;">
    <a href="{{ route('admin.products.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none; margin-bottom: 8px; display: inline-block;">← Kembali ke Katalog</a>
    <h1 style="font-size: 1.75rem; font-family: var(--font-display);">Tambah Barang Baru</h1>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="name">Nama Produk</label>
                <input type="text" id="name" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Harga (Rp)</label>
                <input type="number" id="price" name="price" class="form-input @error('price') is-invalid @enderror" value="{{ old('price') }}" required min="0">
                @error('price')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="stock">Stok Awal</label>
                <input type="number" id="stock" name="stock" class="form-input @error('stock') is-invalid @enderror" value="{{ old('stock', 1) }}" required min="1">
                @error('stock')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="description">Deskripsi & Kondisi Barang</label>
                <textarea id="description" name="description" rows="5" class="form-input @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label" for="image">Foto Produk (Opsional)</label>
                <input type="file" id="image" name="image" class="form-input @error('image') is-invalid @enderror" accept="image/*" style="padding: 8px;">
                <span style="font-size: 0.75rem; color: var(--text-muted);">Format didukung: JPG, PNG, JPEG. Maks 2MB.</span>
                @error('image')<br><span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 12px;">
            <button type="reset" class="btn-outline">Reset Form</button>
            <button type="submit" class="btn-solid">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
