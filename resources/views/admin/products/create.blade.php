@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div style="margin-bottom: 32px;">
    <a href="{{ route('admin.products.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none; margin-bottom: 8px; display: inline-block;">
        ← Kembali ke Katalog
    </a>
    <h1 style="font-size: 1.75rem; font-family: var(--font-display); color: var(--text-primary);">
        Tambah Barang Baru
    </h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;">
        Masukkan rincian data untuk produk baru yang akan didaftarkan ke sistem.
    </p>
</div>

<div class="card" style="max-width: 800px;">
    <!-- Form Action secara absolut mengarah ke method store di Controller dengan metode POST -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            
            <!-- Nama Produk -->
            <div class="form-group" style="grid-column: 1 / -1; display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="name" style="font-weight: 500; font-size: 0.875rem;">
                    Nama Produk <span style="color: var(--red);">*</span>
                </label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required style="padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none;">
                @error('name')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Harga -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="price" style="font-weight: 500; font-size: 0.875rem;">
                    Harga (Rp) <span style="color: var(--red);">*</span>
                </label>
                <div style="position: relative; display: flex; align-items: center;">
                    <span style="position: absolute; left: 12px; font-size: 0.875rem; color: var(--text-muted); font-weight: 600;">Rp</span>
                    <input type="number" id="price" name="price" class="form-input" value="{{ old('price') }}" required min="0" style="width: 100%; padding: 12px 12px 12px 36px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none;">
                </div>
                @error('price')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Stok -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="stock" style="font-weight: 500; font-size: 0.875rem;">
                    Stok Awal <span style="color: var(--red);">*</span>
                </label>
                <input type="number" id="stock" name="stock" class="form-input" value="{{ old('stock', 1) }}" required min="1" style="padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none;">
                @error('stock')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Deskripsi -->
            <div class="form-group" style="grid-column: 1 / -1; display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="description" style="font-weight: 500; font-size: 0.875rem;">
                    Deskripsi & Kondisi Barang <span style="color: var(--red);">*</span>
                </label>
                <textarea id="description" name="description" rows="5" class="form-input" required style="padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none; resize: vertical;">{{ old('description') }}</textarea>
                @error('description')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Foto Produk -->
            <div class="form-group" style="grid-column: 1 / -1; padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-sm); border: 1px dashed var(--text-muted);">
                <label class="form-label" for="image" style="font-weight: 600; font-size: 0.875rem; display: block; margin-bottom: 12px;">
                    Unggah Foto Produk (Opsional)
                </label>
                
                <input type="file" id="image" name="image" class="form-input" accept="image/*" style="width: 100%; padding: 8px; background: var(--bg-card); border-radius: 4px;">
                <span style="display: block; margin-top: 8px; font-size: 0.75rem; color: var(--text-muted);">Format didukung: JPG, PNG, JPEG. Maksimal ukuran memori: 2MB.</span>
                @error('image')<span style="display: block; margin-top: 4px; color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Tombol Aksi Eksekusi -->
        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 12px;">
            <button type="reset" class="btn-outline">
                Reset Form
            </button>
            <button type="submit" class="btn-solid">
                Simpan Produk
            </button>
        </div>
    </form>
</div>
@endsection
