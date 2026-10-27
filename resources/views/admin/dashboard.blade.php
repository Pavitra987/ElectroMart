<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ElectroMart | Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- ApexCharts -->
    <link rel="stylesheet"
        href="{{ asset('assets/libs/apexcharts/apexcharts.css') }}">

    <!-- Flatpickr -->
    <link rel="stylesheet"
        href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Spark Admin CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/main.css') }}">

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
                            class="sidebar-menu-link active"
                            id="menu-overview">

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
                      <a href="{{ route('admin.categories.index') }}" class="sidebar-menu-link">
                        <i class="bi bi-grid"></i>
                           <span>Categories</span>
                         </a>
                    </li>

                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.subcategories.index') }}" class="sidebar-menu-link">
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
    <!-- End Sidebar -->


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
               
            <div class="navbar-heading">
    <span class="navbar-heading-line"></span>
    <h4>ADMIN PANEL</h4>
    <span class="navbar-heading-line"></span>
</div>
            
            

            <!-- Profile Dropdown -->
            <div class="navbar-actions">

                <div class="dropdown ms-2">

                    <button
                        class="navbar-profile-btn dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        id="profile-dropdown">

                        <img
                            src="{{ asset('assets/images/avatar.png') }}"
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
        <!-- End Navbar -->


        <!-- Dashboard Header -->
        <div class="page-header">

            <div>

                <h1 class="page-title">
                    Dashboard
                </h1>

                <p class="page-subtitle">
                    Welcome to ElectroMart administration.
                </p>

            </div>

        </div>


        <!-- Dashboard Cards -->
        <div class="row g-4">

            <!-- Total Products -->
            <div class="col-md-4">

                <div class="card card-stat">

                    <div class="card-header">

                        <span class="stat-label">
                            Total Products
                        </span>

                        <i class="bi bi-box-seam"></i>

                    </div>

                    <div class="stat-value">
                        {{ $totalProducts }}
                    </div>

                    <p class="text-muted">
                        Products available in ElectroMart
                    </p>

                </div>

            </div>


            <!-- Total Categories -->
            <div class="col-md-4">

                <div class="card card-stat">

                    <div class="card-header">

                        <span class="stat-label">
                            Total Categories
                        </span>

                        <i class="bi bi-grid"></i>

                    </div>

                    <div class="stat-value">
                        {{ $totalCategories }}
                    </div>

                    <p class="text-muted">
                        Categories created
                    </p>

                </div>

            </div>


            <!-- Total Orders -->
            <div class="col-md-4">

                <div class="card card-stat">

                    <div class="card-header">

                        <span class="stat-label">
                            Total Orders
                        </span>

                        <i class="bi bi-cart"></i>

                    </div>

                    <div class="stat-value">
                        {{ $totalOrders }} 
                    </div>

                    <p class="text-muted">
                        Orders received
                    </p>

                </div>

            </div>


            <!-- Welcome Card -->
            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        <h2 class="card-title">
                            Welcome to ElectroMart
                        </h2>

                    </div>

                    <div class="card-body">

                        <p>
                            Manage your products, categories,
                            subcategories, customers and orders
                            from this dashboard.
                        </p>

                    </div>

                </div>

            </div>

        </div>


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
    <!-- End Main Content -->


    <!-- Bootstrap JavaScript -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ApexCharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Flatpickr -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Dashboard JavaScript -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

</body>

</html>