@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="row">
    <div class="col-12">
        @php
            $columns = [
                ['label' => 'S.N.', 'class' => 'ps-4', 'style' => 'width: 80px'],
                ['label' => 'Customer Name', 'style' => ''],
                ['label' => 'Email Address', 'style' => ''],
                ['label' => 'Phone', 'class' => 'text-center', 'style' => 'width: 150px'],
                ['label' => 'Received Date', 'class' => 'text-center', 'style' => 'width: 180px'],
                ['label' => 'Actions', 'class' => 'text-end pe-4', 'style' => 'width: 120px'],
            ];
        @endphp

        <x-admin.table 
            title="Customer Inquiries" 
            icon="ri-mail-send-line"
            :columns="$columns">
            
            @forelse($messages as $msg)
            <tr>
                <td class="ps-4 fw-semibold text-muted small">
                    #{{ ($messages->currentPage()-1) * $messages->perPage() + $loop->iteration }}
                </td>
                <td class="fw-bold text-dark fs-14">{{ $msg->name }}</td>
                <td class="text-muted small">{{ $msg->email }}</td>
                <td class="text-center text-secondary small">{{ $msg->phone ?? 'N/A' }}</td>
                <td class="text-center">
                    <div class="text-dark fw-semibold small">{{ $msg->created_at->format('M d, Y') }}</div>
                    <small class="text-muted d-block mt-n1">{{ $msg->created_at->format('H:i A') }}</small>
                </td>
                <td class="text-end pe-4">
                    <x-admin.actions 
                        view="{{ route('admin.contact.show', $msg->id) }}" 
                        delete="{{ route('admin.contact.destroy', $msg->id) }}" />
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted border-0">
                    <div class="d-flex flex-column align-items-center">
                        <i class="ri-mail-forbid-line fa-3x mb-3 text-light-gray opacity-50"></i>
                        <h6 class="fw-bold mb-1">No messages found</h6>
                        <p class="small text-muted mb-0">No one has contacted you via the website yet.</p>
                    </div>
                </td>
            </tr>
            @endforelse

            <x-slot:footer>
                <div class="row align-items-center mx-1">
                    <div class="col-sm-6 text-muted small">
                        Showing <strong>{{ $messages->count() }}</strong> recent inquiries
                    </div>
                    @if($messages->hasPages())
                    <div class="col-sm-6 d-flex justify-content-end">
                        {{ $messages->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                </div>
            </x-slot:footer>
        </x-admin.table>
    </div>
</div>

<style>
    .fs-14 { font-size: 14px; }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .text-light-gray { color: #d1d4d7; }
</style>
@endsection
