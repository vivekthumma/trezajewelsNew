@extends('layouts.admin')

@section('title', 'View Inquiry')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title fw-bold">Message Details</h3>
                <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
            <div class="card-body">
                <div class="row mb-4 bg-light p-3 rounded-3 mx-0">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small text-uppercase fw-bold">Customer Name</label>
                        <div class="h5 mb-0 fw-bold">{{ $message->name }}</div>
                    </div>
                    <div class="col-md-6 mb-3 text-md-end">
                        <label class="text-muted small text-uppercase fw-bold">Received On</label>
                        <div class="h5 mb-0">{{ $message->created_at->format('M d, Y - H:i') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold">Email Address</label>
                        <div class="mb-0"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <label class="text-muted small text-uppercase fw-bold">Phone Number</label>
                        <div class="mb-0">
                            @if($message->phone)
                            <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>
                            @else
                            <span class="text-muted">Not provided</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="message-content p-4 border rounded-3 bg-white">
                    <label class="text-muted small text-uppercase fw-bold d-block mb-3 border-bottom pb-2">Customer Message</label>
                    <div class="text-dark fs-5" style="white-space: pre-line; line-height: 1.6;">
                        {{ $message->message }}
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top text-end">
                <form action="{{ route('admin.contact.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete Permanent
                    </button>
                </form>
                <a href="mailto:{{ $message->email }}" class="btn btn-primary ms-2">
                    <i class="fas fa-reply me-1"></i> Reply via Email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
