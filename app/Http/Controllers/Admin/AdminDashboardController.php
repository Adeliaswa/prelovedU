<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalOrders     = Order::count();
        $pendingOrders   = Order::where('status', 'diproses')->count();
        $completedOrders = Order::where('status', 'selesai')->count();
        $recentOrders    = Order::with('user')
                               ->latest()
                               ->take(10)
                               ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'recentOrders'
        ));
    }
}
