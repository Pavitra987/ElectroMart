<!DOCTYPE html>
<html lang="en">

<head>
    <title>ElectroMart | Online Electronics Store</title>

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

    <script src="{{ asset('storefront/js/modernizr.js') }}"></script>
    
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</head>


<body>

    <header id="header" class="site-header">

        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">

            <div class="container">

                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('storefront.home') }}">
                    <span class="fw-bold fs-3 text-success">ElectroMart</span>
                </a>

                <!-- Mobile Menu Button -->
                <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarMenu"
                        aria-controls="navbarMenu"
                        aria-expanded="false"
                        aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <!-- Navigation -->
                <div class="collapse navbar-collapse" id="navbarMenu">

                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link active"
                               href="{{ route('storefront.home') }}">
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#categories">
                                Categories
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#products">
                                Shop
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#footer">
                                Contact
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
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-success">
            Profile
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                Logout
            </button>
        </form>
    @endauth

    <a href="#" class="text-dark fs-4 ms-2" aria-label="Shopping cart">
        🛒
    </a>

</div>

                </div>

            </div>

        </nav>

    </header>
<!-- Hero Section -->
<!-- Hero Slider -->
<section class="hero-slider" id="home">

    <div class="hero-slide active">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-7 hero-content">
                    <span class="hero-label">WELCOME TO ELECTROMART</span>

                    <h1>Discover the Latest Electronics</h1>

                    <p>
                        Explore the latest gadgets, smart devices,
                        laptops and accessories for your everyday life.
                    </p>

                    <a href="#categories" class="hero-btn">
                        Explore Collections <span>→</span>
                    </a>
                </div>

                <div class="col-md-5 text-center">
                    <img
                        src="{{ asset('storefront/images/banner-image.png') }}"
                        alt="Discover electronics"
                        class="hero-image"
                    >
                </div>

            </div>
        </div>
    </div>

    <div class="hero-slide">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-7 hero-content">
                    <span class="hero-label">YOUR TECH DESTINATION</span>

                    <h1>Everything You Need, All in One Place</h1>

                    <p>
                        Find your favourite electronics, discover
                        new technology and shop with ease.
                    </p>

                    <a href="#categories" class="hero-btn">
                        Browse Categories <span>→</span>
                    </a>
                </div>

                <div class="col-md-5 text-center">
                    <img
                        src="{{ asset('storefront/images/product-item1.jpg') }}"
                        alt="Explore our product collection"
                        class="hero-image"
                    >
                </div>

            </div>
        </div>
    </div>

    <div class="hero-slide">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-7 hero-content">
                    <span class="hero-label">SMARTER SHOPPING STARTS HERE</span>

                    <h1>Upgrade Your Everyday Life</h1>

                    <p>
                        Discover exciting gadgets and essential
                        electronics to make every day better.
                    </p>

                    <a href="#products" class="hero-btn">
                        Shop Products <span>→</span>
                    </a>
                </div>

                <div class="col-md-5 text-center">
                    <img
                        src="{{ asset('storefront/images/product-item2.jpg') }}"
                        alt="Shop electronics"
                        class="hero-image"
                    >
                </div>

            </div>
        </div>
    </div>

    <button type="button" class="hero-arrow hero-prev"
            aria-label="Previous slide">←</button>

    <button type="button" class="hero-arrow hero-next"
            aria-label="Next slide">→</button>

    <div class="hero-dots" aria-label="Choose slide">
        <button type="button" class="hero-dot active"
                aria-label="Slide 1"></button>
        <button type="button" class="hero-dot"
                aria-label="Slide 2"></button>
        <button type="button" class="hero-dot"
                aria-label="Slide 3"></button>
    </div>

</section>
<!-- End Hero Slider -->
                

<!-- Category Slideshow -->
<section class="category-showcase">
    <div class="container">
        <div class="swiper categorySwiper">
            <div class="swiper-wrapper">
                @foreach($categories as $category)
                    <div class="swiper-slide">
                        <div class="category-slide-card">
                            <div class="category-slide-content">
                                <span class="category-tag">EXPLORE ELECTROMART</span>
                                <h2>{{ $category->name }}</h2>
                                <p>{{ $category->description ?? 'Discover our latest products and find the perfect technology for you.' }}</p>
                                <a href="{{ route('storefront.home', ['category' => $category->id]) }}" class="category-explore-btn">
                                    Explore  <span>→</span>
                                </a>
                            </div>
                            <div class="category-slide-image">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                @else
                                    <div class="category-image-placeholder">
                                        {{ $category->name }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="category-slider-controls">
                <button type="button" class="category-prev" aria-label="Previous category">←</button>
                <div class="category-pagination"></div>
                <button type="button" class="category-next" aria-label="Next category">→</button>
            </div>
        </div>
    </div>
</section>
<!-- End Category Slideshow -->


 <!-- Premium Product Search -->
<section class="product-search-section">
    <div class="container">

        <form action="{{ route('storefront.home') }}"
              method="GET"
              class="premium-search-form">

            <div class="search-input-wrapper">
                <span class="search-symbol">⌕</span>

                <input
                    type="search"
                    name="search"
                    placeholder="Search smartphones, laptops, headphones..."
                    value="{{ request('search') }}"
                    aria-label="Search electronics"
                >

                @if(request('search'))
                    <a href="{{ route('storefront.home') }}"
                       class="clear-search"
                       aria-label="Clear search">
                        &times;
                    </a>
                @endif
            </div>

            <button type="submit" class="premium-search-button">
                Search <span>→</span>
            </button>

        </form>

       
    </div>
</section>
<!-- End Premium Product Search -->

<!-- Products Section -->
<section id="products" class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Products</h2>
            <p class="text-muted">Discover our latest electronics</p>
        </div>

        <div class="row g-4">

            @forelse($products as $product)

                <div class="col-md-4 col-lg-3">

                    <div class="card h-100 border-0 shadow-sm">

                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                class="card-img-top p-3"
                                alt="{{ $product->name }}"
                                style="height: 200px; object-fit: contain;"
                            >
                        @else
                            <div class="text-center py-5 bg-white">
                                <span class="text-muted">No image available</span>
                            </div>
                        @endif

                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $product->name }}
                            </h5>

                            <p class="text-muted small">
                                {{ $product->subcategory->name ?? '' }}
                            </p>

                            <h5 class="text-success">
                                ₹{{ number_format($product->price, 2) }}
                            </h5>

                            <p class="small">
                                Stock: {{ $product->stock }}
                            </p>

<a href="{{ route('storefront.product', $product->id) }}" class="btn btn-dark">
    View Product
</a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center">
                    <p class="text-muted">No products available yet.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>
<!-- End Products Section -->

<!-- Footer -->
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
                        <a href="#categories"
                           class="text-white text-decoration-none">
                            Categories
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#products"
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
<!-- End Footer -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const nextButton = document.querySelector('.hero-next');
    const prevButton = document.querySelector('.hero-prev');

    let currentSlide = 0;
    let sliderInterval;

    function showSlide(index) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');

        currentSlide = (index + slides.length) % slides.length;

        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function previousSlide() {
        showSlide(currentSlide - 1);
    }

    function startAutoSlide() {
        clearInterval(sliderInterval);

        sliderInterval = setInterval(function () {
            nextSlide();
        }, 5000);
    }

    nextButton.addEventListener('click', function () {
        nextSlide();
        startAutoSlide();
    });

    prevButton.addEventListener('click', function () {
        previousSlide();
        startAutoSlide();
    });

    dots.forEach(function (dot, index) {
        dot.addEventListener('click', function () {
            showSlide(index);
            startAutoSlide();
        });
    });

    const slider = document.querySelector('.hero-slider');

    slider.addEventListener('mouseenter', function () {
        clearInterval(sliderInterval);
    });

    slider.addEventListener('mouseleave', function () {
        startAutoSlide();
    });

    startAutoSlide();

});


document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.categorySwiper', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 20,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        pagination: {
            el: '.category-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.category-next',
            prevEl: '.category-prev'
        }
    });
});
</script>
</body>
</html>