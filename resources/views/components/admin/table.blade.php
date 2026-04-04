@props([
    'title' => '',
    'columns' => [],
    'footer' => null,
    'actions' => null,
    'id' => 'admin-table'
])

<div class="card card-outline card-primary shadow-sm">
    @if($title || $actions)
    <div class="card-header bg-white py-3">
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="card-title fw-bold text-dark mb-0">
                @if(isset($icon)) <i class="{{ $icon }} me-2 text-primary"></i> @endif
                {{ $title }}
            </h3>
            <div class="card-tools">
                {{ $actions }}
            </div>
        </div>
    </div>
    @endif
    
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0" id="{{ $id }}">
            <thead class="bg-light-gray text-uppercase small fw-bold">
                <tr>
                    @foreach($columns as $column)
                        <th class="{{ $column['class'] ?? '' }}" style="{{ $column['style'] ?? '' }}">
                            {{ $column['label'] }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if($footer)
    <div class="card-footer bg-white border-top py-3">
        {{ $footer }}
    </div>
    @endif
</div>

<style>
    .bg-light-gray {
        background-color: #f4f6f9 !important;
        border-bottom: 2px solid #dee2e6 !important;
    }
    .table-bordered thead th {
        border-bottom-width: 2px;
        color: #495057;
        letter-spacing: 0.5px;
    }
    .card-outline.card-primary {
        border-top: 3px solid #007bff;
    }
    /* Action Button Styles */
    .btn-action-view { color: #fff; background-color: #17a2b8; border-color: #17a2b8; }
    .btn-action-edit { color: #fff; background-color: #007bff; border-color: #007bff; }
    .btn-action-delete { color: #fff; background-color: #dc3545; border-color: #dc3545; }
    
    .btn-sm-custom {
        padding: 0.25rem 0.5rem;
        font-size: 0.8125rem;
        border-radius: 0.2rem;
        transition: all 0.2s;
    }
    .btn-sm-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        color: #fff;
    }
</style>
