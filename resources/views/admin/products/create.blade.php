@extends('admin.layouts.app')

@section('title', 'Add Product | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Add Product</h1>
        <p class="page-subtitle">Add a new product to your store.</p>
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

        <form action="{{ route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

           <div class="mb-3">
    <label for="category_id" class="form-label">Category</label>

    <select name="category_id" id="category_id" class="form-select" required>
        <option value="">Select Category</option>

        @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="subcategory_id" class="form-label">Subcategory</label>

    <select name="subcategory_id" id="subcategory_id" class="form-select" required disabled>
        <option value="">Select Category First</option>
    </select>
</div>

            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>

                <input type="text"
                       name="sku"
                       id="sku"
                       class="form-control"
                       value="{{ old('sku') }}"
                       placeholder="Enter unique product code"
                       required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>

                <input type="text"
                       name="name"
                       id="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Enter product name"
                       required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>

                <textarea name="description"
                          id="description"
                          class="form-control"
                          rows="4"
                          placeholder="Enter product description">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price (₹)</label>

                    <input type="number"
                           name="price"
                           id="price"
                           class="form-control"
                           value="{{ old('price') }}"
                           step="0.01"
                           min="0"
                           placeholder="Enter price"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock Quantity</label>

                    <input type="number"
                           name="stock"
                           id="stock"
                           class="form-control"
                           value="{{ old('stock', 0) }}"
                           min="0"
                           placeholder="Enter stock quantity"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>

                <input type="file"
                       name="image"
                       id="image"
                       class="form-control"
                       accept=".jpg,.jpeg,.png,.webp">

                <small class="text-muted">
                    Allowed formats: JPG, JPEG, PNG, WEBP. Maximum size: 2 MB.
                </small>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">Status</label>

                <select name="status" id="status" class="form-select" required>
                    <option value="active"
                        {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-lg"></i> Save Product
            </button>

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>
@endsection
@push('scripts')
<script>
    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');

    categorySelect.addEventListener('change', function () {
        const categoryId = this.value;

        subcategorySelect.innerHTML = '<option value="">Loading...</option>';
        subcategorySelect.disabled = true;

        if (!categoryId) {
            subcategorySelect.innerHTML = '<option value="">Select Category First</option>';
            return;
        }

        fetch(`/admin/categories/${categoryId}/subcategories`)
            .then(response => response.json())
            .then(data => {
                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

                data.forEach(subcategory => {
                    const option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subcategorySelect.appendChild(option);
                });

                subcategorySelect.disabled = data.length === 0;

                if (data.length === 0) {
                    subcategorySelect.innerHTML = '<option value="">No Subcategories Available</option>';
                }
            })
            .catch(error => {
                console.error('Error loading subcategories:', error);
                subcategorySelect.innerHTML = '<option value="">Unable to load subcategories</option>';
            });
    });
</script>
@endpush