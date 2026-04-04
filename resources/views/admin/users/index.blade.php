@extends('layouts.admin')

@section('title', 'Registered Customers')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="input-group shadow-sm border rounded-pill overflow-hidden bg-white">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="fas fa-search text-muted small"></i>
                        </span>
                        <input type="text" class="form-control border-0 px-2 py-2 fs-7" placeholder="Search by name, email or ID...">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold text-uppercase fs-8">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        @php
            $columns = [
                ['label' => 'S.N.', 'class' => 'ps-4', 'style' => 'width: 80px'],
                ['label' => 'Customer Details', 'style' => 'min-width: 250px;'],
                ['label' => 'Contact info', 'style' => ''],
                ['label' => 'Region / City', 'class' => 'text-center', 'style' => 'width: 160px'],
                ['label' => 'Registration Info', 'class' => 'text-center', 'style' => 'width: 160px'],
                ['label' => 'Actions', 'class' => 'text-end pe-4', 'style' => 'width: 130px'],
            ];
        @endphp

        <x-admin.table 
            title="Customer Base" 
            icon="ri-group-line"
            :columns="$columns">
            
            <x-slot:actions>
                <span class="badge bg-primary text-white rounded-pill px-3 py-1 fs-12 shadow-xs">
                    <i class="fas fa-users-viewfinder me-1"></i> {{ $users->total() }} Total Customers
                </span>
            </x-slot>

            @forelse($users as $user)
            <tr>
                <td class="ps-4 fw-semibold text-muted small">
                    #{{ ($users->currentPage()-1) * $users->perPage() + $loop->iteration }}
                </td>
                <td>
                    <div class="d-flex align-items-center py-2">
                        <div class="me-3 position-relative">
                            <div class="avatar-circle-sm">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold text-dark fs-14 mb-0">{{ $user->name }}</div>
                            <div class="text-muted x-small font-monospace">UID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column gap-1">
                        <div class="d-flex align-items-center">
                            <span class="text-primary me-2 fs-12"><i class="ri-mail-line"></i></span>
                            <span class="text-dark small fw-medium">{{ $user->email }}</span>
                        </div>
                        @if($user->phone)
                        <div class="d-flex align-items-center">
                            <span class="text-muted me-2 fs-12"><i class="ri-phone-line"></i></span>
                            <span class="text-secondary small">{{ $user->phone }}</span>
                        </div>
                        @endif
                    </div>
                </td>
                <td class="text-center">
                    @if($user->city)
                        <div class="d-inline-flex flex-column align-items-center">
                            <span class="badge bg-light text-dark border-0 px-2 py-1 rounded shadow-xs mb-1 x-small fw-medium">
                                <i class="fas fa-location-dot text-danger me-1"></i> {{ $user->city }}
                            </span>
                            <span class="text-muted fs-11">{{ $user->country }}</span>
                        </div>
                    @else
                        <span class="text-muted small italic">-- No Details --</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="text-dark fw-semibold small">{{ $user->created_at->format('d M, Y') }}</div>
                    <small class="text-muted d-block mt-n1">{{ $user->created_at->diffForHumans() }}</small>
                </td>
                <td class="text-end pe-4">
                    <x-admin.actions 
                        view="{{ route('users.show', $user->id) }}" 
                        delete="{{ route('users.destroy', $user->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-5 text-muted border-0">
                    <div class="d-flex flex-column align-items-center">
                        <i class="ri-user-unfollow-line fa-3x mb-3 text-light-gray opacity-50"></i>
                        <h6 class="fw-bold mb-1">No customers found</h6>
                        <p class="small text-muted mb-0">Your store doesn't have any registered members yet.</p>
                    </div>
                </td>
            </tr>
            @endforelse

            <x-slot:footer>
                <div class="row align-items-center mx-1">
                    <div class="col-sm-6 text-muted small">
                        Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> to <strong>{{ $users->lastItem() ?? 0 }}</strong> of <strong>{{ $users->total() }}</strong> shoppers
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </x-slot:footer>
        </x-admin.table>
    </div>
</div>

<style>
    .avatar-circle-sm {
        width: 38px;
        height: 38px;
        background-color: #f8f9fa;
        color: #C9A96E;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        font-size: 0.9rem;
    }
    .fs-14 { font-size: 14px; }
    .fs-12 { font-size: 12px; }
    .fs-11 { font-size: 11px; }
    .x-small { font-size: 0.75rem; }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .text-light-gray { color: #d1d4d7; }
</style>
@endsection
