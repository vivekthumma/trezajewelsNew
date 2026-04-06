@extends('layouts.admin')

@section('title', 'Customer Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Back Button -->
        <div class="col-12 mb-4">
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Back to Customer List
            </a>
        </div>

        <!-- Customer Summary Card -->
        <div class="col-lg-4">
            <div class="card card-white shadow-sm border-0 rounded-4 mb-4 text-center overflow-hidden">
                <div class="card-header border-0 bg-primary py-5">
                    <div class="rounded-circle bg-white text-primary d-inline-flex align-items-center justify-content-center fw-bold border border-4 border-white mx-auto shadow-sm" style="width: 100px; height: 100px; font-size: 36px;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
                <div class="card-body px-4 pt-1 pb-4 mt-1">
                    <h4 class="fw-bold text-dark mt-3 mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-4 small"><i class="fas fa-envelope me-2"></i>{{ $user->email }}</p>
                    
                    <div class="row text-start g-3">
                        <div class="col-12 border-bottom pb-2">
                            <label class="text-uppercase x-small text-muted fw-bold d-block">Phone Number</label>
                            <span class="text-dark fw-semibold">{{ $user->phone ?? 'Not provided' }}</span>
                        </div>
                        <div class="col-12 border-bottom pb-2">
                            <label class="text-uppercase x-small text-muted fw-bold d-block">Member Since</label>
                            <span class="text-dark fw-semibold">{{ $user->created_at->format('d M, Y') }} ({{ $user->created_at->diffForHumans() }})</span>
                        </div>
                        <div class="col-12 border-bottom pb-2">
                            <label class="text-uppercase x-small text-muted fw-bold d-block">Total Orders</label>
                            <span class="badge bg-primary-subtle border border-primary-subtle text-primary rounded-pill px-3 py-1">
                                {{ \App\Models\Order::where('user_id', $user->id)->count() }} Orders
                            </span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 rounded-pill shadow-sm py-2">
                                <i class="fas fa-trash-alt me-2"></i>Delete Customer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Details & Order History -->
        <div class="col-lg-8">
            <div class="card card-white shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold"><i class="fas fa-shipping-fast me-2 text-primary"></i>Shipping Address</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Full Address</label>
                            <p class="fs-6 text-dark bg-light p-3 rounded-3 border">
                                {{ $user->address ?? 'No address provided' }}
                            </p>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">City</label>
                            <div class="fw-semibold text-dark">{{ $user->city ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">State</label>
                            <div class="fw-semibold text-dark">{{ $user->state ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Postcode</label>
                            <div class="fw-semibold text-dark">{{ $user->pincode ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Country</label>
                            <div class="fw-semibold text-dark">{{ $user->country ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-white shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 fw-bold"><i class="fas fa-shopping-bag me-2 text-primary"></i>Order History</h5>
                    <span class="badge bg-light text-dark border">Recent Orders</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light x-small fw-bold text-uppercase">
                                <tr>
                                    <th class="ps-4">Order ID</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $orders = \App\Models\Order::where('user_id', $user->id)->latest()->take(5)->get();
                                @endphp
                                @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">{{ $order->id }}</td>
                                    <td class="text-center small">{{ $order->created_at->format('d M, Y') }}</td>
                                    <td class="text-center fw-bold text-dark">₹{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="text-center">
                                        @php
                                            $badgeClass = match($order->status) {
                                                'delivered' => 'bg-success',
                                                'shipped' => 'bg-info',
                                                'cancelled' => 'bg-danger',
                                                default => 'bg-warning',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} rounded-pill px-3 py-1 small text-capitalize">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-link text-primary p-0">View Details</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <p class="mb-0">No orders found for this customer.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
