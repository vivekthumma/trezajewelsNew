@extends('layouts.admin')

@section('title', 'Order Detail #' . $order->order_number)

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card card-white shadow-sm border-0 rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark">Ordered Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small fw-bold">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center py-2">
                                        <div class="me-3 p-1 bg-white border rounded shadow-sm">
                                            <img src="{{ imgPath($item->product->main_image ?? 'assets/images/cart/cart-1.jpg') }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $item->product->name }}</div>
                                            <div class="text-muted small">
                                                @if($item->size) Size: {{ $item->size }} @endif
                                                @if($item->color) Color: {{ $item->color }} @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-dark">${{ number_format($item->price, 2) }}</td>
                                <td class="text-center text-dark">{{ $item->quantity }}</td>
                                <td class="text-end pe-4 fw-bold text-dark">${{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="3" class="text-end ps-4 py-3 fw-bold">Subtotal</td>
                                <td class="text-end pe-4 py-3 fw-bold text-dark">${{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end ps-4 py-2">Discount</td>
                                <td class="text-end pe-4 py-2 text-danger">-${{ number_format($order->discount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end ps-4 py-3 fw-bold fs-5">Grand Total</td>
                                <td class="text-end pe-4 py-3 fw-bold text-primary fs-5">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-white shadow-sm border-0 rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark">Order Status Actions</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="placed">
                        <button type="submit" class="btn btn-secondary px-3 shadow-sm" {{ $order->status == 'placed' ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-bag me-1"></i> Placed
                        </button>
                    </form>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="packed">
                        <button type="submit" class="btn btn-info px-3 shadow-sm" {{ $order->status == 'packed' ? 'disabled' : '' }}>
                            <i class="fas fa-box me-1"></i> Packed
                        </button>
                    </form>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="shipping">
                        <button type="submit" class="btn btn-primary px-3 shadow-sm" {{ $order->status == 'shipping' ? 'disabled' : '' }}>
                            <i class="fas fa-truck me-1"></i> Shipping
                        </button>
                    </form>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="out_for_delivery">
                        <button type="submit" class="btn btn-warning px-3 shadow-sm" {{ $order->status == 'out_for_delivery' ? 'disabled' : '' }}>
                            <i class="fas fa-motorcycle me-1"></i> Out for delivery
                        </button>
                    </form>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="delivered">
                        <button type="submit" class="btn btn-success px-3 shadow-sm" {{ $order->status == 'delivered' ? 'disabled' : '' }}>
                            <i class="fas fa-check-circle me-1"></i> Delivered
                        </button>
                    </form>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger px-3 shadow-sm" {{ $order->status == 'cancelled' ? 'disabled' : '' }}>
                            <i class="fas fa-times-circle me-1"></i> Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card card-white shadow-sm border-0 rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark">Customer Details</h5>
            </div>
            <div class="card-body p-4 text-center">
                <h6 class="fw-bold mb-1 fs-5">{{ $order->first_name }} {{ $order->last_name }}</h6>
                <p class="text-muted small mb-0">{{ $order->email }}</p>
                <hr class="my-3 opacity-10">
                <div class="text-start">
                    <div class="mb-3">
                        <label class="text-uppercase small fw-bold text-muted d-block opacity-50">Phone</label>
                        <span class="fw-semibold text-dark">{{ $order->phone }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-white shadow-sm border-0 rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark">Shipping Information</h5>
            </div>
            <div class="card-body p-4">
                <div class="text-start">
                    <div class="mb-3">
                        <label class="text-uppercase small fw-bold text-muted d-block opacity-50">Address</label>
                        <span class="fw-semibold text-dark d-block mb-1">{{ $order->address }}</span>
                        <span class="fw-semibold text-dark d-block mb-1">{{ $order->city }}, {{ $order->state }}</span>
                        <span class="fw-semibold text-dark d-block">{{ $order->country }} - {{ $order->pincode }}</span>
                    </div>
                    <div class="mb-0">
                        <label class="text-uppercase small fw-bold text-muted d-block opacity-50">Payment Method</label>
                        <span class="fw-bold text-uppercase badge bg-light text-dark border border-dark-subtle px-3 py-2 mt-1">{{ $order->payment_method }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
