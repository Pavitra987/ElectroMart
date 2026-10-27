<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
{
    $order = Order::with('user', 'items.product')->findOrFail($id);

    return view('admin.orders.show', compact('order'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
    ]);

    $order = Order::findOrFail($id);

    $order->update([
        'status' => $request->status,
    ]);

    return back()->with('success', 'Order status updated successfully!');
}


}