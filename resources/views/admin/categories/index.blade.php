@extends('layouts.admin')

@section('title', 'Jewellery Categories')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <form action="{{ route('categories.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="input-group shadow-sm border rounded-pill overflow-hidden bg-white">
                            <span class="input-group-text bg-white border-0 ps-3">
                                <i class="fas fa-search text-muted small"></i>
                            </span>
                            <input type="text" name="search" value="{{ $search }}" class="form-control border-0 px-2 py-2 fs-7" placeholder="Search categories...">
                            @if($search)
                                <a href="{{ route('categories.index') }}" class="btn btn-link link-secondary border-0 text-decoration-none py-2 px-3">
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
                ['label' => 'S.N.', 'style' => 'width: 80px', 'class' => 'ps-4'],
                ['label' => 'Category Information', 'style' => ''],
                ['label' => 'Status', 'class' => 'text-center', 'style' => 'width: 120px'],
                ['label' => 'Creation Date', 'style' => 'width: 180px'],
                ['label' => 'Actions', 'class' => 'text-end pe-4', 'style' => 'width: 150px'],
            ];
        @endphp

        <x-admin.table 
            title="Jewellery Categories" 
            icon="ri-list-check"
            :columns="$columns">
            
            <x-slot:actions>
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm rounded-1">
                    <i class="fas fa-plus-circle me-1"></i> Add Category
                </a>
            </x-slot>

            @forelse($categories as $category)
            <tr>
                <td class="ps-4 fw-semibold text-muted small">#{{ ($categories->currentPage()-1) * $categories->perPage() + $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center py-1">
                        @if($category->image)
                            <div class="me-3 p-1 bg-white border rounded shadow-sm">
                                <img src="{{ imgPath($category->image) }}" alt="{{ $category->name }}" 
                                     class="rounded-1" style="width: 42px; height: 42px; object-fit: cover;">
                            </div>
                        @else
                            <div class="me-3 rounded-1 bg-light d-flex align-items-center justify-content-center text-primary fw-bold shadow-sm border" 
                                 style="width: 50px; height: 50px;">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="ms-1">
                            <div class="fw-bold text-dark fs-14">{{ $category->name }}</div>
                            <div class="text-muted small d-flex align-items-center mt-1">
                                <code class="small bg-light px-1 border rounded text-primary">{{ $category->slug }}</code>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    @if($category->status)
                        <span class="badge bg-success text-white px-3 py-1 fw-bold rounded-pill shadow-sm small">
                            <i class="fas fa-check-circle me-1"></i> Active
                        </span>
                    @else
                        <span class="badge bg-danger text-white px-3 py-1 fw-bold rounded-pill shadow-sm small">
                            <i class="fas fa-times-circle me-1"></i> Inactive
                        </span>
                    @endif
                </td>
                <td>
                    <div class="text-dark fw-semibold small">{{ $category->created_at->format('d M, Y') }}</div>
                    <small class="text-muted d-block mt-n1">{{ $category->created_at->diffForHumans() }}</small>
                </td>
                <td class="text-end pe-4">
                    <x-admin.actions 
                        view="#" 
                        edit="{{ route('categories.edit', $category->id) }}" 
                        delete="{{ route('categories.destroy', $category->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-5 text-muted border-0">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-search fa-3x mb-3 text-light-gray opacity-50"></i>
                        <h6 class="fw-bold mb-1">No matching results</h6>
                        <p class="small text-muted mb-0">Adjust your search criteria and try again.</p>
                    </div>
                </td>
            </tr>
            @endforelse

            <x-slot:footer>
                <div class="row align-items-center mx-1">
                    <div class="col-sm-6 text-muted small">
                        Showing <strong>{{ $categories->firstItem() ?? 0 }}</strong> to <strong>{{ $categories->lastItem() ?? 0 }}</strong> of <strong>{{ $categories->total() }}</strong> categories
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        {{ $categories->appends(['search' => $search])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </x-slot>
        </x-admin.table>
    </div>
</div>

<style>
    .fs-14 { font-size: 14px; }
    .fs-7 { font-size: 0.9rem; }
    .fs-8 { font-size: 0.75rem; }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .text-light-gray { color: #d1d4d7; }
</style>
@endsection
