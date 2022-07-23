@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())            
            <li class="page-item disabled">
                <a href="" class="page-link">
                    <span>&laquo;</span>
                </a>
            </li>
            <li class="page-item disabled">
                <a href="" class="page-link">
                    <span>&lsaquo;</span>
                </a>
            </li>
        @else            
             <li>
                <a href="{{ $paginator->url(1) }}" class="page-link" rel="prev">
                    <span>&laquo;</span>
                </a>
            </li>
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">
                    <span>&lsaquo;</span>
                </a>
            </li>
        @endif

        @if($paginator->currentPage() > 3)
            <li class="page-item hidden-xs">
                <a href="{{ $paginator->url(1) }}" class="page-link">1</a>
            </li>
        @endif
        @if($paginator->currentPage() > 4)
            <li>
                <a href="" class="page-link"><span> ... </span></a>
            </li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active">
                        <a href="" class="page-link">
                            <span>{{ $i }}</span>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                    </li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li class="page-item">
                <a href="" class="page-link">
                    <span> ... </span>
                </a>
            </li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="page-item hidden-xs">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">
                    {{ $paginator->lastPage() }}
                </a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link">
                    <span>&rsaquo;</span>
                </a>
            </li>
            <li class="page-item">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" rel="next" class="page-link">
                   <span>&raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a href="" class="page-link">
                    <span>&rsaquo;</span>
                </a>
            </li>
            <li class="page-item disabled">
                <a href="" class="page-link">
                    <span>&raquo;</span>
                </a>
            </li>
        @endif
    </ul>
@endif