<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Cart | ElectroMart</title>

    <link rel="stylesheet" href="{{ asset('storefront/css/bootstrap.min.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #222;
            background: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .topbar {
            background: #171717;
            color: white;
            padding: 10px 5%;
            font-size: 12px;
        }

        .header {
            background: white;
            padding: 22px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        .logo span {
            color: #999;
        }

        .header-link {
            font-size: 13px;
            font-weight: bold;
        }

        .header-link:hover {
            color: #777;
        }

        .breadcrumb {
            padding: 18px 5%;
            margin: 0;
            background: transparent;
            font-size: 13px;
        }

        .breadcrumb a {
            color: #666;
        }

        .page-container {
            padding: 10px 5% 50px;
        }

        .page-title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .page-subtitle {
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
            background: white;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
            padding: 25px;
        }

        .cart-heading {
            font-size: 17px;
            font-weight: bold;
            padding-bottom: 18px;
            border-bottom: 1px solid #eee;
            margin-bottom: 5px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 110px 1fr auto;
            gap: 20px;
            padding: 22px 0;
            border-bottom: 1px solid #eee;
        }

        .item-image {
            width: 110px;
            height: 110px;
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
            font-weight: bold;
            margin-bottom: 10px;
        }

        .item-price {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .stock-label {
            color: #38834b;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quantity-input {
            width: 75px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .small-button {
            padding: 8px 12px;
            background: #222;
            color: white;
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
            font-size: 15px;
            font-weight: bold;
            white-space: nowrap;
        }

        .summary-title {
            font-size: 18px;
            font-weight: bold;
            padding-bottom: 18px;
            border-bottom: 1px solid #eee;
            margin-bottom: 18px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            font-size: 13px;
            margin-bottom: 17px;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding-top: 18px;
            border-top: 1px solid #ddd;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 22px;
        }

        .checkout-button {
            display: block;
            width: 100%;
            background: #171717;
            color: white;
            text-align: center;
            padding: 14px;
            border-radius: 3px;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .checkout-button:hover {
            background: #444;
            color: white;
        }

        .continue-shopping {
            display: block;
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: #555;
        }

        .empty-cart {
            background: white;
            border: 1px solid #e3e3e3;
            border-radius: 5px;
            padding: 60px 20px;
            text-align: center;
        }

        .empty-cart h2 {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .empty-cart p {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .footer {
            background: #171717;
            color: white;
            padding: 25px 5%;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            font-size: 12px;
        }

        @media (max-width: 900px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 550px) {
            .page-container {
                padding-left: 4%;
                padding-right: 4%;
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

            .item-actions {
                flex-wrap: wrap;
                gap: 8px;
            }

            .footer {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="topbar">
        Welcome to ElectroMart
    </div>

    <header class="header">

        <a href="{{ route('storefront.home') }}" class="logo">
            Electro<span>Mart</span>
        </a>

        <a href="{{ route('dashboard') }}" class="header-link">
            MY ACCOUNT
        </a>

    </header>

    <div class="breadcrumb">
        <a href="{{ route('storefront.home') }}">Home</a>
        &nbsp; / &nbsp;
        <strong>Shopping Cart</strong>
    </div>

    <main class="page-container">

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

        @if($cart && $cart->items->count() > 0)

            <div class="cart-layout">

                <section class="cart-box">

                    <div class="cart-heading">
                        Your Items ({{ $cart->items->count() }})
                    </div>

                    @foreach($cart->items as $item)

                        <div class="cart-item">

                            <div class="item-image">

                                @if($item->product && $item->product->image)
                                    <img
                                        src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}">
                                @else
                                    <span>Product</span>
                                @endif

                            </div>

                            <div>

                                <div class="item-name">
                                    {{ $item->product->name ?? 'Product unavailable' }}
                                </div>

                                @if($item->product)

                                    <div class="item-price">
                                        ₹{{ number_format($item->product->price, 2) }}
                                    </div>

                                    <div class="stock-label">
                                        @if($item->product->stock > 0)
                                            In Stock
                                        @else
                                            Out of Stock
                                        @endif
                                    </div>

                                    <div class="item-actions">

                                        <form action="{{ route('cart.update', $item->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="number"
                                                name="quantity"
                                                class="quantity-input"
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ $item->product->stock }}"
                                                required>

                                            <button type="submit" class="small-button">
                                                Update
                                            </button>

                                        </form>

                                        <form action="{{ route('cart.remove', $item->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="remove-button">
                                                Remove
                                            </button>

                                        </form>

                                    </div>

                                @endif

                            </div>

                            <div class="item-subtotal">
                                ₹{{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}
                            </div>

                        </div>

                    @endforeach

                </section>

                <aside class="summary-box">

                    <div class="summary-title">
                        Order Summary
                    </div>

                    <div class="summary-row">
                        <span>Items</span>
                        <span>{{ $cart->items->sum('quantity') }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>
                            ₹{{ number_format($cart->items->sum(function ($item) {
                                return ($item->product->price ?? 0) * $item->quantity;
                            }), 2) }}
                        </span>
                    </div>

                    <div class="summary-row">
                        <span>Delivery</span>
                        <span>Calculated at checkout</span>
                    </div>

                    <div class="summary-total">
                        <span>Total</span>
                        <span>
                            ₹{{ number_format($cart->items->sum(function ($item) {
                                return ($item->product->price ?? 0) * $item->quantity;
                            }), 2) }}
                        </span>
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

                <a href="{{ route('storefront.home') }}" class="checkout-button"
                    style="max-width: 220px; margin: auto;">
                    START SHOPPING
                </a>

            </div>

        @endif

    </main>

    <footer class="footer">

        <strong>ElectroMart</strong>

        <span>Your destination for everyday electronics.</span>

        <span>© {{ date('Y') }} ElectroMart</span>

    </footer>

</body>

</html>