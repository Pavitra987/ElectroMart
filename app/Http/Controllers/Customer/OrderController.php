<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
  public function index()
{
    $orders = Order::with('items')
        ->where('user_id', request()->user()->id)
        ->latest()
        ->get();

    return view('customer.orders', compact('orders'));
}
}
