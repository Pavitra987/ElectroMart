@extends('admin.layouts.app')

@section('title', 'Edit Product | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Edit Product</h1>
        <p class="page-subtitle">Update your product details.</p>
    </div>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Product Details</h2>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="subcategory_id" class="form-label">Subcategory</label>

                <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                    <option value="">Select Subcategory</option>

                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}"
                            {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>

                <input type="text"
                       name="sku"
                       id="sku"
                       class="form-control"
                       value="{{ old('sku', $product->sku) }}"
                       required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>

                <input type="text"
                       name="name"
                       id="name"
                       class="form-control"
                       value="{{ old('name', $product->name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>

                <textarea name="description"
                          id="description"
                          class="form-control"
                          rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price (₹)</label>

                    <input type="number"
                           name="price"
                           id="price"
                           class="form-control"
                           value="{{ old('price', $product->price) }}"
                           step="0.01"
                           min="0"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock Quantity</label>

                    <input type="number"
                           name="stock"
                           id="stock"
                           class="form-control"
                           value="{{ old('stock', $product->stock) }}"
                           min="0"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>

                @if ($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             width="100"
                             height="100"
                             style="object-fit: cover; border-radius: 8px;">
                    </div>
                @endif

                <input type="file"
                       name="image"
                       id="image"
                       class="form-control"
                       accept=".jpg,.jpeg,.png,.webp">

                <small class="text-muted">
                    Leave empty to keep the current image. Maximum size: 2 MB.
                </small>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">Status</label>

                <select name="status" id="status" class="form-select" required>
                    <option value="active"
                        {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-lg"></i> Update Product
            </button>

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection