@extends('layouts.admin')

@section('title', 'Ecommerce Dashboard')

@section('style')
<style>
    /* Small Box Icon Fixes */
    .small-box { border-radius: 12px; overflow: hidden; position: relative; display: block; margin-bottom: 20px; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2); }
    .small-box > .inner { padding: 20px; }
    .small-box > .inner h3 { font-size: 2.2rem; font-weight: 700; margin: 0 0 10px; white-space: nowrap; padding: 0; }
    .small-box > .inner p { font-size: 1rem; margin-bottom: 0; }
    .small-box .icon { color: rgba(0,0,0,.15); z-index: 0; position: absolute; right: 15px; top: 15px; transition: transform .3s linear; }
    .small-box .icon > i { font-size: 70px; }
    .small-box:hover .icon { transform: scale(1.1); }
    .small-box-footer { background-color: rgba(0,0,0,.1); color: rgba(255,255,255,.8); display: block; padding: 3px 0; position: relative; text-align: center; text-decoration: none; z-index: 10; }
    .small-box-footer:hover { background-color: rgba(0,0,0,.15); color: #fff; }
</style>
@endsection

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 mb-4">
        <div class="small-box text-bg-primary shadow-sm h-100 border-0">
            <div class="inner">
                <h3>{{ number_format($revenueGrowth, 1) }}%</h3>
                <p>Monthly Revenue Growth</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="{{ route('orders.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3 mb-4">
        <div class="small-box text-bg-success shadow-sm h-100 border-0">
            <div class="inner">
                <h3>${{ number_format($totalRevenue, 2) }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <a href="{{ route('orders.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- /.col -->

    <div class="col-12 col-sm-6 col-md-3 mb-4">
        <div class="small-box text-bg-warning shadow-sm h-100 border-0">
            <div class="inner">
                <h3>{{ $weeklyOrders }}</h3>
                <p>New Orders (Week)</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <a href="{{ route('orders.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-100-hover">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3 mb-4">
        <div class="small-box text-bg-danger shadow-sm h-100 border-0">
            <div class="inner">
                <h3>{{ $newCustomers }}</h3>
                <p>New Customers (Month)</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-100-hover">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom">
                <h5 class="card-title fw-bold">Revenue Report</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong>Sales Performance</strong>
                        </p>
                        <div class="chart-container" style="position: relative; height:250px; width:100%">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <p class="text-center">
                            <strong>Inventory Targets</strong>
                        </p>

                        @foreach($categoriesStats->take(4) as $cat)
                        @php
                            $colors = ['bg-primary', 'bg-danger', 'bg-success', 'bg-warning'];
                            $color = $colors[$loop->index % 4];
                            $target = 100; // Mock target for visualization
                            $percentage = $cat->products_count > $target ? 100 : ($cat->products_count / $target) * 100;
                        @endphp
                        <div class="progress-group mb-3">
                            {{ $cat->name }}
                            <span class="float-end"><b>{{ $cat->products_count }}</b>/{{ $target }}</span>
                            <div class="progress progress-sm" style="height: 6px;">
                                <div class="progress-bar {{ $color }}" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
            <div class="card-footer bg-white py-3 border-top">
                <div class="row text-center">
                    <div class="col-sm-6 border-end">
                        <div class="description-block">
                            <span class="description-percentage {{ $revenueGrowth >= 0 ? 'text-success' : 'text-danger' }} fw-bold">
                                <i class="fas fa-caret-{{ $revenueGrowth >= 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($revenueGrowth), 1) }}%
                            </span>
                            <h5 class="description-header fs-4 fw-bold">${{ number_format($totalRevenue, 2) }}</h5>
                            <span class="description-text text-muted text-uppercase small">Total Sales</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="description-block">
                            <span class="description-percentage text-success fw-bold"><i class="fas fa-caret-up"></i> {{ $totalOrders }}</span>
                            <h5 class="description-header fs-4 fw-bold">{{ $totalOrders }}</h5>
                            <span class="description-text text-muted text-uppercase small">Total Orders</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header border-bottom">
                <h3 class="card-title fw-bold">Top Jewelry Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($categoriesStats->take(5) as $cat)
                    <div class="list-group-item d-flex align-items-center py-3 border-0 border-bottom">
                        <div class="me-3">
                            <div class="bg-{{ ['primary', 'warning', 'info', 'success', 'danger'][$loop->index % 5] }}-subtle text-{{ ['primary', 'warning', 'info', 'success', 'danger'][$loop->index % 5] }} p-3 rounded-circle">
                                <i class="fas fa-gem fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0 fw-bold text-dark">{{ $cat->name }}</h6>
                                <span class="badge text-bg-secondary rounded-pill">{{ $cat->products_count }} Products</span>
                            </div>
                            <small class="text-muted">Dynamic collection management</small>
                        </div>
                    </div>
                    @empty
                    <div class="p-3 text-center">No categories found.</div>
                    @endforelse
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center bg-transparent border-top">
                <a href="{{ route('categories.index') }}" class="btn btn-link text-decoration-none fw-bold">View All Categories <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom">
                <h3 class="card-title fw-bold">Recent Orders</h3>
                <div class="card-tools">
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-primary">View All Orders</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Order ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->order_number }}</td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($order->status) {
                                            'pending' => 'bg-warning',
                                            'processing' => 'bg-info',
                                            'completed' => 'bg-success',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No recent orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        const ctx = document.getElementById('revenueChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Revenue',
                        data: {!! json_encode($revenueData) !!},
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#0d6efd',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { display: true, drawBorder: false, color: '#f0f0f0' },
                            ticks: { 
                                font: { size: 11 }, 
                                color: '#999',
                                callback: function(value) { return '$' + value.toLocaleString(); }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 11 }, color: '#999' }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
