
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      @extends('layouts.customer')

@section('title', 'Product Details')

@section('content')

    <link rel="stylesheet" href="{{ asset('storefront/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storefront/style.css') }}">
    <link rel="stylesheet" href="{{ asset('storefront/css/electromart.css') }}">

    <style>
        body {
            background: #f5f5f5;
        }

        .product-details {
            background: white;
            padding: 40px;
            margin-top: 50px;
            margin-bottom: 50px;
            border-radius: 12px;
        }

        .product-image {
            width: 100%;
            height: 400px;
            object-fit: contain;
            background: #f8f8f8;
            border-radius: 10px;
        }

        .product-info h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .product-price {
            font-size: 28px;
            font-weight: 700;
            margin: 20px 0;
        }

        .back-button {
            display: inline-block;
            margin-top: 25px;
            color: #333;
            text-decoration: none;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .wishlist-btn {
            background: white;
            color: #222;
            border: 1px solid #333;
            padding: 10px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.2s;
            margin-top: 10px;
        }

        .wishlist-btn:hover {
            background: #222;
            color: white;
        }

        .wishlist-btn.wishlisted {
            color: #e63946;
            border-color: #e63946;
        }

        .wishlist-btn .heart {
            font-size: 20px;
            margin-right: 4px;
        }
    </style>
</head>

<body>

<div class="container">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}

            <a href="{{ route('cart.index') }}" class="btn btn-dark btn-sm">
                View Cart
            </a>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger mt-3">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="product-details">
        <div class="row align-items-center">

            {{-- Product Image --}}
            <div class="col-md-6 mb-4">

                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="product-image"
                    >
                @else
                    <div class="product-image d-flex align-items-center justify-content-center">
                        No image available
                    </div>
                @endif

            </div>

            {{-- Product Information --}}
            <div class="col-md-6 product-info">

                <p class="text-muted">ElectroMart Product</p>

                <h1>{{ $product->name }}</h1>

                <p>
                    Category:
                    {{ $product->subcategory->category->name ?? 'N/A' }}
                </p>

                <p>
                    Subcategory:
                    {{ $product->subcategory->name ?? 'N/A' }}
                </p>

                <div class="product-price">
                    ₹{{ number_format($product->price, 2) }}
                </div>

                <p>
                    {{ $product->description ?: 'No description available.' }}
                </p>

                {{-- Stock Status --}}
                <p>
                    @if($product->stock > 0)
                        <span class="text-success">
                            In Stock ({{ $product->stock }} available)
                        </span>
                    @else
                        <span class="text-danger">Out of Stock</span>
                    @endif
                </p>

                @if($product->stock > 0)

                    {{-- Add to Cart: Guests and logged-in customers --}}
                    <form action="{{ route('cart.add', $product->id) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">
                            <label for="quantity" class="form-label">
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="quantity"
                                id="quantity"
                                class="form-control"
                                value="{{ old('quantity', 1) }}"
                                min="1"
                                max="{{ $product->stock }}"
                                required
                                style="width: 120px;"
                            >
                        </div>

                        <button type="submit" class="btn btn-dark">
                            🛒 Add to Cart
                        </button>

                    </form>

                    {{-- Add to Wishlist --}}
                    @php
                        $isWishlisted = false;

                        if (auth()->check()) {
                            $isWishlisted = \App\Models\Wishlist::where(
                                'user_id',
                                auth()->id()
                            )
                            ->where('product_id', $product->id)
                            ->exists();
                        } else {
                            $guestWishlist = session()->get('wishlist', []);
                            $isWishlisted = in_array(
                                $product->id,
                                array_map('intval', $guestWishlist)
                            );
                        }
                    @endphp

                    <form action="{{ route('wishlist.store', $product->id) }}"
                          method="POST">

                        @csrf

                        <button type="submit"
                                class="wishlist-btn {{ $isWishlisted ? 'wishlisted' : '' }}">

                            <span class="heart">
                                {{ $isWishlisted ? '♥' : '♡' }}
                            </span>

                            {{ $isWishlisted ? 'Added to Wishlist' : 'Add to Wishlist' }}

                        </button>

                    </form>

                @else

                    <button class="btn btn-secondary" disabled>
                        Out of Stock
                    </button>

                @endif

                <div class="mt-3">
                    <a href="{{ route('storefront.home') }}"
                       class="btn btn-outline-dark">
                        Back to Shop
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>
@endsection