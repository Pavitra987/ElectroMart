@extends('admin.layouts.app')

@section('title', 'Add Subcategory | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Add Subcategory</h1>
        <p class="page-subtitle">Create a new product subcategory.</p>
    </div>

    <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">
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
        <h2 class="card-title">Subcategory Details</h2>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.subcategories.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>

                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Select Category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Subcategory Name</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Enter subcategory name"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="status" class="form-label">Status</label>

                <select name="status" id="status" class="form-select" required>
                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-lg"></i> Save Subcategory
            </button>

            <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection