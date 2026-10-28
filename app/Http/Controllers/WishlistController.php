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
        // Guest wishlist
        if (Auth::guest()) {
            $wishlistIds = session()->get('wishlist', []);

            $wishlists = Product::with('subcategory.category')
                ->whereIn('id', $wishlistIds)
                ->get();

            return view('customer.wishlist', compact('wishlists'));
        }

        // Logged-in customer wishlist
        $wishlists = Wishlist::with('product.subcategory.category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.wishlist', compact('wishlists'));
    }

    // Add or remove a product from wishlist
    public function store($productId)
    {
        $product = Product::findOrFail($productId);

        // Guest wishlist: store product IDs in session
        if (Auth::guest()) {
            $wishlist = session()->get('wishlist', []);

            if (in_array($product->id, $wishlist)) {
                $wishlist = array_values(array_diff(
                    $wishlist,
                    [$product->id]
                ));
            } else {
                $wishlist[] = $product->id;
            }

            session()->put('wishlist', $wishlist);

            return back()->with('success', 'Wishlist updated successfully!');
        }

        // Logged-in customer wishlist: use database
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();

            return back()->with('success', 'Product removed from wishlist!');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to wishlist!');
    }

    // Remove a product from wishlist
    public function destroy($id)
    {
        // Guest wishlist: remove product ID from session
        if (Auth::guest()) {
            $wishlist = session()->get('wishlist', []);

            $wishlist = array_values(array_diff(
                $wishlist,
                [(int) $id]
            ));

            session()->put('wishlist', $wishlist);

            return back()->with('success', 'Product removed from wishlist!');
        }

        // Logged-in customer wishlist
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->findOrFail($id);

        $wishlist->delete();

        return back()->with('success', 'Product removed from wishlist!');
    }
}
