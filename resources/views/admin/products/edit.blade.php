@extends('layouts.admin')

@section('title', 'Edit Produk: ' . $product->name)

@section('content')
<div style="margin-bottom: 32px;">
    <a href="{{ route('admin.products.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none; margin-bottom: 8px; display: inline-block;">
        ← Kembali ke Katalog
    </a>
    <h1 style="font-size: 1.75rem; font-family: var(--font-display); color: var(--text-primary);">
        Edit Informasi Produk
    </h1>
    <p style="color: var(--text-muted); font-size: 0.875rem;">
        Perbarui rincian data untuk produk: <strong>{{ $product->name }}</strong>
    </p>
</div>

<div class="card" style="max-width: 800px;">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            
            <!-- Nama Produk -->
            <div class="form-group" style="grid-column: 1 / -1; display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="name" style="font-weight: 500; font-size: 0.875rem;">
                    Nama Produk <span style="color: var(--red);">*</span>
                </label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $product->name) }}" required style="padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none;">
                @error('name')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Harga -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="price" style="font-weight: 500; font-size: 0.875rem;">
                    Harga (Rp) <span style="color: var(--red);">*</span>
                </label>
                <div style="position: relative; display: flex; align-items: center;">
                    <span style="position: absolute; left: 12px; font-size: 0.875rem; color: var(--text-muted); font-weight: 600;">Rp</span>
                    <input type="number" id="price" name="price" class="form-input" value="{{ old('price', $product->price) }}" required min="0" style="width: 100%; padding: 12px 12px 12px 36px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none;">
                </div>
                @error('price')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Stok -->
            <div class="form-group" style="display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="stock" style="font-weight: 500; font-size: 0.875rem;">
                    Sisa Stok <span style="color: var(--red);">*</span>
                </label>
                <input type="number" id="stock" name="stock" class="form-input" value="{{ old('stock', $product->stock) }}" required min="0" style="padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none;">
                @error('stock')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Deskripsi -->
            <div class="form-group" style="grid-column: 1 / -1; display: flex; flex-direction: column; gap: 8px;">
                <label class="form-label" for="description" style="font-weight: 500; font-size: 0.875rem;">
                    Deskripsi & Kondisi Barang <span style="color: var(--red);">*</span>
                </label>
                <textarea id="description" name="description" rows="5" class="form-input" required style="padding: 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none; resize: vertical;">{{ old('description', $product->description) }}</textarea>
                @error('description')<span style="color: var(--red); font-size: 0.75rem;">{{ $message }}</span>@enderror
            </div>

            <!-- Foto Produk (Drag & Drop UI) -->
            <div class="form-group" style="grid-column: 1 / -1; padding: 24px; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px solid var(--border);">
                <h3 style="font-weight: 600; font-size: 0.875rem; text-transform: uppercase; margin-bottom: 16px; color: var(--text-primary);">Foto Produk</h3>

                <!-- Foto Saat Ini -->
                @if($product->image)
                <div style="margin-bottom: 16px; padding: 12px; background: var(--bg-subtle); border-radius: var(--radius-sm); display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 64px; height: 64px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border);">
                    <div>
                        <p style="font-size: 0.75rem; font-weight: 600; color: var(--text-primary);">Foto saat ini</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">Upload baru untuk mengganti</p>
                    </div>
                </div>
                @endif

                <!-- Area Upload (Interaktif) -->
                <div id="drop-zone" style="border: 2px dashed var(--border); border-radius: var(--radius-sm); padding: 32px; text-align: center; cursor: pointer; transition: all 0.2s; background: var(--bg-main);" onclick="document.getElementById('image-input').click()">
                    
                    <div id="image-preview" style="display: none; margin-bottom: 12px;">
                        <img id="preview-img" src="" alt="Preview" style="max-height: 160px; margin: 0 auto; border-radius: 8px; object-fit: cover; border: 1px solid var(--border);">
                    </div>

                    <div id="upload-placeholder">
                        <svg style="width: 32px; height: 32px; color: var(--text-muted); margin: 0 auto 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p style="font-size: 0.875rem; color: var(--text-muted);">Klik atau drag foto baru ke area ini</p>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">PNG, JPG — Maks. 2MB (Opsional)</p>
                    </div>

                    <input type="file" id="image-input" name="image" accept="image/*" style="display: none;" onchange="previewImage(this)">
                </div>

                @error('image')
                    <p style="color: var(--red); font-size: 0.75rem; margin-top: 8px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 12px;">
            <a href="{{ route('admin.products.index') }}" class="btn-outline">
                Batalkan
            </a>
            <button type="submit" class="btn-solid">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Script Dipertahankan dan Disesuaikan -->
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block'; // Ubah dari class hidden ke display block
            document.getElementById('upload-placeholder').style.display = 'none'; // Sembunyikan placeholder
        };
        reader.readAsDataURL(input.files[0]);
    }
}

const dropZone = document.getElementById('drop-zone');

dropZone.addEventListener('dragover', e => { 
    e.preventDefault(); 
    dropZone.style.borderColor = 'var(--text-primary)'; 
    dropZone.style.backgroundColor = 'var(--bg-subtle)';
});

dropZone.addEventListener('dragleave', () => {
    dropZone.style.borderColor = 'var(--border)';
    dropZone.style.backgroundColor = 'var(--bg-main)';
});

dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--border)';
    dropZone.style.backgroundColor = 'var(--bg-main)';
    
    const input = document.getElementById('image-input');
    input.files = e.dataTransfer.files;
    previewImage(input);
});
</script>
@endsection
