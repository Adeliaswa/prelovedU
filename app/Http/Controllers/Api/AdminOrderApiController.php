<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderApiController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Status updated']);
    }
}
