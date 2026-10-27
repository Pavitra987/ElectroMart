@extends('admin.layouts.app')

@section('content')

<div class="container-fluid py-4">

    <h2 class="mb-4">Order Details</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5>Customer Information</h5>
        </div>

        <div class="card-body">
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Customer Name:</strong> {{ $order->recipient_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>City:</strong> {{ $order->city }}</p>
            <p><strong>State:</strong> {{ $order->state }}</p>
            <p><strong>Postal Code:</strong> {{ $order->postal_code }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
            <hr>

<h4>Update Order Status</h4>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <label for="status">Order Status</label>

    <select name="status" id="status" class="form-control">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>

    <br>

    <button type="submit" class="btn btn-success">
        Update Status
    </button>
</form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5>Ordered Products</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>₹{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            <h5 class="text-end mt-3">
                Total: ₹{{ number_format($order->total_amount, 2) }}
            </h5>

        </div>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        Back to Orders
    </a>

</div>

@endsection