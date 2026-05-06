@extends('layouts.admin')

@section('title', 'Proses Pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div style="margin-bottom: 32px; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <a href="{{ route('admin.orders.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none; margin-bottom: 8px; display: inline-block;">← Kembali ke Daftar Pesanan</a>
        <h1 style="font-size: 1.75rem; font-family: var(--font-display);">Detail Pesanan #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <p style="color: var(--text-muted); font-size: 0.875rem;">Waktu Transaksi: {{ $order->created_at->format('d F Y, H:i:s') }}</p>
    </div>
</div>

@if(session('success'))
    <div style="padding: 12px 16px; background: var(--green-bg); color: var(--green); border: 1px solid var(--green); border-radius: var(--radius-sm); margin-bottom: 24px; font-size: 0.875rem; font-weight: 500;">
        {{ session('success') }}
    </div>
@endif

<div style="display: grid; grid-template-columns: 1fr 340px; gap: 32px;">
    
    <!-- Kolom Kiri: Data Pelanggan & Item Barang -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <div class="card">
            <h3 style="font-size: 1rem; margin-bottom: 16px; border-bottom: 1px solid var(--border); padding-bottom: 12px;">Informasi Pengiriman</h3>
            <div style="display: grid; grid-template-columns: 120px 1fr; gap: 12px; font-size: 0.875rem;">
                <strong style="color: var(--text-muted);">Penerima:</strong> <span>{{ $order->receiver_name }}</span>
                <strong style="color: var(--text-muted);">Nomor HP:</strong> <span>{{ $order->phone_number }}</span>
                <strong style="color: var(--text-muted);">Alamat:</strong> <span style="line-height: 1.5;">{{ $order->address }}</span>
            </div>
        </div>

        <div class="card" style="padding: 0; overflow: hidden;">
            <div style="padding: 16px 24px; border-bottom: 1px solid var(--border);">
                <h3 style="font-size: 1rem;">Item yang Dipesan</h3>
            </div>
            <table class="admin-table" style="margin-top: 0;">
                <thead>
                    <tr>
                        <th style="padding-left: 24px;">Barang</th>
                        <th>Harga Satuan</th>
                        <th>Qty</th>
                        <th style="padding-right: 24px; text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td style="padding-left: 24px; font-weight: 500;">{{ $detail->product->name ?? 'Produk Dihapus' }}</td>
                        <td style="color: var(--text-muted);">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td style="padding-right: 24px; text-align: right; font-weight: 600;">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right; padding: 16px; border-top: 2px solid var(--border); color: var(--text-muted); font-size: 0.875rem;">Total Tagihan</td>
                        <td style="padding: 16px 24px; text-align: right; border-top: 2px solid var(--border); font-size: 1.125rem; font-weight: 700;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Kolom Kanan: Panel Eksekusi (Update Status) -->
    <aside>
        <div class="card" style="position: sticky; top: 100px;">
            <h3 style="font-size: 1rem; margin-bottom: 16px;">Tindakan Admin</h3>
            <p style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 20px;">Perbarui status untuk memberitahu pelanggan mengenai posisi barang mereka.</p>
            
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label" for="status">Ubah Status Operasional</label>
                    <select name="status" id="status" class="form-input" style="padding: 10px; font-weight: 600;">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses (Dikemas)</option>
                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim (Dalam Perjalanan)</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai (Telah Diterima)</option>
                    </select>
                </div>

                <button type="submit" class="btn-solid" style="width: 100%; margin-top: 12px;">Simpan Perubahan</button>
            </form>
        </div>
    </aside>

</div>
@endsection
