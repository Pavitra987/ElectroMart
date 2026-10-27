@extends('admin.layouts.app')

@section('title', 'Edit Category | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Edit Category</h1>
        <p class="page-subtitle">Update your product category details.</p>
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

        <form action="{{ route('admin.categories.update', $category->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $category->name) }}"
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
                >{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Category Image</label>

                @if ($category->image)
                    <div class="mb-2">
                        <img
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            width="100"
                            height="100"
                            style="object-fit: cover; border-radius: 8px;"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="image"
                    name="image"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="text-muted">
                    Leave empty to keep the current image. Maximum size: 2 MB.
                </small>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">Status</label>

                <select id="status" name="status" class="form-select" required>
                    <option value="active"
                        {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-lg"></i> Update Category
            </button>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection