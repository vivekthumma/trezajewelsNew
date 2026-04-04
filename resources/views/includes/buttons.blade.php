@php
    $type = $type ?? 'primary';
    $text = $text ?? 'Submit';
    $icon = $icon ?? '';
    $submit = $submit ?? false;
    $class = "btn btn-custom btn-{$type}-custom";
@endphp

<button 
    type="{{ $submit ? 'submit' : 'button' }}" 
    class="{{ $class }} btn-with-loader">
    
    @if($icon)
        <i class="{{ $icon }} me-1"></i>
    @endif

    <span class="btn-text">{{ $text }}</span>

    <span class="btn-spinner">
        <i class="fas fa-spinner fa-spin"></i>
    </span>
</button>
