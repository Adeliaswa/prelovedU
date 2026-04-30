<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        return view('checkout.index', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
        ]);

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($carts as $cart) {
                if ($cart->quantity > $cart->product->stock) {
                    return back()->with('error', 'Stok produk ' . $cart->product->name . ' tidak mencukupi.');
                }

                $total += $cart->product->price * $cart->quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'receiver_name' => $request->receiver_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'total_price' => $total,
                'status' => 'diproses',
            ]);

            foreach ($carts as $cart) {
                $subtotal = $cart->product->price * $cart->quantity;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'subtotal' => $subtotal,
                ]);

                $cart->product->update([
                    'stock' => $cart->product->stock - $cart->quantity,
                ]);
            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Checkout berhasil. Pesanan sudah dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}