@extends('layouts.admin')

@section('title', 'Manage Homepage Sliders')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <form action="{{ route('sliders.index') }}" method="GET">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="input-group shadow-sm border rounded-pill overflow-hidden bg-white">
                            <span class="input-group-text bg-white border-0 ps-3">
                                <i class="fas fa-search text-muted small"></i>
                            </span>
                            <input type="text" name="search" value="{{ $searchQuery }}" class="form-control border-0 px-2 py-2 fs-7" placeholder="Search sliders...">
                            @if($searchQuery)
                                <a href="{{ route('sliders.index') }}" class="btn btn-link link-secondary border-0 text-decoration-none py-2 px-3">
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
                ['label' => 'Slider Details', 'style' => ''],
                ['label' => 'Order', 'class' => 'text-center', 'style' => 'width: 100px'],
                ['label' => 'Status', 'class' => 'text-center', 'style' => 'width: 120px'],
                ['label' => 'Created At', 'style' => 'width: 180px'],
                ['label' => 'Actions', 'class' => 'text-end pe-4', 'style' => 'width: 150px'],
            ];
        @endphp

        <x-admin.table 
            title="Homepage Sliders" 
            icon="ri-slideshow-line"
            :columns="$columns">
            
            <x-slot:actions>
                <a href="{{ route('sliders.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm rounded-1">
                    <i class="fas fa-plus-circle me-1"></i> Add Slider
                </a>
            </x-slot>

            @forelse($sliders as $slider)
            <tr>
                <td class="ps-4 fw-semibold text-muted small">#{{ ($sliders->currentPage()-1) * $sliders->perPage() + $loop->iteration }}</td>
                <td>
                    <div class="d-flex align-items-center py-1">
                        <div class="me-3 p-1 bg-white border rounded shadow-sm">
                            <img src="{{ imgPath($slider->image) }}" alt="{{ $slider->title }}" 
                                 class="rounded-1" style="width: 80px; height: 45px; object-fit: cover;">
                        </div>
                        <div class="ms-1">
                            <div class="fw-bold text-dark fs-14">{{ $slider->title ?? 'Untitled Slider' }}</div>
                            <div class="text-muted small d-flex align-items-center mt-1">
                                <span class="bg-light px-1 border rounded text-secondary small">{{ $slider->sub_title ?? 'No subtitle' }}</span>
                                @if($slider->link)
                                    <span class="ms-2 text-primary small"><i class="ri-links-line me-1"></i>Link set</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill">{{ $slider->order }}</span>
                </td>
                <td class="text-center">
                    @if($slider->status)
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
                    <div class="text-dark fw-semibold small">{{ $slider->created_at->format('d M, Y') }}</div>
                    <small class="text-muted d-block mt-n1">{{ $slider->created_at->diffForHumans() }}</small>
                </td>
                <td class="text-end pe-4">
                    <x-admin.actions 
                        edit="{{ route('sliders.edit', $slider->id) }}" 
                        delete="{{ route('sliders.destroy', $slider->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted border-0">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-search fa-3x mb-3 text-light-gray opacity-50"></i>
                        <h6 class="fw-bold mb-1">No sliders found</h6>
                        <p class="small text-muted mb-0">Start by creating your first homepage slider.</p>
                    </div>
                </td>
            </tr>
            @endforelse

            <x-slot:footer>
                <div class="row align-items-center mx-1">
                    <div class="col-sm-6 text-muted small">
                        Showing <strong>{{ $sliders->firstItem() ?? 0 }}</strong> to <strong>{{ $sliders->lastItem() ?? 0 }}</strong> of <strong>{{ $sliders->total() }}</strong> sliders
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        {{ $sliders->appends(['search' => $searchQuery])->links('pagination::bootstrap-5') }}
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
    .text-light-gray { color: #d1d4d7; }
</style>
@endsection
