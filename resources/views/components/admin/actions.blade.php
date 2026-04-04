@props([
    'view' => null,
    'edit' => null,
    'delete' => null,
    'id' => null
])

<div class="d-flex align-items-center gap-1 justify-content-end">
    @if($view)
    <a href="{{ $view }}" class="btn btn-sm btn-info px-2 py-1 shadow-sm rounded-1" data-bs-toggle="tooltip" title="View Details">
        <i class="fas fa-eye small"></i>
    </a>
    @endif

    @if($edit)
    <a href="{{ $edit }}" class="btn btn-sm btn-primary px-2 py-1 shadow-sm rounded-1" data-bs-toggle="tooltip" title="Modify">
        <i class="fas fa-edit small"></i>
    </a>
    @endif

    @if($delete)
    <form action="{{ $delete }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger px-2 py-1 shadow-sm rounded-1" data-bs-toggle="tooltip" title="Remove">
            <i class="fas fa-trash-alt small"></i>
        </button>
    </form>
    @endif
</div>
