<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * List semua pesanan dengan filter status
     */
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('status') && in_array($request->status, ['diproses', 'dikirim', 'selesai'])) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Detail pesanan
     */
    public function show($id)
    {
        $order = Order::with(['user', 'orderDetails.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in'       => 'Status tidak valid.',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        $statusLabel = ['diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai'];

        return redirect()->route('admin.orders.show', $order->id)
                         ->with('success', 'Status pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' diperbarui menjadi "' . ($statusLabel[$request->status] ?? $request->status) . '".');
    }

    
    public function update(\Illuminate\Http\Request $request, \App\Models\Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,dikirim,selesai',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi: ' . strtoupper($request->status));
    }
}
