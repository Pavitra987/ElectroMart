
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   @extends('layouts.customer')

@section('title', 'My Wishlist')

@section('content')

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #fff;
            color: #191919;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        
        /* Filter Section */
        .filter-section {
            margin: 0 5% 35px;
            padding: 25px;
            background: #f8f8f8;
            border: 1px solid #eee;
            border-radius: 6px;
        }

        .filter-section h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .product-filters {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto auto;
            gap: 12px;
        }

        .product-filters input,
        .product-filters select {
            width: 100%;
            min-width: 0;
            padding: 13px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
        }

        .product-filters input:focus,
        .product-filters select:focus {
            border-color: #555;
        }

        .filter-btn {
            padding: 13px 22px;
            border: 1px solid #222;
            background: #222;
            color: white;
            cursor: pointer;
            font-size: 13px;
            white-space: nowrap;
        }

        .filter-btn:hover {
            background: #444;
        }

        .reset-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            color: #333;
            font-size: 14px;
        }

        .reset-btn:hover {
            color: #888;
        }

        /* Products Section */
        .product-section {
            padding: 35px 5% 50px;
            background: #f8f8f8;
            min-height: 400px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .section-heading h2 {
            font-size: 26px;
            font-weight: 800;
        }

        .product-count {
            color: #777;
            font-size: 14px;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px;
        }

        .shopping-product {
            background: white;
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 18px;
            transition: 0.25s;
        }

        .shopping-product:hover {
            border-color: #ddd;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            transform: translateY(-3px);
        }

        .product-image-box {
            height: 210px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }

        .product-image-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .no-image {
            color: #888;
            font-size: 13px;
        }

        .product-category {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 9px;
        }

        .shopping-product h3 {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.5;
            margin-bottom: 8px;
            min-height: 44px;
        }

        .product-subcategory {
            color: #777;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .product-price {
            font-size: 19px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .product-stock {
            color: #198754;
            font-size: 12px;
            margin-bottom: 16px;
        }

        .product-stock.out-of-stock {
            color: #dc3545;
        }

        .product-button {
            display: block;
            text-align: center;
            padding: 12px;
            border: 1px solid #222;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 700;
            transition: 0.2s;
        }

        .product-button:hover {
            background: #222;
            color: white;
        }

        /* No Products */
        .empty-products {
            grid-column: 1 / -1;
            text-align: center;
            background: white;
            padding: 55px 20px;
            color: #777;
            border-radius: 6px;
        }

        .empty-products h3 {
            margin-bottom: 10px;
            color: #333;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 35px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper nav div:first-child {
            display: none;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: inline-block;
            padding: 9px 14px;
            margin: 0 3px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 4px;
            font-size: 13px;
        }

        .pagination-wrapper span[aria-current="page"] span {
            background: #222;
            color: white;
            border-color: #222;
        }

        .pagination-wrapper a:hover {
            background: #eee;
        }
        .products-navbar {
    background: #fff;
    padding: 22px 5%;
    border-bottom: 1px solid #eee;
}

.products-navbar-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
    max-width: 1500px;
    margin: auto;
}

.products-logo {
    font-size: 30px;
    font-weight: 800;
    color: #111;
    text-decoration: none;
    white-space: nowrap;
}

.products-nav-links,
.products-nav-actions {
    display: flex;
    align-items: center;
    gap: 25px;
}

.products-nav-links a {
    color: #333;
    text-decoration: none;
    font-size: 16px;
}

.products-nav-actions a {
    text-decoration: none;
    color: #111;
}

.nav-login,
.nav-register {
    padding: 12px 18px;
    background: #111;
    color: #fff !important;
    border-radius: 5px;
}

.nav-icon-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 3px;
    font-size: 14px;
}

.nav-icon {
    font-size: 24px;
}

@media (max-width: 900px) {
    .products-navbar-inner {
        flex-wrap: wrap;
        justify-content: center;
    }

    .products-nav-links,
    .products-nav-actions {
        flex-wrap: wrap;
        justify-content: center;
    }
}

        /* Responsive */
        @media (max-width: 1100px) {
            .product-filters {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .product-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .products-banner {
                margin: 25px 4%;
                padding: 28px;
            }

            .products-banner h1 {
                font-size: 27px;
            }

            .filter-section {
                margin: 0 4% 25px;
                padding: 18px;
            }

            .product-section {
                padding: 28px 4%;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .product-image-box {
                height: 160px;
            }

            .shopping-product {
                padding: 12px;
            }

            .shopping-product h3 {
                font-size: 14px;
            }

            .section-heading h2 {
                font-size: 21px;
            }
        }

        @media (max-width: 480px) {
            .product-filters {
                grid-template-columns: 1fr;
            }

            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .product-image-box {
                height: 125px;
            }

            .products-banner h1 {
                font-size: 24px;
            }

            .section-heading {
                align-items: flex-start;
                gap: 10px;
                flex-direction: column;
            }
        }
    </style>
<


</header>

    

    <!-- Filters -->
    <section class="filter-section">

        <h3>Find Your Products</h3>

        <form action="{{ route('products.index') }}"
              method="GET"
              class="product-filters">

            <!-- Search -->
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by product name..."
            >

            <!-- Category -->
<select name="category_id" id="category-filter">
    <option value="">All Categories</option>

    @foreach($categories as $category)
        <option value="{{ $category->id }}"
            {{ (string) request('category_id', request('category')) === (string) $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
            <!-- Subcategory -->
<select name="subcategory_id" id="subcategory-filter">
    <option value="">All Subcategories</option>

    @foreach($subcategories as $subcategory)
        <option value="{{ $subcategory->id }}"
            data-category="{{ $subcategory->category_id }}"
            {{ request('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
            {{ $subcategory->name }}
        </option>
    @endforeach
</select>


            <button type="submit" class="filter-btn">
                Apply Filters
            </button>

            <a href="{{ route('products.index') }}" class="reset-btn">
                Reset
            </a>

        </form>

    </section>

    <!-- Products -->
    <section class="product-section">

        <div class="section-heading">
            <h2>All Products</h2>

            <span class="product-count">
                {{ $products->total() }} products found
            </span>
        </div>

        <div class="product-grid">

            @forelse($products as $product)

                <div class="shopping-product">

                    <!-- Product Image -->
                    <a href="{{ route('storefront.product', $product->id) }}">

                        <div class="product-image-box">

                            @if($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >
                            @else
                                <span class="no-image">No image available</span>
                            @endif

                        </div>

                    </a>

                    <!-- Category -->
                    <div class="product-category">
                        {{ $product->subcategory->category->name ?? 'Electronics' }}
                    </div>

                    <!-- Product Name -->
                    <h3>{{ $product->name }}</h3>

                    <!-- Subcategory -->
                    <div class="product-subcategory">
                        {{ $product->subcategory->name ?? '' }}
                    </div>

                    <!-- Price -->
                    <div class="product-price">
                        ₹{{ number_format($product->price, 2) }}
                    </div>

                    <!-- Stock -->
                    <div class="product-stock {{ $product->stock > 0 ? '' : 'out-of-stock' }}">

                        @if($product->stock > 0)
                            In Stock
                        @else
                            Out of Stock
                        @endif

                    </div>

                    <!-- Details -->
                    <a
                        href="{{ route('storefront.product', $product->id) }}"
                        class="product-button"
                    >
                        VIEW DETAILS
                    </a>

                </div>

            @empty

                <div class="empty-products">
                    <h3>No products found</h3>
                    <p>Try changing your search or filters.</p>
                </div>

            @endforelse

        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>

    </section>

    <!-- Category and Subcategory Filter -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const categorySelect = document.getElementById('category-filter');
    const subcategorySelect = document.getElementById('subcategory-filter');

    if (!categorySelect || !subcategorySelect) {
        return;
    }

    function filterSubcategories() {

        const categoryId = categorySelect.value;

        Array.from(subcategorySelect.options).forEach(function (option, index) {

            if (index === 0) {
                option.hidden = false;
                return;
            }

            option.hidden =
                categoryId !== '' &&
                option.dataset.category !== categoryId;
        });

        const selectedOption =
            subcategorySelect.options[subcategorySelect.selectedIndex];

        if (selectedOption && selectedOption.hidden) {
            subcategorySelect.value = '';
        }
    }

    categorySelect.addEventListener('change', filterSubcategories);

    filterSubcategories();
});
</script>

</body>
</html>
@endsection