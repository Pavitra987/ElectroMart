@extends('admin.layouts.app')

@section('title', 'Subcategories | ElectroMart')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Subcategories</h1>
        <p class="page-subtitle">Manage your product subcategories.</p>
    </div>

    <a href="{{ route('admin.subcategories.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Add Subcategory
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
        <h2 class="card-title">All Subcategories</h2>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Subcategory Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($subcategories as $subcategory)
                        <tr>
                            <td>{{ $subcategory->id }}</td>

                            <td>{{ $subcategory->category->name }}</td>

                            <td>{{ $subcategory->name }}</td>

                            <td>
                                @if ($subcategory->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this subcategory?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No subcategories found. Click Add Subcategory to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection