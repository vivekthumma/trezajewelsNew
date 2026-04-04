@extends('layouts.admin')

@section('title', 'Best Collection')

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $columns = [
                ['label' => 'S.N.', 'class' => 'ps-4', 'style' => 'width: 80px'],
                ['label' => 'Order', 'class' => 'text-center', 'style' => 'width: 80px'],
                ['label' => 'Category Source', 'style' => ''],
                ['label' => 'Custom Title', 'style' => ''],
                ['label' => 'Icon / Thumbnail', 'class' => 'text-center', 'style' => 'width: 150px'],
                ['label' => 'Display Status', 'class' => 'text-center', 'style' => 'width: 130px'],
                ['label' => 'Actions', 'class' => 'text-end pe-4', 'style' => 'width: 150px'],
            ];
        @endphp

        <x-admin.table 
            title="Best Collection Sections" 
            icon="ri-layout-grid-line"
            :columns="$columns">
            
            <x-slot:actions>
                <a href="{{ route('home-sections.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm rounded-1">
                    <i class="fas fa-plus-circle me-1"></i> Add New Section
                </a>
            </x-slot>

            @forelse($sections as $section)
            <tr>
                <td class="ps-4 fw-semibold text-muted small">
                    #{{ $loop->iteration }}
                </td>
                <td class="text-center">
                    <span class="badge bg-light text-primary border px-2 py-1 fs-12 fw-bold">{{ $section->sort_order }}</span>
                </td>
                <td>
                    <div class="fw-bold text-dark fs-14">{{ $section->category->name }}</div>
                    <small class="text-muted">Linked to category ID: #{{ $section->category_id }}</small>
                </td>
                <td class="fs-14 text-secondary">{{ $section->title ?? '---' }}</td>
                <td class="text-center">
                    @if($section->icon)
                        <div class="p-1 bg-white border rounded shadow-xs d-inline-block">
                                <img src="{{ $section->icon ? imgPath($section->icon) : asset('assets/images/index2/collection-tab1.png') }}" alt="icon" 
                                     style="width: 35px; height: 35px; object-fit: contain;">
                        </div>
                    @else
                        <span class="text-muted x-small italic text-uppercase opacity-50">No Icon</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($section->status)
                        <span class="badge bg-success text-white px-3 py-1 rounded-pill shadow-sm small fw-bold">Active</span>
                    @else
                        <span class="badge bg-danger text-white px-3 py-1 rounded-pill shadow-sm small fw-bold">Inactive</span>
                    @endif
                </td>
                <td class="text-end pe-4">
                    <x-admin.actions 
                        edit="{{ route('home-sections.edit', $section->id) }}" 
                        delete="{{ route('home-sections.destroy', $section->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted border-0">
                    <div class="d-flex flex-column align-items-center">
                        <i class="ri-article-line fa-3x mb-3 text-light-gray opacity-50"></i>
                        <h6 class="fw-bold mb-1">No collections found</h6>
                        <p class="small text-muted mb-0">Create sections to display your best collections on the homepage.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </x-admin.table>
    </div>
</div>

<style>
    .fs-14 { font-size: 14px; }
    .fs-12 { font-size: 12px; }
    .x-small { font-size: 0.75rem; }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .text-light-gray { color: #d1d4d7; }
</style>
@endsection