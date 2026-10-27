@extends('admin.layouts.app')

@section('title', 'Add Category | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Add Category</h1>
        <p class="page-subtitle">Create a new product category.</p>
    </div>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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
        <h2 class="card-title">Category Details</h2>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.categories.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Enter category name"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    rows="4"
                    placeholder="Enter category description"
                >{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Category Image</label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="text-muted">
                    Allowed formats: JPG, JPEG, PNG, WEBP. Maximum size: 2 MB.
                </small>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">Status</label>

                <select id="status" name="status" class="form-select" required>
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
                <i class="bi bi-check-lg"></i> Save Category
            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection