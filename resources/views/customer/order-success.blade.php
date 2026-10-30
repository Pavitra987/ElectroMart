<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
@extends('layouts.customer')

@section('title', 'My Wishlist')

@section('content')


    <link rel="stylesheet" href="{{ asset('storefront/css/bootstrap.min.css') }}">

    <style>
        body {
            margin: 0;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
            color: #222;
        }

        .header {
            background: #171717;
            color: white;
            padding: 22px 5%;
            font-size: 25px;
            font-weight: bold;
        }

        .header span {
            color: #aaa;
        }

        .confirmation {
            max-width: 700px;
            margin: 60px auto;
            padding: 45px 25px;
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 6px;
            text-align: center;
        }

        .success-icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 22px;
            border: 3px solid #222;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 38px;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .description {
            color: #777;
            font-size: 14px;
            line-height: 1.7;
        }

        .order-info {
            margin: 30px 0;
            padding: 22px;
            background: #f7f7f7;
            text-align: left;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #e5e5e5;
            font-size: 14px;
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .button {
            display: inline-block;
            padding: 13px 22px;
            margin: 5px;
            background: #171717;
            color: white;
            border-radius: 3px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .button:hover {
            background: #444;
            color: white;
        }

        .button-outline {
            background: white;
            color: #222;
            border: 1px solid #222;
        }

        .button-outline:hover {
            background: #eee;
            color: #222;
        }
    </style>
</head>

<body>

    <header class="header">
        Electro<span>Mart</span>
    </header>

    <main class="confirmation">

        <div class="success-icon">✓</div>

        <h1>Thank You for Your Order!</h1>

        <p class="description">
            Your order has been placed successfully.
            You can keep your order number for future reference.
        </p>

        <div class="order-info">

            <div class="order-row">
                <span>Order Number</span>
                <strong>{{ $order->order_number }}</strong>
            </div>

            <div class="order-row">
                <span>Order Total</span>
                <strong>₹{{ number_format($order->total_amount, 2) }}</strong>
            </div>

            <div class="order-row">
                <span>Payment Method</span>
                <strong>Cash on Delivery</strong>
            </div>

            <div class="order-row">
                <span>Order Status</span>
                <strong>{{ ucfirst($order->status) }}</strong>
            </div>

        </div>

        <a href="{{ route('products.index') }}" class="button">
            CONTINUE SHOPPING
        </a>

    </main>

</body>

</html>
@endsection