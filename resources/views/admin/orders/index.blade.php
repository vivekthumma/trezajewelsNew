@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="row">
    <div class="col-12">
        @php
            $columns = [
                ['label' => 'S.N.', 'class' => 'ps-4', 'style' => 'width: 80px'],
                ['label' => 'Order Information', 'style' => ''],
                ['label' => 'Total Amount', 'class' => 'text-center', 'style' => 'width: 130px'],
                ['label' => 'Status', 'class' => 'text-center', 'style' => 'width: 140px'],
                ['label' => 'Order Date', 'class' => 'text-center', 'style' => 'width: 180px'],
                ['label' => 'Actions', 'class' => 'text-end pe-4', 'style' => 'width: 250px'],
            ];
        @endphp

        <x-admin.table 
            title="Customer Orders" 
            icon="ri-shopping-cart-2-line"
            :columns="$columns">
            
            @forelse($orders as $order)
            <tr>
                <td class="ps-4 fw-semibold text-muted small">
                    #{{ ($orders->currentPage()-1) * $orders->perPage() + $loop->iteration }}
                </td>
                <td>
                    <div class="fw-bold text-dark fs-14">
                        <span class="text-primary">{{ $order->order_number }}</span><br>
                        {{ $order->first_name }} {{ $order->last_name }}
                    </div>
                    <div class="text-muted small"><i class="ri-mail-line me-1 opacity-50"></i>{{ $order->email }}</div>
                </td>
                <td class="text-center fw-bold text-dark fs-14">${{ number_format($order->total_amount, 2) }}</td>
                <td class="text-center">
                    @php
                        $badgeClass = match($order->status) {
                            'placed' => 'bg-secondary',
                            'packed' => 'bg-info',
                            'shipping' => 'bg-primary',
                            'out_for_delivery' => 'bg-warning',
                            'delivered' => 'bg-success',
                            'cancelled' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }} text-white rounded-pill px-3 py-1 text-capitalize shadow-sm x-small fw-bold">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </td>
                <td class="text-center">
                    <div class="text-dark fw-semibold small">{{ $order->created_at->format('M d, Y') }}</div>
                    <small class="text-muted d-block mt-n1">{{ $order->created_at->format('H:i A') }}</small>
                </td>
                <td class="text-end pe-4">
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info px-3 rounded-1 shadow-xs fs-12">
                            <i class="fas fa-eye me-1"></i> Details
                        </a>
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-1 px-3 fs-12 dropdown-toggle shadow-xs" data-bs-toggle="dropdown">
                                Status
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 py-2 mt-2 rounded-3 fs-13">
                                <li>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="placed">
                                        <button type="submit" class="dropdown-item py-2 {{ $order->status == 'placed' ? 'active' : '' }}">Set as Placed</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="packed">
                                        <button type="submit" class="dropdown-item py-2 border-top {{ $order->status == 'packed' ? 'active' : '' }}">Set as Packed</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="shipping">
                                        <button type="submit" class="dropdown-item py-2 border-top {{ $order->status == 'shipping' ? 'active' : '' }}">Set as Shipping</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="out_for_delivery">
                                        <button type="submit" class="dropdown-item py-2 border-top {{ $order->status == 'out_for_delivery' ? 'active' : '' }}">Set as Out for delivery</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="delivered">
                                        <button type="submit" class="dropdown-item py-2 border-top {{ $order->status == 'delivered' ? 'active' : '' }}">Set as Delivered</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="dropdown-item py-2 border-top text-danger {{ $order->status == 'cancelled' ? 'active' : '' }}">Cancel Order</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted border-0">
                    <div class="d-flex flex-column align-items-center">
                        <i class="ri-shopping-cart-2-line fa-3x mb-3 text-light-gray opacity-50"></i>
                        <h6 class="fw-bold mb-1">No orders found</h6>
                        <p class="small text-muted mb-0">Customer orders will appear here once placed.</p>
                    </div>
                </td>
            </tr>
            @endforelse

            <x-slot:footer>
                <div class="row align-items-center mx-1">
                    <div class="col-sm-6 text-muted small">
                        Showing <strong>{{ $orders->count() }}</strong> active orders
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </x-slot:footer>
        </x-admin.table>
    </div>
</div>

<style>
    .fs-14 { font-size: 14px; }
    .fs-13 { font-size: 13px; }
    .fs-12 { font-size: 12px; }
    .x-small { font-size: 0.75rem; }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .text-light-gray { color: #d1d4d7; }
</style>
@endsection
