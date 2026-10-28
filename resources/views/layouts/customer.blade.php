<!DOCTYPE html>

<html lang="en">

<head>
    <title>@yield('title', 'ElectroMart | Online Electronics Store')</title>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<meta name="author" content="ElectroMart">
<meta name="description" content="Shop electronics, mobiles, laptops and more at ElectroMart.">

<link rel="stylesheet" href="{{ asset('storefront/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('storefront/style.css') }}">
<link rel="stylesheet" href="{{ asset('storefront/css/electromart.css') }}">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap"
      rel="stylesheet">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="{{ asset('storefront/js/modernizr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>


</head>

<body>


{{-- Common Navbar --}}
<header id="header" class="site-header">

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">

        <div class="container">

            <a class="navbar-brand" href="{{ route('storefront.home') }}">
                <span class="fw-bold fs-3 text-success">ElectroMart</span>
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarMenu"
                    aria-controls="navbarMenu"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('storefront.home') }}">
                            Home
                        </a>
                    </li>

                   
                   

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.create') }}"#footer">
                            Contact
                        </a>
                    </li>

                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}#footer">
                            products
                        </a>
                    </li>

                </ul>

                <div class="d-flex align-items-center gap-2">

                    @guest

                        <a href="{{ route('login') }}" class="btn btn-outline-success">
                            Login
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-success">
                            Register
                        </a>

                    @endguest

                    @auth

                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                Account
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        Edit Profile
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('wishlist.index') }}">
                                        Wishlist
                                    </a>
                                </li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @endauth
<a href="{{ route('wishlist.index') }}"
   class="text-dark fs-4 ms-2"
   aria-label="Wishlist"
   title="Wishlist">
    <i class="bi bi-heart"></i>
</a>

<a href="{{ route('cart.index') }}"
   class="text-dark fs-4 ms-2"
   aria-label="Shopping cart"
   title="Shopping Cart">
    🛒
</a>
                </div>

            </div>

        </div>

    </nav>

</header>

{{-- Individual Page Content --}}
<main>
    @yield('content')
</main>

{{-- Common Footer --}}
<footer id="footer" class="bg-dark text-white py-5">

    <div class="container">

        <div class="row">

            <div class="col-md-4 mb-4">
                <h3 class="fw-bold text-success">ElectroMart</h3>

                <p class="text-light">
                    Your one-stop destination for electronics,
                    gadgets and accessories.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>

                <ul class="list-unstyled">

                    <li class="mb-2">
                        <a href="{{ route('storefront.home') }}"
                           class="text-white text-decoration-none">
                            Home
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('storefront.home') }}#categories"
                           class="text-white text-decoration-none">
                            Categories
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('products.index') }}"
                           class="text-white text-decoration-none">
                            Products
                        </a>
                    </li>

                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>

                <p class="text-light">
                    Email: support@electromart.com
                </p>

                <p class="text-light">
                    Online Electronics Store
                </p>
            </div>

        </div>

        <hr class="border-secondary">

        <div class="text-center">
            <p class="mb-0">
                &copy; {{ date('Y') }} ElectroMart. All rights reserved.
            </p>
        </div>

    </div>

</footer>

{{-- Shared JavaScript --}}
<script src="{{ asset('storefront/js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('storefront/js/bootstrap.bundle.min.js') }}"></script>

@stack('scripts')


</body>
</html>
