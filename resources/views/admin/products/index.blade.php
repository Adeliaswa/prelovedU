@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page-title', 'Manajemen Produk')
@section('page-subtitle', 'Kelola semua produk yang tersedia di toko')

@section('content')
<div class="space-y-5">

    {{-- Header Action --}}
    <div class="flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
        {{-- Search --}}
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex gap-2">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari produk..."
                       class="pl-9 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 w-64 focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all">
            </div>
            <button type="submit"
                    class="px-4 py-2.5 bg-slate-700 text-white text-sm font-medium rounded-xl hover:bg-slate-800 transition-colors">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.products.index') }}"
                   class="px-4 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition-colors">
                    Reset
                </a>
            @endif
        </form>

        {{-- Tambah Produk --}}
        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <p class="text-sm text-slate-500">
                Menampilkan <span class="font-semibold text-slate-700">{{ $products->count() }}</span> produk
                @if(request('search'))dari pencarian "{{ request('search') }}"@endif
            </p>
        </div>

        <div class="overflow-x-auto">
            @if($products->count() > 0)
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide w-12">#</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Produk</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Harga</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Stok</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                        <th class="text-right px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($products as $product)
                    <tr class="hover:bg-slate-50/60 transition-colors" id="row-{{ $product->id }}">
                        <td class="px-6 py-4">
                            <span class="text-xs text-slate-400 font-mono">{{ $product->id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                {{-- Product image --}}
                                <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0 bg-slate-100">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 truncate max-w-48">{{ $product->name }}</p>
                                    <p class="text-xs text-slate-400 truncate max-w-48 mt-0.5">{{ Str::limit($product->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-slate-800">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium {{ $product->stock <= 5 ? 'text-red-600' : 'text-slate-700' }}">
                                {{ $product->stock }} pcs
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($product->stock > 0)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-lg">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-50 text-red-700 text-xs font-semibold rounded-lg">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    Habis
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-medium rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                                {{-- Hidden delete form --}}
                                <form id="delete-form-{{ $product->id }}"
                                      action="{{ route('admin.products.destroy', $product->id) }}"
                                      method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="py-20 text-center">
                <svg class="w-14 h-14 text-slate-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <p class="text-slate-500 font-medium">
                    @if(request('search')) Produk "{{ request('search') }}" tidak ditemukan
                    @else Belum ada produk @endif
                </p>
                <a href="{{ route('admin.products.create') }}"
                   class="inline-block mt-4 text-emerald-600 text-sm font-semibold hover:underline">
                    + Tambah produk pertama
                </a>
            </div>
            @endif
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="delete-modal" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 animate-in">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 text-center mb-2">Hapus Produk?</h3>
        <p class="text-slate-500 text-sm text-center mb-6">
            Produk "<span id="delete-product-name" class="font-semibold text-slate-700"></span>" akan dihapus permanen dan tidak bisa dipulihkan.
        </p>
        <div class="flex gap-3">
            <button onclick="closeModal()"
                    class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-medium hover:bg-slate-50 transition-colors">
                Batal
            </button>
            <button id="confirm-delete-btn"
                    class="flex-1 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white text-sm font-semibold transition-colors">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
let deleteId = null;

function confirmDelete(id, name) {
    deleteId = id;
    document.getElementById('delete-product-name').textContent = name;
    document.getElementById('delete-modal').classList.remove('hidden');
    document.getElementById('delete-modal').classList.add('flex');
}

function closeModal() {
    document.getElementById('delete-modal').classList.add('hidden');
    document.getElementById('delete-modal').classList.remove('flex');
    deleteId = null;
}

document.getElementById('confirm-delete-btn').addEventListener('click', function() {
    if (deleteId) {
        document.getElementById('delete-form-' + deleteId).submit();
    }
});

// Close modal on backdrop click
document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
@endpush
@endsection
