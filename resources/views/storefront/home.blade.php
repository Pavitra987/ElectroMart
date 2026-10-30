@extends('layouts.customer')

@section('title', 'ElectroMart | Online Electronics Store')

@section('content')

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
<section class="category-showcase" id="categories">
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
                             <a href="{{ route('products.index', ['category' => $category->id]) }}" class="category-explore-btn">
    Explore <span>→</span>
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

       <form action="{{ route('storefront.home') }}#products"
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

<a href="{{ route('storefront.product', $product->id) }}" class="btn btn-dark mb-2">
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

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const nextButton = document.querySelector('.hero-next');
    const prevButton = document.querySelector('.hero-prev');

    if (slides.length && dots.length && nextButton && prevButton) {
        let currentSlide = 0;
        let sliderInterval;

        function showSlide(index) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = (index + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function startAutoSlide() {
            clearInterval(sliderInterval);
            sliderInterval = setInterval(() => showSlide(currentSlide + 1), 5000);
        }

        nextButton.addEventListener('click', () => { showSlide(currentSlide + 1); startAutoSlide(); });
        prevButton.addEventListener('click', () => { showSlide(currentSlide - 1); startAutoSlide(); });
        dots.forEach((dot, index) => dot.addEventListener('click', () => { showSlide(index); startAutoSlide(); }));

        const slider = document.querySelector('.hero-slider');
        if (slider) {
            slider.addEventListener('mouseenter', () => clearInterval(sliderInterval));
            slider.addEventListener('mouseleave', startAutoSlide);
        }
        startAutoSlide();
    }

    if (typeof Swiper !== 'undefined' && document.querySelector('.categorySwiper')) {
        new Swiper('.categorySwiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.category-pagination', clickable: true },
            navigation: { nextEl: '.category-next', prevEl: '.category-prev' }
        });
    }
});
</script>
@endpush
