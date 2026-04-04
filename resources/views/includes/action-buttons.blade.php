@php
    $view = $view ?? null;
    $edit = $edit ?? null;
    $delete = $delete ?? null;
@endphp

<div class="dropdown">
    <button class="btn btn-link text-muted p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" 
            data-bs-boundary="viewport"
            style="width: 30px; height: 30px; border-radius: 50% !important; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-2 rounded-3" style="min-width: 150px;">
        @if($view)
            <li>
                <a class="dropdown-item py-2 d-flex align-items-center btn-with-loader" href="{{ $view }}">
                    <i class="fas fa-eye text-primary me-2" style="width: 20px;"></i>
                    <span class="btn-text">View Details</span>
                    <span class="btn-spinner"><i class="fas fa-spinner fa-spin"></i></span>
                </a>
            </li>
        @endif
        
        @if($edit)
            <li>
                <a class="dropdown-item py-2 d-flex align-items-center btn-with-loader" href="{{ $edit }}">
                    <i class="fas fa-edit text-info me-2" style="width: 20px;"></i>
                    <span class="btn-text">Modify</span>
                    <span class="btn-spinner"><i class="fas fa-spinner fa-spin"></i></span>
                </a>
            </li>
        @endif

        @if($delete)
            <li><hr class="dropdown-divider bg-light opacity-50"></li>
            <li>
                <form action="{{ $delete }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item py-2 d-flex align-items-center text-danger btn-with-loader delete-btn">
                        <i class="fas fa-trash-alt me-2" style="width: 20px;"></i>
                        <span class="btn-text">Archive</span>
                        <span class="btn-spinner"><i class="fas fa-spinner fa-spin text-danger"></i></span>
                    </button>
                </form>
            </li>
        @endif
    </ul>
</div>
