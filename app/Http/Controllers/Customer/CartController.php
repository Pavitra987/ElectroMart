<?php

namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::where('status', 'active')
            ->findOrFail($id);

        $quantity = (int) $request->quantity;

        if ($quantity > $product->stock) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $cart = Cart::firstOrCreate([
    'user_id' => $request->user()->id,
]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        $newQuantity = $quantity;

        if ($cartItem) {
            $newQuantity += $cartItem->quantity;
        }

        if ($newQuantity > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully!');
    }
  public function index()
{
    $cart = \App\Models\Cart::with('items.product')
        ->where('user_id', request()->user()->id)
        ->first();

    return view('customer.cart', compact('cart'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cartItem = \App\Models\CartItem::where('id', $id)
        ->whereHas('cart', function ($query) {
            $query->where('user_id', request()->user()->id);
        })
        ->with('product')
        ->firstOrFail();

    if (!$cartItem->product || $cartItem->product->status !== 'active') {
        return back()->with('error', 'This product is no longer available.');
    }

    if ($request->quantity > $cartItem->product->stock) {
        return back()->with('error', 'Requested quantity exceeds available stock.');
    }

    $cartItem->update([
        'quantity' => $request->quantity,
    ]);

    return back()->with('success', 'Cart quantity updated successfully.');
}
public function remove($id)
{
    $cartItem = \App\Models\CartItem::where('id', $id)
        ->whereHas('cart', function ($query) {
            $query->where('user_id', request()->user()->id);
        })
        ->firstOrFail();

    $cartItem->delete();

    return back()->with('success', 'Product removed from cart successfully.');
}
}