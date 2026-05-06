@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')
@section('page-subtitle', 'Tambahkan item baru ke katalog toko')

@section('content')
<div class="max-w-2xl">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
        <a href="{{ route('admin.products.index') }}" class="hover:text-emerald-600 transition-colors">Produk</a>
        <span>/</span>
        <span class="text-slate-600 font-medium">Tambah Baru</span>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-5">
        @csrf

        {{-- Nama Produk --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6 space-y-5">
            <h3 class="font-semibold text-slate-700 text-sm uppercase tracking-wide">Informasi Produk</h3>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Produk <span class="text-red-400">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       placeholder="Contoh: Jaket Denim Levis Vintage"
                       class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all @error('name') border-red-300 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Deskripsi <span class="text-red-400">*</span>
                </label>
                <textarea name="description" rows="4" required
                          placeholder="Deskripsikan kondisi, ukuran, bahan, atau detail penting lainnya..."
                          class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all resize-none @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Harga (Rp) <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">Rp</span>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0"
                               placeholder="0"
                               class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all @error('price') border-red-300 @enderror">
                    </div>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Stok <span class="text-red-400">*</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', 1) }}" required min="0"
                           placeholder="0"
                           class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all @error('stock') border-red-300 @enderror">
                    @error('stock')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Upload Gambar --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            <h3 class="font-semibold text-slate-700 text-sm uppercase tracking-wide mb-4">Foto Produk</h3>

            <div id="drop-zone"
                 class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center cursor-pointer hover:border-emerald-400 hover:bg-emerald-50/30 transition-all @error('image') border-red-300 @enderror"
                 onclick="document.getElementById('image-input').click()">

                {{-- Preview --}}
                <div id="image-preview" class="hidden mb-4">
                    <img id="preview-img" src="" alt="Preview" class="max-h-48 mx-auto rounded-xl object-cover">
                </div>

                {{-- Placeholder --}}
                <div id="upload-placeholder">
                    <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-slate-600">Klik untuk upload foto</p>
                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, JPEG — Maks. 2MB</p>
                </div>

                <input type="file" id="image-input" name="image" accept="image/*" class="hidden"
                       onchange="previewImage(this)">
            </div>
            <div id="file-name" class="text-xs text-slate-400 mt-2 text-center hidden"></div>

            @error('image')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="flex-1 sm:flex-none px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl text-sm transition-colors">
                Simpan Produk
            </button>
            <a href="{{ route('admin.products.index') }}"
               class="flex-1 sm:flex-none px-8 py-3 border border-slate-200 text-slate-600 font-medium rounded-xl text-sm text-center hover:bg-slate-50 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('upload-placeholder').classList.add('hidden');
            document.getElementById('file-name').textContent = file.name;
            document.getElementById('file-name').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

// Drag and Drop
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-emerald-400', 'bg-emerald-50/30'); });
dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('border-emerald-400', 'bg-emerald-50/30'); });
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.classList.remove('border-emerald-400', 'bg-emerald-50/30');
    const input = document.getElementById('image-input');
    input.files = e.dataTransfer.files;
    previewImage(input);
});
</script>
@endpush
@endsection
