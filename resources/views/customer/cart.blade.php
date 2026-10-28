
@extends('layouts.customer')

@section('title', 'Shopping Cart')

@section('content')

<style>
    .cart-page {
        background: #f5f5f5;
        color: #222;
        padding: 35px 5% 50px;
        min-height: 70vh;
    }

    .cart-page * {
        box-sizing: border-box;
    }

    .cart-page .page-title {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .cart-page .page-subtitle {
        color: #777;
        font-size: 14px;
        margin-bottom: 28px;
    }

    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 330px;
        gap: 25px;
        align-items: start;
    }

    .cart-box,
    .summary-box {
        background: #fff;
        border: 1px solid #e3e3e3;
        border-radius: 5px;
        padding: 25px;
    }

    .cart-heading,
    .summary-title {
        font-size: 18px;
        font-weight: 700;
        padding-bottom: 18px;
        border-bottom: 1px solid #eee;
        margin-bottom: 5px;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 100px 1fr auto;
        gap: 20px;
        padding: 22px 0;
        border-bottom: 1px solid #eee;
    }

    .item-image {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f8f8;
    }

    .item-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .item-name {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .item-price {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .stock-label {
        color: #38834b;
        font-size: 12px;
        margin-bottom: 12px;
    }

    .out-of-stock {
        color: #c62828;
    }

    .item-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .quantity-input {
        width: 70px;
        padding: 7px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .small-button {
        padding: 8px 12px;
        background: #222;
        color: #fff;
        border: none;
        border-radius: 3px;
        font-size: 12px;
        cursor: pointer;
    }

    .small-button:hover {
        background: #555;
    }

    .remove-button {
        color: #666;
        background: transparent;
        border: none;
        font-size: 12px;
        cursor: pointer;
    }

    .remove-button:hover {
        color: #000;
        text-decoration: underline;
    }

    .item-subtotal {
        text-align: right;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }

    .summary-title {
        margin-bottom: 18px;
    }

    .summary-row,
    .summary-total {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
        font-size: 13px;
    }

    .summary-total {
        padding-top: 18px;
        border-top: 1px solid #ddd;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 22px;
    }

    .checkout-button {
        display: block;
        width: 100%;
        background: #171717;
        color: #fff;
        text-align: center;
        padding: 14px;
        border-radius: 3px;
        font-size: 13px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .checkout-button:hover {
        background: #444;
        color: #fff;
    }

    .continue-shopping {
        display: block;
        text-align: center;
        margin-top: 18px;
        font-size: 12px;
        color: #555;
        text-decoration: none;
    }

    .empty-cart {
        background: #fff;
        border: 1px solid #e3e3e3;
        border-radius: 5px;
        padding: 60px 20px;
        text-align: center;
    }

    .empty-cart h2 {
        font-size: 23px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .empty-cart p {
        color: #777;
        font-size: 14px;
        margin-bottom: 25px;
    }

    @media (max-width: 900px) {
        .cart-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 550px) {
        .cart-page {
            padding: 25px 4% 40px;
        }

        .cart-box,
        .summary-box {
            padding: 15px;
        }

        .cart-item {
            grid-template-columns: 75px 1fr;
            gap: 12px;
        }

        .item-image {
            width: 75px;
            height: 85px;
        }

        .item-subtotal {
            grid-column: 2;
            text-align: left;
        }
    }
</style>

<div class="cart-page">

    <h1 class="page-title">Shopping Cart</h1>

    <p class="page-subtitle">
        Review your items before proceeding to checkout.
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
        $isGuest = !auth()->check();

        if ($isGuest) {
            $cartItems = collect($cart)->map(function ($item, $productId) use ($products) {
                return [
                    'id' => $productId,
                    'product' => $products->get($productId),
                    'quantity' => $item['quantity'],
                ];
            })->filter(function ($item) {
                return $item['product'] !== null;
            });
        } else {
            $cartItems = $cart ? $cart->items : collect();
        }

        $totalQuantity = $cartItems->sum('quantity');

        $subtotal = $cartItems->sum(function ($item) use ($isGuest) {
            if ($isGuest) {
                return $item['product']->price * $item['quantity'];
            }

            return ($item->product->price ?? 0) * $item->quantity;
        });
    @endphp

    @if($cartItems->isNotEmpty())

        <div class="cart-layout">

            <section class="cart-box">

                <div class="cart-heading">
                    Your Items ({{ $totalQuantity }})
                </div>

                @foreach($cartItems as $item)

                    @php
                        $product = $isGuest ? $item['product'] : $item->product;
                        $quantity = $item['quantity'];
                        $itemId = $isGuest ? $item['id'] : $item->id;
                    @endphp

                    @if($product)

                        <div class="cart-item">

                            <div class="item-image">
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                @else
                                    <span>Product</span>
                                @endif
                            </div>

                            <div>

                                <div class="item-name">
                                    {{ $product->name }}
                                </div>

                                <div class="item-price">
                                    ₹{{ number_format($product->price, 2) }}
                                </div>

                                <div class="{{ $product->stock > 0 ? 'stock-label' : 'stock-label out-of-stock' }}">
                                    @if($product->stock > 0)
                                        In Stock
                                    @else
                                        Out of Stock
                                    @endif
                                </div>

                                <div class="item-actions">

                                    <form
                                        action="{{ route('cart.update', $itemId) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <input
                                            type="number"
                                            name="quantity"
                                            class="quantity-input"
                                            value="{{ $quantity }}"
                                            min="1"
                                            max="{{ $product->stock }}"
                                            required>

                                        <button type="submit" class="small-button">
                                            Update
                                        </button>

                                    </form>

                                    <form
                                        action="{{ route('cart.remove', $itemId) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="remove-button">
                                            Remove
                                        </button>

                                    </form>

                                </div>

                            </div>

                            <div class="item-subtotal">
                                ₹{{ number_format($product->price * $quantity, 2) }}
                            </div>

                        </div>

                    @endif

                @endforeach

            </section>

            <aside class="summary-box">

                <div class="summary-title">
                    Order Summary
                </div>

                <div class="summary-row">
                    <span>Items</span>
                    <span>{{ $totalQuantity }}</span>
                </div>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($subtotal, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Delivery</span>
                    <span>Calculated at checkout</span>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <span>₹{{ number_format($subtotal, 2) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="checkout-button">
                    PROCEED TO CHECKOUT
                </a>

                <a href="{{ route('storefront.home') }}" class="continue-shopping">
                    ← Continue Shopping
                </a>

            </aside>

        </div>

    @else

        <div class="empty-cart">

            <h2>Your cart is empty</h2>

            <p>
                You haven't added any products to your cart yet.
                Explore our products and find something you love.
            </p>

            <a
                href="{{ route('storefront.home') }}"
                class="checkout-button"
                style="max-width: 220px; margin: auto;">

                START SHOPPING

            </a>

        </div>

    @endif

</div>

@endsection

