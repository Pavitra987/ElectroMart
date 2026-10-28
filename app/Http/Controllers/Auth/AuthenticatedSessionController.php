<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Merge Guest Wishlist
        |--------------------------------------------------------------------------
        */

        $guestWishlist = $request->session()->get('wishlist', []);

        foreach ($guestWishlist as $productId) {
            $productExists = Product::where('id', $productId)->exists();

            if (!$productExists) {
                continue;
            }

            Wishlist::firstOrCreate([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
        }

        $request->session()->forget('wishlist');

        /*
        |--------------------------------------------------------------------------
        | Merge Guest Cart
        |--------------------------------------------------------------------------
        */

        $guestCart = $request->session()->get('cart', []);

        if (!empty($guestCart)) {
            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
            ]);

            foreach ($guestCart as $productId => $item) {
                $product = Product::where('status', 'active')
                    ->find($productId);

                if (!$product || $product->stock < 1) {
                    continue;
                }

                $guestQuantity = (int) ($item['quantity'] ?? 1);

                if ($guestQuantity < 1) {
                    continue;
                }

                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $product->id)
                    ->first();

                $existingQuantity = $cartItem
                    ? (int) $cartItem->quantity
                    : 0;

                $newQuantity = min(
                    $existingQuantity + $guestQuantity,
                    (int) $product->stock
                );

                if ($cartItem) {
                    $cartItem->update([
                        'quantity' => $newQuantity,
                    ]);
                } else {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                        'quantity' => $newQuantity,
                    ]);
                }
            }
        }

        $request->session()->forget('cart');

        return redirect()->intended(route('storefront.home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
