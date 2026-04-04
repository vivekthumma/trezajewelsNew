@extends('layouts.admin')

@section('title', 'Jewellery Products')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="input-group shadow-sm border rounded-pill overflow-hidden bg-white">
                            <span class="input-group-text bg-white border-0 ps-3">
                                <i class="fas fa-search text-muted small"></i>
                            </span>
                            <input type="text" name="search" value="{{ $search }}" class="form-control border-0 px-2 py-2 fs-7" placeholder="Search by name, SKU or category...">
                            @if($search)
                                <a href="{{ route('products.index') }}" class="btn btn-link link-secondary border-0 text-decoration-none py-2 px-3">
                                    <i class="fas fa-times small"></i>
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold text-uppercase fs-8">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @php
            $columns = [
                ['label' => 'S.N.', 'class' => 'ps-4', 'style' => 'width: 80px'],
                ['label' => 'Product Details', 'class' => '', 'style' => ''],
                ['label' => 'SKU No.', 'class' => 'text-center', 'style' => 'width: 100px'],
                ['label' => 'Category', 'class' => 'text-center', 'style' => 'width: 150px'],
                ['label' => 'Pricing', 'class' => 'text-center', 'style' => 'width: 130px'],
                ['label' => 'Inventory', 'class' => 'text-center', 'style' => 'width: 120px'],
                ['label' => 'Status', 'class' => 'text-center', 'style' => 'width: 100px'],
                ['label' => 'Actions', 'class' => 'text-end pe-4', 'style' => 'width: 160px'],
            ];
        @endphp

        <x-admin.table 
            title="Jewellery Inventory" 
            icon="ri-jewelry-2-line"
            :columns="$columns">
            
            <x-slot:actions>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm rounded-1">
                    <i class="fas fa-plus-circle me-1"></i> Add Product
                </a>
            </x-slot>

            @forelse($products as $product)
            <tr>
                <td class="ps-4 fw-semibold text-muted small">#{{ ($products->currentPage()-1) * $products->perPage() + $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center py-2">
                        <div class="me-3 p-1 bg-white border rounded-1 shadow-sm position-relative">
                            <img src="{{ imgPath($product->main_image) }}" alt="{{ $product->name }}" 
                                 class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                            @if($product->featured)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-warning p-1 border border-white" title="Featured">
                                    <i class="fas fa-star text-white x-small"></i>
                                </span>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('products.show', $product->id) }}" class="fw-bold text-dark text-decoration-none fs-14 d-block mb-1">{{ $product->name }}</a>
                            <div class="text-muted small">
                                <span class="badge bg-light text-dark border-0 p-0 fs-11 me-2">{{ $product->metal_type }}</span>
                                <span class="badge bg-light text-dark border-0 p-0 fs-11">{{ $product->purity }}</span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <code class="small bg-light px-2 py-1 border rounded text-primary">{{ $product->sku }}</code>
                </td>
                <td class="text-center">
                    <span class="small fw-semibold text-muted">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </span>
                </td>
                <td class="text-center">
                    @if($product->discount_price)
                        <div class="text-muted text-decoration-line-through x-small opacity-50">${{ number_format($product->price, 2) }}</div>
                        <div class="text-danger fw-bold fs-14">${{ number_format($product->discount_price, 2) }}</div>
                    @else
                        <div class="fw-bold text-dark fs-14">${{ number_format($product->price, 2) }}</div>
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex flex-column align-items-center">
                        <div class="fw-bold fs-13 {{ $product->quantity <= 5 ? 'text-danger' : 'text-dark' }}">{{ $product->quantity }}</div>
                        <div class="progress w-100 mt-1" style="height: 4px; max-width: 60px;">
                            <div class="progress-bar {{ $product->quantity <= 5 ? 'bg-danger' : 'bg-success' }}" 
                                 style="width: {{ min(($product->quantity/50)*100, 100) }}%"></div>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    @if($product->status)
                        <span class="badge bg-success text-white px-3 py-1 fw-bold rounded-pill shadow-sm small">Active</span>
                    @else
                        <span class="badge bg-secondary text-white px-3 py-1 fw-bold rounded-pill shadow-sm small">Inactive</span>
                    @endif
                </td>
                <td class="text-end pe-4">
                    <x-admin.actions 
                        view="{{ route('products.show', $product->id) }}" 
                        edit="{{ route('products.edit', $product->id) }}" 
                        delete="{{ route('products.destroy', $product->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-5 text-muted border-0">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-search fa-3x mb-3 text-light-gray opacity-50"></i>
                        <h6 class="fw-bold mb-1">No products found</h6>
                        <p class="small text-muted mb-0">Adjust your search or add a new jewellery piece.</p>
                    </div>
                </td>
            </tr>
            @endforelse

            <x-slot:footer>
                <div class="row align-items-center mx-1">
                    <div class="col-sm-6 text-muted small">
                        Showing <strong>{{ $products->firstItem() ?? 0 }}</strong> to <strong>{{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> jewellery pieces
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        {{ $products->appends(['search' => $search])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </x-slot>
        </x-admin.table>
    </div>
</div>

<style>
    .fs-14 { font-size: 14px; }
    .fs-13 { font-size: 13px; }
    .fs-11 { font-size: 11px; }
    .fs-7 { font-size: 0.9rem; }
    .fs-8 { font-size: 0.75rem; }
    .x-small { font-size: 0.7rem; }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .text-light-gray { color: #d1d4d7; }
</style>
@endsection
