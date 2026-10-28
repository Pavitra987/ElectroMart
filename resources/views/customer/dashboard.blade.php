<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ElectroMart | Shop Electronics</title>

    <link rel="stylesheet" href="{{ asset('storefront/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('storefront/css/electromart.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

html,
body {
    margin: 0;
    padding: 0;
    background: #fff;
    color: #191919;
    font-family: 'Inter', sans-serif;
}

body {
    overflow-x: hidden;
}
.shopping-topbar {
    margin-top: 0;
}

.shopping-header {
    margin-top: 0;
}


        a {
            text-decoration: none;
            color: inherit;
        }

        .shopping-topbar {
            background: #171717;
            color: #fff;
            padding: 9px 5%;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .shopping-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            padding: 22px 5%;
            border-bottom: 1px solid #eee;
        }
        .account-dropdown {
    position: relative;
}

.account-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 180px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 8px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    z-index: 1000;
    padding: 8px 0;
}

.account-dropdown:hover .account-menu,
.account-dropdown:focus-within .account-menu {
    display: block;
}

.account-menu a,
.account-menu button {
    display: block;
    width: 100%;
    padding: 12px 16px;
    text-align: left;
    text-decoration: none;
    color: #222;
    background: transparent;
    border: none;
    font-size: 14px;
    cursor: pointer;
}

.account-menu a:hover,
.account-menu button:hover {
    background: #f3f5f4;
    color: #285b45;
}

        .shopping-logo {
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1.5px;
            white-space: nowrap;
            
        }

        .shopping-logo span {
            color:silver;
        }

       

        
       
        .shopping-actions {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .shopping-action {
            font-size: 12px;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 5px;
            color: #333;
        }

        .shopping-action .action-icon {
            font-size: 21px;
        }

        .shopping-nav {
            padding: 0 5%;
            display: flex;
            align-items: center;
            gap: 35px;
            height: 52px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            font-weight: 600;
        }

        .shopping-nav a:hover {
            color:grey;
        }

        .shopping-nav .nav-highlight {
            color: silver;
        }

        .shopping-hero {
            margin: 28px 5%;
            min-height: 340px;
            border-radius: 8px;
            background: #f4f1ed;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            padding: 45px 6%;
        }

        .hero-content {
            width: 55%;
            position: relative;
            z-index: 2;
        }

        .hero-label {
            color: silver;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .hero-content h1 {
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -2px;
            margin-bottom: 18px;
        }

        .hero-content p {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
            max-width: 400px;
            margin-bottom: 25px;
        }

        .hero-button {
            display: inline-block;
            padding: 13px 25px;
            background: #433c3c;
            color: #fff;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 700;
        }

        .hero-button:hover {
            background: #433c3c;
            color: #fff;
        }

        .hero-art {
            position: absolute;
            right: 6%;
            top: 50%;
            transform: translateY(-50%);
            width: 300px;
            height: 270px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-circle {
            width: 245px;
            height: 245px;
            border-radius: 50%;
            background: #e6d8ca;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 115px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        }

        .hero-small-item {
            position: absolute;
            right: 0;
            bottom: 5px;
            background: #fff;
            padding: 14px;
            border-radius: 8px;
            font-size: 35px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .shopping-section {
            padding: 15px 5% 35px;
        }

      

        .section-link {
            font-size: 12px;
            color: #433c3c;
            font-weight: 700;
        }

        /* Simple horizontal category navigation */
        .category-section {
            padding-top: 28px;
            padding-bottom: 30px;
        }

        

       

        .category-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            width: 100%;
            border-top: 1px solid #e9e9e9;
            border-bottom: 1px solid #e9e9e9;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .category-nav a {
            flex: 0 0 auto;
            display: block;
            padding: 19px 20px;
            color: #222;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .35px;
            white-space: nowrap;
            transition: color .2s ease, background .2s ease;
        }

        .category-nav a:hover,
        .category-nav a:focus-visible {
            color: #8a6a45;
            background: #faf8f5;
            outline: none;
        }

        .category-nav a + a {
            border-left: 1px solid #eeeeee;
        }

        .product-section {
            background: #f8f8f8;
            padding: 40px 5%;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
        }

        .shopping-product {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 17px;
            transition: .2s;
        }

        .shopping-product:hover {
            border-color: #ddd;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            transform: translateY(-3px);
        }

        .product-image-box {
            height: 205px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            background: #fff;
        }

        .product-image-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .product-category {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .shopping-product h3 {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.5;
            min-height: 42px;
            margin-bottom: 12px;
        }

        .product-price {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .product-stock {
            color: #218838;
            font-size: 11px;
            margin-bottom: 14px;
        }

        .product-stock.out-of-stock {
            color: #dc3545;
        }

        .product-button {
            display: block;
            text-align: center;
            padding: 11px;
            border: 1px solid #222;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 700;
            transition: .2s;
        }

        .product-button:hover {
            background: #222;
            color: #fff;
        }

        .shopping-footer {
            background: #171717;
            color: #fff;
            padding: 30px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            font-size: 12px;
        }

        .shopping-footer .footer-logo {
            font-size: 23px;
            font-weight: 800;
        }

        .shopping-footer .footer-logo span {
            color: grey;
        }

        .empty-products {
            text-align: center;
            background: #fff;
            padding: 45px 20px;
            border-radius: 5px;
            color: #777;
        }

        @media (max-width: 992px) {
            .shopping-header {
                flex-wrap: wrap;
                gap: 18px;
            }

         

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .hero-art {
                right: 0;
                opacity: .7;
            }

            .hero-content {
                width: 70%;
            }
        }

        @media (max-width: 576px) {
            .shopping-topbar {
                padding: 9px 4%;
                font-size: 10px;
            }

            .shopping-header {
                padding: 18px 4%;
            }

            .shopping-logo {
                font-size: 24px;
            }

            .shopping-actions {
                gap: 12px;
            }

            .shopping-action {
                font-size: 10px;
            }

            .shopping-nav {
                padding: 0 4%;
                gap: 20px;
                overflow-x: auto;
                white-space: nowrap;
            }

            .shopping-hero {
                margin: 18px 4%;
                min-height: 300px;
                padding: 30px 22px;
            }

            .hero-content {
                width: 100%;
            }

            .hero-content h1 {
                font-size: 32px;
            }

            .hero-art {
                right: -90px;
                opacity: .18;
            }

            .shopping-section,
            .product-section {
                padding-left: 4%;
                padding-right: 4%;
            }

            .category-section {
                padding-top: 20px;
                padding-bottom: 22px;
            }

            .category-nav {
                justify-content: flex-start;
            }

            .category-nav a {
                padding: 16px 15px;
                font-size: 11px;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .shopping-product {
                padding: 10px;
            }

            .product-image-box {
                height: 135px;
            }

            .shopping-product h3 {
                font-size: 12px;
            }

            .product-price {
                font-size: 15px;
            }

            .shopping-footer {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- Top Bar -->
    <div class="shopping-topbar">
        <span>Welcome to ElectroMart</span>
        <span>Electronics made simple</span>
    </div>

    <!-- Main Header -->
    <header class="shopping-header">

        <a href="{{ route('storefront.home') }}" class="shopping-logo">
            Electro<span>Mart</span>
        </a>

      

        <div class="shopping-actions">

    
<div class="account-dropdown">
    <a href="#" class="shopping-action account-toggle">
        <span class="action-icon">♙</span>
        <span>Account</span>
    </a>

    <div class="account-menu">
        @auth
            <a href="{{ route('profile.edit') }}">Edit Profile</a>
            <a href="{{ route('orders.index') }}">My Orders</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</div>


<a href="{{ route('wishlist.index') }}" class="shopping-action">
    <span class="action-icon">♡</span>
    <span>Wishlist</span>
</a>


           <a href="{{ route('cart.index') }}" class="shopping-action">
    <span class="action-icon">🛒</span>
    <span>Cart</span>
</a>

        </div>

    </header>

    <!-- Navigation -->
    <nav class="shopping-nav">
        <a href="{{ route('storefront.home') }}">Home</a>
        <a href="#categories">Categories</a>
        <a href="#products" class="nav-highlight">Shop Products</a>
        <a href="#offers">Special Offers</a>
    </nav>

    <!-- Hero Banner -->
    <section class="shopping-hero" id="offers">

        <div class="hero-content">
            <div class="hero-label">WELCOME TO ELECTROMART</div>

            <h1>Upgrade Your<br>Everyday Tech.</h1>

            <p>
                Discover the latest electronics, smart devices and accessories
                selected to make your everyday life better.
            </p>

            <a href="#products" class="hero-button">EXPLORE PRODUCTS &nbsp; →</a>
        </div>

        <div class="hero-art">
            <div class="hero-circle">💻</div>
            <div class="hero-small-item">🎧</div>
        </div>

    </section>

    <!-- Categories: compact horizontal navigation -->
  <!-- Categories: compact horizontal navigation -->

<section class="shopping-section category-section" id="categories">

<nav class="category-nav" aria-label="Shop by category">

    @forelse($categories as $category)
        <a href="#products"
           class="category-filter"
           data-category="{{ $category->name }}">
            {{ $category->name }}
        </a>
    @empty
        <span style="padding: 16px; color: #777;">
            No categories available.
        </span>
    @endforelse

</nav>


</section>


    <!-- Products -->
    <section class="product-section" id="products">

        <div class="section-heading">
            <h2>Latest Products</h2>
           <a href="{{ route('products.index') }}" class="section-link">
    VIEW ALL PRODUCTS →
</a>
        </div>

        <div class="product-grid">

            @forelse($products as $product)

               <div class="shopping-product"
     data-category="{{ $product->subcategory->category->name ?? 'Electronics' }}">

                    <a href="{{ route('storefront.product', $product->id) }}">

                        <div class="product-image-box">

                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                            @else
                                <span style="font-size:45px;">📦</span>
                            @endif

                        </div>

                    </a>

                    <div class="product-category">
                        {{ $product->subcategory->category->name ?? 'Electronics' }}
                    </div>

                    <h3>{{ $product->name }}</h3>

                    <div class="product-price">
                        ₹{{ number_format($product->price, 2) }}
                    </div>

                    <div class="product-stock {{ $product->stock > 0 ? '' : 'out-of-stock' }}">
                        @if($product->stock > 0)
                            In Stock
                        @else
                            Out of Stock
                        @endif
                    </div>

                    <a href="{{ route('storefront.product', $product->id) }}"
                        class="product-button">
                        VIEW DETAILS
                    </a>

                </div>

            @empty

                <div class="empty-products" style="grid-column: 1 / -1;">
                    <h3>No products available yet</h3>
                    <p>Please check back later for new products.</p>
                </div>

            @endforelse

        </div>

    </section>

    <!-- Footer -->
    <footer class="shopping-footer" id="footer">

        <a href="{{ route('storefront.home') }}" class="footer-logo">
            Electro<span>Mart</span>
        </a>

        <p style="margin:0;">
            Your destination for everyday electronics.
        </p>

        <p style="margin:0;">
            © {{ date('Y') }} ElectroMart. All rights reserved.
        </p>

    </footer>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const categoryLinks = document.querySelectorAll('.category-filter');
    const products = document.querySelectorAll('.shopping-product');
    const productsSection = document.getElementById('products');
    const heading = productsSection.querySelector('.section-heading h2');

    categoryLinks.forEach(function (link) {

        link.addEventListener('click', function (event) {
            event.preventDefault();

            const selectedCategory = this.dataset.category;

            let visibleCount = 0;

            products.forEach(function (product) {

                if (product.dataset.category === selectedCategory) {
                    product.style.display = '';
                    visibleCount++;
                } else {
                    product.style.display = 'none';
                }

            });

            heading.textContent = selectedCategory;

            productsSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

    });

});
</script>
</body>
</html>