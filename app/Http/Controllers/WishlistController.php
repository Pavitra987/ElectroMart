<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Display wishlist products
    public function index()
    {
        $wishlists = Wishlist::with('product.subcategory.category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.wishlist', compact('wishlists'));
    }

    // Add product to wishlist
    public function store($productId)
{
    $product = Product::findOrFail($productId);

    $wishlist = Wishlist::where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->first();

    if ($wishlist) {
        $wishlist->delete();
    } else {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
    }

    return back();
}

    // Remove product from wishlist
    public function destroy($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->findOrFail($id);

        $wishlist->delete();

        return back()->with('success', 'Product removed from wishlist!');
    }
}
