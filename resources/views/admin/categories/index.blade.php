@extends('admin.layouts.app')

@section('title', 'Categories | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Categories</h1>
        <p class="page-subtitle">Manage your product categories.</p>
    </div>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Add Category
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
        <h2 class="card-title">All Categories</h2>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($categories as $category)

                        <tr>
                            <td>{{ $category->id }}</td>

                            <td>
                                @if ($category->image)
                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        width="55"
                                        height="55"
                                        style="object-fit: cover; border-radius: 8px;"
                                    >
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>

                            <td>{{ $category->name }}</td>

                            <td>{{ $category->description ?: '—' }}</td>

                            <td>
                                @if ($category->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form
                                    action="{{ route('admin.categories.destroy', $category->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?')">

                                        <i class="bi bi-trash"></i> Delete

                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No categories found. Click Add Category to create one.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection