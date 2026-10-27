```blade
@extends('admin.layouts.app')

@section('title', 'Customers | ElectroMart')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2>Customer Management</h2>
        <p>View and search your customers.</p>
    </div>

    <!-- Search -->
    <form action="{{ route('admin.customers.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by name or email..."
                   value="{{ request('search') }}">

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Search
            </button>
        </div>
    </form>

    <!-- Customers Table -->
    <div class="card p-4">
        <h5 class="mb-3">All Customers</h5>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->created_at?->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No customers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
```
