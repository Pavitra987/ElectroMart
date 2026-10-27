<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | ElectroMart</title>


<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f5f6f8;
        color: #222;
    }

    .header {
        background: white;
        padding: 22px 7%;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        color: #111;
        font-size: 25px;
        font-weight: bold;
        text-decoration: none;
    }

    .logo span {
        color: #888;
    }

    .header a.back {
        color: #285b45;
        text-decoration: none;
        font-size: 14px;
    }

    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .subtitle {
        color: #777;
        margin-bottom: 30px;
    }

    .order-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        margin-bottom: 22px;
        overflow: hidden;
    }

    .order-header {
        background: #fafafa;
        padding: 18px 22px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .order-header small {
        display: block;
        color: #888;
        margin-bottom: 6px;
    }

    .order-header strong {
        font-size: 14px;
    }

    .status {
        display: inline-block;
        background: #e8f3ed;
        color: #285b45;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .order-body {
        padding: 22px;
    }

    .item {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .item:last-child {
        border-bottom: none;
    }

    .item-name {
        font-weight: 600;
    }

    .item-details {
        color: #777;
        font-size: 13px;
        margin-top: 6px;
    }

    .item-price {
        font-weight: 600;
        white-space: nowrap;
    }

    .order-total {
        border-top: 1px solid #eee;
        margin-top: 15px;
        padding-top: 18px;
        display: flex;
        justify-content: space-between;
        font-size: 17px;
        font-weight: bold;
    }

    .payment {
        margin-top: 12px;
        color: #777;
        font-size: 13px;
    }

    .empty {
        background: white;
        padding: 50px 20px;
        border-radius: 10px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .empty h2 {
        font-size: 21px;
    }

    .empty p {
        color: #777;
    }

    .shop-button {
        display: inline-block;
        margin-top: 15px;
        background: #203b32;
        color: white;
        padding: 12px 22px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
    }

    @media (max-width: 600px) {
        .header {
            padding: 18px 20px;
        }

        .container {
            margin-top: 25px;
        }

        .order-header,
        .order-body {
            padding: 16px;
        }
    }
</style>


</head>

<body>

<header class="header">
    <a href="{{ route('storefront.home') }}" class="logo">
        Electro<span>Mart</span>
    </a>


<a href="{{ route('storefront.home') }}" class="back">
    ← Continue Shopping
</a>


</header>

<main class="container">


<h1>My Orders</h1>
<p class="subtitle">View your purchases and track your order status.</p>

@forelse($orders as $order)

    <div class="order-card">

        <div class="order-header">
            <div>
                <small>Order Number</small>
                <strong>{{ $order->order_number }}</strong>
            </div>

            <div>
                <small>Order Date</small>
                <strong>{{ $order->created_at->format('d M Y') }}</strong>
            </div>

            <div>
                <small>Order Status</small>
                <span class="status">{{ $order->status }}</span>
            </div>
        </div>

        <div class="order-body">

            @foreach($order->items as $item)
                <div class="item">
                    <div>
                        <div class="item-name">
                            {{ $item->product_name }}
                        </div>

                        <div class="item-details">
                            Quantity: {{ $item->quantity }}
                        </div>
                    </div>

                    <div class="item-price">
                        ₹{{ number_format($item->subtotal, 2) }}
                    </div>
                </div>
            @endforeach

            <div class="order-total">
                <span>Total Amount</span>
                <span>₹{{ number_format($order->total_amount, 2) }}</span>
            </div>

            <div class="payment">
                Payment Method: {{ $order->payment_method }}
            </div>

        </div>
    </div>

@empty

    <div class="empty">
        <h2>No orders yet</h2>
        <p>Your purchases will appear here after you place an order.</p>

        <a href="{{ route('storefront.home') }}" class="shop-button">
            Start Shopping
        </a>
    </div>

@endforelse


</main>

</body>
</html>
