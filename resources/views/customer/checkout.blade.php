<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout | ElectroMart</title>

    <link rel="stylesheet" href="{{ asset('storefront/css/bootstrap.min.css') }}">

    <style>
        body {
            margin: 0;
            background: #f5f5f5;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: #171717;
            color: white;
            padding: 12px 5%;
            font-size: 13px;
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
            text-decoration: none;
            color: #171717;
        }

        .logo span {
            color: #999;
        }

        .header a:last-child {
            color: #333;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 25px;
            align-items: start;
        }

        .checkout-box {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            padding: 28px;
            margin-bottom: 22px;
        }

        .box-title {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .form-label {
            font-size: 13px;
            font-weight: bold;
        }

        .form-control {
            padding: 12px;
            font-size: 13px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #555;
            box-shadow: none;
        }

        .order-product {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            font-size: 13px;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .order-product-name {
            font-weight: bold;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            margin-top: 10px;
            font-size: 19px;
            font-weight: bold;
        }

        .payment-option {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 17px;
            background: #fafafa;
        }

        .place-order-button {
            width: 100%;
            background: #171717;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 15px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        .place-order-button:hover {
            background: #444;
        }

        .back-link {
            display: inline-block;
            margin-top: 18px;
            font-size: 13px;
            color: #555;
            text-decoration: none;
        }

        .footer {
            background: #171717;
            color: white;
            text-align: center;
            padding: 25px;
            font-size: 12px;
        }

        @media (max-width: 850px) {
            .checkout-layout {
                grid-template-columns: 1fr;
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

        <a href="{{ route('cart.index') }}">← Back to Cart</a>

    </header>

    <main class="checkout-container">

        <h1 class="page-title">Checkout</h1>

        <p class="page-subtitle">
            Enter your delivery details and review your order.
        </p>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">

            @csrf

            <div class="checkout-layout">

                <!-- Delivery Details -->
                <div>

                    <section class="checkout-box">

                        <h2 class="box-title">Delivery Information</h2>

                        <div class="mb-3">
                            <label for="recipient_name" class="form-label">
                                Recipient Name *
                            </label>

                            <input
                                type="text"
                                name="recipient_name"
                                id="recipient_name"
                                class="form-control"
                                value="{{ old('recipient_name', auth()->user()->name) }}"
                                required>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    Phone Number *
                                </label>

                                <input
                                    type="tel"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                    maxlength="15"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    Email Address *
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">
                                Delivery Address *
                            </label>

                            <textarea
                                name="address"
                                id="address"
                                class="form-control"
                                rows="3"
                                required>{{ old('address') }}</textarea>
                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">
                                    City *
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    class="form-control"
                                    value="{{ old('city') }}"
                                    required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">
                                    State *
                                </label>

                                <input
                                    type="text"
                                    name="state"
                                    id="state"
                                    class="form-control"
                                    value="{{ old('state') }}"
                                    required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="postal_code" class="form-label">
                                    Postal Code *
                                </label>

                                <input
                                    type="text"
                                    name="postal_code"
                                    id="postal_code"
                                    class="form-control"
                                    value="{{ old('postal_code') }}"
                                    maxlength="10"
                                    required>
                            </div>

                        </div>

                    </section>

                    <section class="checkout-box">

                        <h2 class="box-title">Payment Method</h2>

                        <div class="payment-option">

                            <label style="cursor:pointer; display:block;">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="COD"
                                    checked
                                    required>

                                <strong style="margin-left:8px;">
                                    Cash on Delivery (COD)
                                </strong>

                                <p class="text-muted small mt-2 mb-0">
                                    Pay when your order is delivered.
                                </p>

                            </label>

                        </div>

                    </section>

                </div>

                <!-- Order Summary -->
                <aside>

                    <section class="checkout-box">

                        <h2 class="box-title">Your Order</h2>

                        @foreach($cart->items as $item)

                            @if($item->product)

                                <div class="order-product">

                                    <div>
                                        <div class="order-product-name">
                                            {{ $item->product->name }}
                                        </div>

                                        <div class="text-muted mt-1">
                                            Quantity: {{ $item->quantity }}
                                        </div>
                                    </div>

                                    <strong>
                                        ₹{{ number_format($item->product->price * $item->quantity, 2) }}
                                    </strong>

                                </div>

                            @endif

                        @endforeach

                        <div class="order-total">

                            <span>Total</span>

                            <span>
                                ₹{{ number_format($cart->items->sum(function ($item) {
                                    return $item->product
                                        ? $item->product->price * $item->quantity
                                        : 0;
                                }), 2) }}
                            </span>

                        </div>

                        <button type="submit" class="place-order-button">
                            PLACE ORDER
                        </button>

                        <a href="{{ route('cart.index') }}" class="back-link">
                            ← Return to Cart
                        </a>

                    </section>

                </aside>

            </div>

        </form>

    </main>

    <footer class="footer">
        © {{ date('Y') }} ElectroMart. All rights reserved.
    </footer>

</body>

</html>