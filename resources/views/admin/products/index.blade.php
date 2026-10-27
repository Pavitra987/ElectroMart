@extends('admin.layouts.app')

@section('title', 'Products | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Products</h1>
        <p class="page-subtitle">Manage your store products.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Add Product
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Products</h2>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>

                            <td>
                                @if ($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        width="50"
                                        height="50"
                                        style="object-fit: cover; border-radius: 8px;"
                                    >
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>

                            <td>{{ $product->sku }}</td>

                            <td>{{ $product->name }}</td>

                          <td>{{ $product->subcategory->category->name }}</td>

                           <td>{{ $product->subcategory->name }}</td>

                            <td>₹{{ number_format($product->price, 2) }}</td>

                            <td>{{ $product->stock }}</td>

                            <td>
                                @if ($product->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.products.edit', $product->id) }}"
                                    class="btn btn-primary btn-sm"
                                >
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form
                                    action="{{ route('admin.products.destroy', $product->id) }}"
                                    method="POST"
                                    class="d-inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this product?')"
                                    >
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                No products found. Click Add Product to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection