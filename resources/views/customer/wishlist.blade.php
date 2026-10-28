<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>My Wishlist | ElectroMart</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        color: #222;
    }

    .wishlist-header {
        background: #171717;
        color: white;
        padding: 25px 7%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 28px;
        font-weight: bold;
        letter-spacing: -1px;
    }

    .logo span {
        color: #a6a6a6;
    }

    .back-link {
        color: white;
        text-decoration: none;
        font-size: 14px;
    }

    .back-link:hover {
        color: #bdbdbd;
    }

    .wishlist-container {
        max-width: 1200px;
        margin: 45px auto;
        padding: 0 25px;
    }

    .wishlist-heading {
        margin-bottom: 30px;
    }

    .wishlist-heading h1 {
        font-size: 34px;
        margin-bottom: 10px;
    }

    .wishlist-heading p {
        color: #777;
        font-size: 15px;
    }

    .wishlist-count {
        display: inline-block;
        background: #e5e5e5;
        color: #333;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 13px;
        margin-top: 14px;
    }

    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
    }

    .wishlist-card {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .wishlist-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
    }

    .product-image {
        height: 210px;
        padding: 20px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .product-info {
        padding: 20px;
        border-top: 1px solid #eee;
    }

    .product-info h3 {
        font-size: 17px;
        margin-bottom: 12px;
    }

    .product-price {
        font-size: 19px;
        font-weight: bold;
        margin-bottom: 18px;
    }

    .product-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn {
        display: block;
        width: 100%;
        padding: 11px;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-view {
        background: #222;
        color: white;
        border: 1px solid #222;
    }

    .btn-view:hover {
        background: #444;
    }

    .btn-remove {
        background: white;
        color: #555;
        border: 1px solid #ccc;
    }

    .btn-remove:hover {
        background: #eee;
        color: #111;
    }

    .empty-wishlist {
        background: white;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        text-align: center;
        padding: 75px 20px;
    }

    .empty-icon {
        font-size: 55px;
        color: #999;
        margin-bottom: 20px;
    }

    .empty-wishlist h2 {
        font-size: 24px;
        margin-bottom: 12px;
    }

    .empty-wishlist p {
        color: #777;
        margin-bottom: 25px;
    }

    .shop-btn {
        display: inline-block;
        padding: 13px 25px;
        background: #222;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .shop-btn:hover {
        background: #444;
    }

    .success-message {
        padding: 13px 16px;
        background: #e8e8e8;
        color: #222;
        border-left: 4px solid #333;
        margin-bottom: 25px;
        border-radius: 3px;
    }

    .wishlist-footer {
        background: #171717;
        color: #aaa;
        text-align: center;
        padding: 22px;
        margin-top: 70px;
        font-size: 13px;
    }

    @media (max-width: 992px) {
        .wishlist-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 550px) {
        .wishlist-header {
            padding: 20px;
        }

        .logo {
            font-size: 23px;
        }

        .wishlist-container {
            margin-top: 30px;
            padding: 0 15px;
        }

        .wishlist-heading h1 {
            font-size: 28px;
        }

        .wishlist-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


</head>

<body>


<header class="wishlist-header">
    <div class="logo">Electro<span>Mart</span></div>

    <a href="{{ url('/dashboard') }}" class="back-link">
        ← Back to Shop
    </a>
</header>

<main class="wishlist-container">

    <div class="wishlist-heading">
        <h1>My Wishlist <span style="color:#888;">♡</span></h1>
        <p>Your favourite electronics, all in one place.</p>

        <span class="wishlist-count">
            {{ $wishlists->count() }} Saved Products
        </span>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($wishlists->isEmpty())

        <div class="empty-wishlist">
            <div class="empty-icon">♡</div>

            <h2>Your wishlist is empty</h2>

            <p>You haven't saved any products yet. Explore our collection and find something you love.</p>

            <a href="{{ url('/dashboard') }}" class="shop-btn">
                Explore Products →
            </a>
        </div>

    @else

        <div class="wishlist-grid">

            @foreach($wishlists as $wishlist)

                @if($wishlist->product)

                    <div class="wishlist-card">

                        <div class="product-image">
                            <img
                                src="{{ asset('storage/' . $wishlist->product->image) }}"
                                alt="{{ $wishlist->product->name }}"
                            >
                        </div>

                        <div class="product-info">

                            <h3>{{ $wishlist->product->name }}</h3>

                            <div class="product-price">
                                ₹{{ number_format($wishlist->product->price, 2) }}
                            </div>

                            <div class="product-actions">

                                <a href="{{ route('storefront.product', $wishlist->product->id) }}"
                                   class="btn btn-view">
                                    View Product
                                </a>

                                <form action="{{ route('wishlist.destroy', $wishlist->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-remove">
                                        Remove from Wishlist
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

    @endif

</main>

<footer class="wishlist-footer">
    © {{ date('Y') }} ElectroMart. All rights reserved.
</footer>


</body>
</html>
