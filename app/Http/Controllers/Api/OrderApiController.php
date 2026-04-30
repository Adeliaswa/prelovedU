<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderApiController extends Controller
{
    public function index()
    {
        return Order::where('user_id', Auth::id())->get();
    }

    public function show($id)
    {
        return Order::with('orderDetails.product')->findOrFail($id);
    }
}