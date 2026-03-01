<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        $stats = [
            'total' => $orders->count(),
            'paid' => $orders->where('status', 'paid')->count(),
            'pending' => $orders->where('status', 'pending')->count(),
            'revenue' => $orders->where('status', 'paid')->sum('amount'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }
}
