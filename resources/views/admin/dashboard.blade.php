@extends('admin.layouts.app')

@section('title', 'Dashboard | ElectroMart')

@section('content')


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


       

   


   

</body>

</html>
@endsection