<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
  public function index(Request $request)
{
    $cart = Cart::with('items.product')
        ->where('user_id', $request->user()->id)
        ->first();

    if (!$cart || $cart->items->isEmpty()) {
        return redirect()
            ->route('cart.index')
            ->with('error', 'Your cart is empty.');
    }

    // Get the logged-in customer's saved addresses
    $addresses = $request->user()
        ->addresses()
        ->latest()
        ->get();

    return view('customer.checkout', compact('cart', 'addresses'));
}
    public function store(Request $request)
{
    $validated = $request->validate([
        'recipient_name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:1000',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'postal_code' => 'required|string|max:10',
        'payment_method' => 'required|in:COD',
    ]);

    $order = DB::transaction(function () use ($request, $validated) {

        $cart = \App\Models\Cart::where('user_id', $request->user()->id)
            ->first();

        if (!$cart) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty.',
            ]);
        }

        $cartItems = \App\Models\CartItem::where('cart_id', $cart->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty.',
            ]);
        }

        $total = 0;
        $orderItems = [];

        foreach ($cartItems as $item) {

            $product = Product::where('id', $item->product_id)
                ->lockForUpdate()
                ->first();

            if (!$product || $product->status !== 'active') {
                throw ValidationException::withMessages([
                    'cart' => 'A product in your cart is no longer available.',
                ]);
            }

            if (!$product->subcategory ||
                $product->subcategory->category->status !== 'active') {
                throw ValidationException::withMessages([
                    'cart' => 'A product category is no longer available.',
                ]);
            }

            if ($item->quantity < 1 || $item->quantity > $product->stock) {
                throw ValidationException::withMessages([
                    'cart' => 'Insufficient stock for ' . $product->name . '.',
                ]);
            }

            $price = $product->price;
            $subtotal = $price * $item->quantity;

            $total += $subtotal;

            $orderItems[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $price,
                'quantity' => $item->quantity,
                'subtotal' => $subtotal,
            ];
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'order_number' => 'EM-' . strtoupper(uniqid()),
            'recipient_name' => $validated['recipient_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postal_code' => $validated['postal_code'],
            'total_amount' => $total,
            'payment_method' => 'COD',
            'status' => 'pending',
        ]);

        foreach ($orderItems as $orderItem) {

            $order->items()->create($orderItem);

            Product::where('id', $orderItem['product_id'])
                ->decrement('stock', $orderItem['quantity']);
        }

        \App\Models\CartItem::where('cart_id', $cart->id)->delete();

        return $order;
    });

    return redirect()
        ->route('checkout.success', $order->id)
        ->with('success', 'Your order has been placed successfully!');
}
    public function success(Request $request, $id)
{
    $order = \App\Models\Order::with('items')
        ->where('user_id', $request->user()->id)
        ->findOrFail($id);

    return view('customer.order-success', compact('order'));
}
}