<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($carts);
    }

    public function store($productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->stock <= 0) {
            return response()->json(['error' => 'Stok habis'], 400);
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => 1,
        ]);

        return response()->json(['message' => 'Berhasil ditambahkan']);
    }

    public function destroy($cartId)
    {
        Cart::where('user_id', Auth::id())
            ->findOrFail($cartId)
            ->delete();

        return response()->json(['message' => 'Dihapus']);
    }
}