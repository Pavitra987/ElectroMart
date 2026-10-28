
@extends('layouts.customer')

@section('title', 'My Wishlist')

@section('content')

@php
    $isGuest = auth()->guest();

    if ($isGuest) {
        $wishlistProducts = $wishlists;
    } else {
        $wishlistProducts = $wishlists->map(function ($wishlist) {
            return $wishlist->product;
        })->filter();
    }
@endphp

<style>
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
        background: white;
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

    .wishlist-container .wishlist-action {
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
        color: white;
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
        color: white;
    }

    .success-message {
        padding: 13px 16px;
        background: #e8e8e8;
        color: #222;
        border-left: 4px solid #333;
        margin-bottom: 25px;
        border-radius: 3px;
    }

    @media (max-width: 992px) {
        .wishlist-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 550px) {
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

<main class="wishlist-container">

    <div class="wishlist-heading">
        <h1>My Wishlist <span style="color:#888;">♡</span></h1>

        <p>Your favourite electronics, all in one place.</p>

        <span class="wishlist-count">
            {{ $wishlistProducts->count() }} Saved Products
        </span>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($wishlistProducts->isEmpty())

        <div class="empty-wishlist">
            <div class="empty-icon">♡</div>

            <h2>Your wishlist is empty</h2>

            <p>
                You haven't saved any products yet.
                Explore our collection and find something you love.
            </p>

            <a href="{{ route('storefront.home') }}" class="shop-btn">
                Explore Products →
            </a>
        </div>

    @else

        <div class="wishlist-grid">

            @foreach($wishlistProducts as $product)

                <div class="wishlist-card">

                    <div class="product-image">

                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                            >
                        @else
                            <span>No image available</span>
                        @endif

                    </div>

                    <div class="product-info">

                        <h3>{{ $product->name }}</h3>

                        <div class="product-price">
                            ₹{{ number_format($product->price, 2) }}
                        </div>

                        <div class="product-actions">

                            <a
                                href="{{ route('storefront.product', $product->id) }}"
                                class="wishlist-action btn-view"
                            >
                                View Product
                            </a>

                            @if($isGuest)

                                <form
                                    action="{{ route('wishlist.destroy', $product->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="wishlist-action btn-remove">
                                        Remove from Wishlist
                                    </button>
                                </form>

                            @else

                                @php
                                    $wishlistRecord = $wishlists->firstWhere(
                                        'product_id',
                                        $product->id
                                    );
                                @endphp

                                @if($wishlistRecord)
                                    <form
                                        action="{{ route('wishlist.destroy', $wishlistRecord->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="wishlist-action btn-remove">
                                            Remove from Wishlist
                                        </button>
                                    </form>
                                @endif

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</main>

@endsection
