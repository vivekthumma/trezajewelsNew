@extends('layouts.admin')

@section('title', 'Order Detail #' . $order->order_number)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Ordered Items -->
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
                                <td class="text-center text-dark">₹{{ number_format($item->price, 2) }}</td>
                                <td class="text-center text-dark">{{ $item->quantity }}</td>
                                <td class="text-end pe-4 fw-bold text-dark">₹{{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="3" class="text-end ps-4 py-3 fw-bold">Subtotal</td>
                                <td class="text-end pe-4 py-3 fw-bold text-dark">₹{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end ps-4 py-2">Discount</td>
                                <td class="text-end pe-4 py-2 text-danger">-₹{{ number_format($order->discount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end ps-4 py-3 fw-bold fs-5">Grand Total</td>
                                <td class="text-end pe-4 py-3 fw-bold text-primary fs-5">₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Status Actions -->
        <div class="card card-white shadow-sm border-0 rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold text-dark">Order Status Actions</h5>
                <span class="badge bg-soft-primary px-3 py-2 rounded-pill text-primary fw-bold text-uppercase" style="background-color: rgba(206, 175, 107, 0.1); color: #ceaf6b !important; border: 1px solid rgba(206, 175, 107, 0.2);">Current: {{ str_replace('_', ' ', $order->status) }}</span>
            </div>
            <div class="card-body p-4">
                @php
                    $statusHierarchy = [
                        'placed' => 1,
                        'packed' => 2,
                        'shipping' => 3,
                        'out_for_delivery' => 4,
                        'delivered' => 5,
                        'cancelled' => 0 
                    ];
                    $currentStatusLevel = $statusHierarchy[$order->status] ?? 0;
                @endphp

                <style>
                    .status-stepper { display: flex; justify-content: space-between; position: relative; margin-bottom: 3rem; padding: 0 1rem; }
                    .status-stepper::before { content: ""; position: absolute; top: 15px; left: 0; right: 0; height: 3px; background: #eee; z-index: 1; }
                    .status-progress-bar { position: absolute; top: 15px; left: 0; height: 3px; background: #ceaf6b; z-index: 2; transition: width 0.4s ease; }
                    .status-step { position: relative; z-index: 3; display: flex; flex-direction: column; align-items: center; width: 40px; }
                    .step-dot { width: 32px; height: 32px; border-radius: 50%; background: #fff; border: 3px solid #eee; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; font-size: 14px; color: #ccc; }
                    .status-step.active .step-dot { border-color: #ceaf6b; color: #ceaf6b; box-shadow: 0 0 15px rgba(206, 175, 107, 0.3); }
                    .status-step.completed .step-dot { background: #ceaf6b; border-color: #ceaf6b; color: #fff; }
                    .step-label { position: absolute; top: 40px; white-space: nowrap; font-size: 11px; font-weight: 600; text-transform: uppercase; color: #999; margin-top: 5px; }
                    .status-step.active .step-label { color: #ceaf6b; }
                    .status-step.completed .step-label { color: #444; }
                    
                    .btn-status { transition: all 0.3s ease; border: none; border-radius: 10px; padding: 12px 20px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
                    .btn-status:hover:not(:disabled) { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
                    .btn-status:disabled { opacity: 0.5; filter: grayscale(0.8); cursor: not-allowed; }
                    .btn-placed { background: #f8f9fa; color: #6c757d; border: 1px solid #dee2e6; }
                    .btn-packed { background: rgba(13, 202, 240, 0.1); color: #0dcaf0; border: 1px solid rgba(13, 202, 240, 0.2); }
                    .btn-shipping { background: rgba(206, 175, 107, 0.1); color: #ceaf6b; border: 1px solid rgba(206, 175, 107, 0.2); }
                    .btn-delivery { background: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.2); }
                    .btn-delivered { background: rgba(25, 135, 84, 0.1); color: #198754; border: 1px solid rgba(25, 135, 84, 0.2); }
                    .btn-cancel { background: rgba(220, 53, 69, 0.1); color: #dc3545; border: 1px solid rgba(220, 53, 69, 0.2); }
                </style>

                <!-- Stepper Progress UI -->
                <div class="status-stepper mt-2">
                    <div class="status-progress-bar" style="width: {{ $order->status == 'cancelled' ? '0' : ($currentStatusLevel - 1) * 25 }}%;"></div>
                    <div class="status-step {{ $currentStatusLevel >= 1 ? 'completed' : ($currentStatusLevel == 1 ? 'active' : '') }}">
                        <div class="step-dot"><i class="fas fa-check small"></i></div>
                        <div class="step-label">Placed</div>
                    </div>
                    <div class="status-step {{ $currentStatusLevel > 2 ? 'completed' : ($currentStatusLevel == 2 ? 'active' : '') }}">
                        <div class="step-dot"><i class="{{ $currentStatusLevel >= 2 ? 'fas fa-check small' : 'fas fa-box' }}"></i></div>
                        <div class="step-label">Packed</div>
                    </div>
                    <div class="status-step {{ $currentStatusLevel > 3 ? 'completed' : ($currentStatusLevel == 3 ? 'active' : '') }}">
                        <div class="step-dot"><i class="{{ $currentStatusLevel >= 3 ? 'fas fa-check small' : 'fas fa-truck' }}"></i></div>
                        <div class="step-label">Shipping</div>
                    </div>
                    <div class="status-step {{ $currentStatusLevel > 4 ? 'completed' : ($currentStatusLevel == 4 ? 'active' : '') }}">
                        <div class="step-dot"><i class="{{ $currentStatusLevel >= 4 ? 'fas fa-check small' : 'fas fa-motorcycle' }}"></i></div>
                        <div class="step-label">Out for delivery</div>
                    </div>
                    <div class="status-step {{ $currentStatusLevel == 5 ? 'completed' : '' }}">
                        <div class="step-dot"><i class="{{ $currentStatusLevel == 5 ? 'fas fa-check-circle' : 'fas fa-flag-checkered' }}"></i></div>
                        <div class="step-label">Delivered</div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-2">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="h-100">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="placed">
                            <button type="submit" class="btn-status btn-placed w-100 h-100" {{ $currentStatusLevel >= 1 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-bag"></i> Placed
                            </button>
                        </form>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="h-100">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="packed">
                            <button type="submit" class="btn-status btn-packed w-100 h-100" {{ $currentStatusLevel >= 2 ? 'disabled' : '' }}>
                                <i class="fas fa-box"></i> Packed
                            </button>
                        </form>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="h-100">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="shipping">
                            <button type="submit" class="btn-status btn-shipping w-100 h-100" {{ $currentStatusLevel >= 3 ? 'disabled' : '' }}>
                                <i class="fas fa-truck"></i> Shipping
                            </button>
                        </form>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="h-100">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="out_for_delivery">
                            <button type="submit" class="btn-status btn-delivery w-100 h-100" {{ $currentStatusLevel >= 4 ? 'disabled' : '' }}>
                                <i class="fas fa-motorcycle"></i> Out for Delivery
                            </button>
                        </form>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="h-100">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="delivered">
                            <button type="submit" class="btn-status btn-delivered w-100 h-100" {{ $currentStatusLevel >= 5 ? 'disabled' : '' }}>
                                <i class="fas fa-check-circle"></i> Delivered
                            </button>
                        </form>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="h-100">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="btn-status btn-cancel w-100 h-100" {{ $order->status == 'cancelled' || $order->status == 'delivered' ? 'disabled' : '' }}>
                                <i class="fas fa-times-circle"></i> Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Section -->
    <div class="col-lg-4">
        <div class="card card-white shadow-sm border-0 rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark"><i class="fas fa-user-circle me-2 text-muted"></i>Customer Details</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-circle bg-soft-primary text-primary me-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 45px; height: 45px; background: rgba(206, 175, 107, 0.1); color: #ceaf6b !important;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 fs-6 text-dark">{{ $order->first_name }} {{ $order->last_name }}</h6>
                        <p class="text-muted small mb-0">{{ $order->email }}</p>
                    </div>
                </div>
                <div class="pt-3 border-top mt-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-phone-alt text-muted me-3" style="width: 15px;"></i>
                        <span class="text-dark fw-semibold small">{{ $order->phone }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-white shadow-sm border-0 rounded-3 overflow-hidden mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="card-title mb-0 fw-bold text-dark"><i class="fas fa-shipping-fast me-2 text-muted"></i>Shipping Info</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <label class="text-uppercase small fw-bold text-muted d-block mb-2" style="letter-spacing: 1px; font-size: 10px;">Delivery Address</label>
                    <div class="d-flex">
                        <i class="fas fa-map-marker-alt text-danger me-3 mt-1" style="width: 15px;"></i>
                        <div class="text-dark small lh-base">
                            <span class="fw-bold d-block">{{ $order->address }}</span>
                            <span class="d-block">{{ $order->city }}, {{ $order->state }}</span>
                            <span class="d-block fw-semibold">{{ $order->country }} - {{ $order->pincode }}</span>
                        </div>
                    </div>
                </div>
                <div class="pt-3 border-top">
                    <label class="text-uppercase small fw-bold text-muted d-block mb-2" style="letter-spacing: 1px; font-size: 10px;">Payment via</label>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card text-muted me-3" style="width: 15px;"></i>
                        <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="font-size: 11px;">{{ strtoupper($order->payment_method) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
