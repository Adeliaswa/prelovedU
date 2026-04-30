<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutApiController extends Controller
{
    public function store(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return response()->json(['error' => 'Cart kosong'], 400);
        }

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->quantity * $cart->product->price;
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
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
                'subtotal' => $cart->quantity * $cart->product->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return response()->json(['message' => 'Checkout berhasil']);
    }
}
