@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination ul-mt5 align-items-center justify-content-center pagination-box">
            {{-- First Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item first disabled" aria-disabled="true">
                    <span class="page-link p-0 m-0 bg-transparent heading-weight border-0 lh-1">First</span>
                </li>
            @else
                <li class="page-item first">
                    <a href="{{ $paginator->url(1) }}" class="page-link p-0 m-0 bg-transparent heading-weight border-0 lh-1" aria-label="First page">First</a>
                </li>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item prev disabled" aria-disabled="true">
                    <span class="page-link icon-16 d-flex align-items-center justify-content-center p-0 m-0 bg-transparent heading-weight border-0 border-radius" aria-label="Previous"><i class="ri-arrow-left-line d-block lh-1"></i></span>
                </li>
            @else
                <li class="page-item prev">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link icon-16 d-flex align-items-center justify-content-center p-0 m-0 bg-transparent heading-weight border-0 border-radius" aria-label="Previous" rel="prev"><i class="ri-arrow-left-line d-block lh-1"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link d-flex align-items-center justify-content-center p-0 m-0 heading-weight border-0 border-radius lh-1">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link active d-flex align-items-center justify-content-center p-0 m-0 heading-weight border-0 border-radius lh-1">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}" class="page-link d-flex align-items-center justify-content-center p-0 m-0 heading-weight border-0 border-radius lh-1">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item next">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link icon-16 d-flex align-items-center justify-content-center p-0 m-0 bg-transparent heading-weight border-0 border-radius" aria-label="Next" rel="next"><i class="ri-arrow-right-line d-block lh-1"></i></a>
                </li>
            @else
                <li class="page-item next disabled" aria-disabled="true">
                    <span class="page-link icon-16 d-flex align-items-center justify-content-center p-0 m-0 bg-transparent heading-weight border-0 border-radius" aria-label="Next"><i class="ri-arrow-right-line d-block lh-1"></i></span>
                </li>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item last">
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link p-0 m-0 bg-transparent heading-weight border-0 lh-1" aria-label="Last page">Last</a>
                </li>
            @else
                <li class="page-item last disabled" aria-disabled="true">
                    <span class="page-link p-0 m-0 bg-transparent heading-weight border-0 lh-1">Last</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
