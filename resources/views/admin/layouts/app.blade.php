<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ElectroMart Admin')</title>

    <link rel="icon" type="image/png"
        href="{{ asset('assets/images/favicon.ico') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/css/main.css') }}">

    <link rel="stylesheet"
        href="{{ asset('assets/style.css') }}">

    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar-wrapper" id="sidebar">

        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <i class="bi bi-asterisk"></i>
            <span>ElectroMart</span>
        </a>

        <div class="flex-grow-1 overflow-y-auto">

            <div class="sidebar-menu-section">

                <div class="sidebar-menu-title">Menu</div>

                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.dashboard') }}"
                           class="sidebar-menu-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>

            </div>

            <div class="sidebar-menu-section">

                <div class="sidebar-menu-title">Products</div>

                <ul class="sidebar-menu-list">

                    <li class="sidebar-menu-item">
                      <a href="{{ route('admin.products.index') }}" class="sidebar-menu-link">
                  <i class="bi bi-box-seam"></i>
                <span>Products</span>
                       </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.categories.index') }}"
                           class="sidebar-menu-link">
                            <i class="bi bi-grid"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.subcategories.index') }}"
                           class="sidebar-menu-link">
                            <i class="bi bi-tags"></i>
                            <span>Subcategories</span>
                        </a>
                    </li>

                </ul>

            </div>

            <div class="sidebar-menu-section">

                <div class="sidebar-menu-title">Management</div>

                <ul class="sidebar-menu-list">

                  <li class="sidebar-menu-item">
    <a href="{{ route('admin.orders.index') }}" class="sidebar-menu-link">
        <i class="bi bi-cart"></i>
        <span>Orders</span>
    </a>
</li>

                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.customers.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>
                    </li>

                </ul>

            </div>

        </div>

        <!-- Admin Profile -->
        <div class="sidebar-profile">

            <img src="{{ asset('assets/images/avatar.png') }}"
                 alt="Administrator"
                 class="sidebar-profile-img">

            <div class="sidebar-profile-info">

                <div class="sidebar-profile-name">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </div>

                <div class="sidebar-profile-email">
                    {{ auth()->user()->email ?? 'admin@electromart.com' }}
                </div>

            </div>

        </div>

    </div>

    <!-- Main Content -->
    <div class="main-wrapper">

        <!-- Navbar -->
        <header class="navbar-custom">

            <div class="navbar-left">

                <button
                    class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                    id="desktop-sidebar-toggle"
                    aria-label="Minimize Sidebar">

                    <i class="bi bi-chevron-bar-left"></i>

                </button>

                <button
                    class="sidebar-toggle-btn me-2"
                    id="sidebar-toggle"
                    aria-label="Toggle Navigation">

                    <i class="bi bi-list"></i>

                </button>

            </div>
@if (!request()->routeIs('admin.dashboard'))
    <div class="navbar-search-wrapper">

        <input type="text"
               class="navbar-search-input"
               placeholder="Search..."
               id="main-search">

        <button class="navbar-search-btn" aria-label="Search">
            <i class="bi bi-search"></i>
        </button>

    </div>
@endif

            <div class="navbar-actions">

                <div class="dropdown ms-2">

                    <button
                        class="navbar-profile-btn dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        id="profile-dropdown">

                        <img src="{{ asset('assets/images/avatar.png') }}"
                             alt="Profile Image"
                             class="navbar-profile-img">

                        <span class="navbar-profile-name d-none d-md-inline">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </span>

                        <i class="bi bi-chevron-down navbar-profile-caret"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">

                        <li class="dropdown-header">
                            Admin Account
                        </li>

                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                        class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                        </li>

                    </ul>

                </div>

            </div>

        </header>

        <!-- Page Content -->
        <main class="container-fluid">

            @yield('content')

        </main>

        <!-- Footer -->
        <footer class="footer-custom">

            <div class="footer-left">

                <span class="footer-logo">
                    <i class="bi bi-asterisk"></i>
                    ElectroMart
                </span>

                <span class="footer-separator">|</span>

                <span class="footer-copy">
                    &copy; 2026 ElectroMart. All rights reserved.
                </span>

            </div>

        </footer>

    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    @stack('scripts')
    
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('main-search');
    const searchButton = document.querySelector('.navbar-search-btn');

    if (!searchInput) return;

    const currentUrl = new URL(window.location.href);

    // Keep the current search text when the page reloads
    searchInput.value = currentUrl.searchParams.get('search') || '';

    function performSearch() {
        const search = searchInput.value.trim();
        const url = new URL(window.location.href);

        if (search) {
            url.searchParams.set('search', search);
        } else {
            url.searchParams.delete('search');
        }

        window.location.href = url.toString();
    }

    if (searchButton) {
        searchButton.addEventListener('click', performSearch);
    }

    searchInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            performSearch();
        }
    });

});
</script>



</body>
</html>