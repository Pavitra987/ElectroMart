@extends('admin.layouts.app')

@section('content')

<div class="container-fluid py-4">

    <h2 class="mb-4">Customer Orders</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Total Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>{{ $order->user->email ?? 'N/A' }}</td>
                            <td>₹{{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                               <a href="{{ route('admin.orders.show', $order->id) }}"
                                  class="btn btn-primary btn-sm">
                                        View Details
                                            </a>
                                              </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection