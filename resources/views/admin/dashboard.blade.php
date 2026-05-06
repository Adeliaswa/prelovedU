@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan aktivitas toko prelovedU')

@section('content')
<div class="space-y-6">

    {{-- ===== STAT CARDS ===== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        {{-- Total Produk --}}
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-1 rounded-lg">Produk</span>
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ $totalProducts }}</p>
            <p class="text-slate-400 text-sm mt-1">Total item terdaftar</p>
        </div>

        {{-- Total Pesanan --}}
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg">Pesanan</span>
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ $totalOrders }}</p>
            <p class="text-slate-400 text-sm mt-1">Total pesanan masuk</p>
        </div>

        {{-- Diproses --}}
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-amber-500 bg-amber-50 px-2 py-1 rounded-lg">Pending</span>
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ $pendingOrders }}</p>
            <p class="text-slate-400 text-sm mt-1">Menunggu diproses</p>
        </div>

        {{-- Selesai --}}
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-1 rounded-lg">Selesai</span>
            </div>
            <p class="text-3xl font-bold text-slate-800">{{ $completedOrders }}</p>
            <p class="text-slate-400 text-sm mt-1">Pesanan selesai</p>
        </div>
    </div>

    {{-- ===== RECENT ORDERS TABLE ===== --}}
    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-bold text-slate-800">Pesanan Terbaru</h2>
                <p class="text-slate-400 text-xs mt-0.5">10 pesanan terakhir yang masuk</p>
            </div>
            <a href="{{ route('admin.orders.index') }}"
               class="text-xs text-emerald-600 font-semibold hover:text-emerald-700 transition-colors">
                Lihat semua →
            </a>
        </div>

        <div class="overflow-x-auto">
            @if($recentOrders->count() > 0)
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">ID Pesanan</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Pelanggan</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Total</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Tanggal</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-400 uppercase tracking-wide">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($recentOrders as $order)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-semibold text-slate-600">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $order->receiver_name }}</p>
                                <p class="text-xs text-slate-400">{{ $order->user->name ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-slate-800">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-500">{{ $order->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusConfig = [
                                    'diproses' => ['bg-amber-100 text-amber-700', 'Diproses'],
                                    'dikirim'  => ['bg-blue-100 text-blue-700', 'Dikirim'],
                                    'selesai'  => ['bg-emerald-100 text-emerald-700', 'Selesai'],
                                ];
                                [$cls, $label] = $statusConfig[$order->status] ?? ['bg-slate-100 text-slate-600', ucfirst($order->status)];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $cls }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="py-16 text-center">
                <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                </svg>
                <p class="text-slate-400 text-sm">Belum ada pesanan</p>
            </div>
            @endif
        </div>
    </div>

    {{-- ===== STATUS SUMMARY ===== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach([['diproses','Diproses','amber'], ['dikirim','Dikirim','blue'], ['selesai','Selesai','emerald']] as [$status, $label, $color])
        @php
            $count = \App\Models\Order::where('status', $status)->count();
            $total = \App\Models\Order::count() ?: 1;
            $pct = round($count / $total * 100);
        @endphp
        <div class="bg-white rounded-2xl p-5 border border-slate-100">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-semibold text-slate-700">{{ $label }}</span>
                <span class="text-sm font-bold text-slate-800">{{ $count }}</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-{{ $color }}-500 h-2 rounded-full transition-all" style="width: {{ $pct }}%"></div>
            </div>
            <p class="text-xs text-slate-400 mt-2">{{ $pct }}% dari total pesanan</p>
        </div>
        @endforeach
    </div>

</div>
@endsection
