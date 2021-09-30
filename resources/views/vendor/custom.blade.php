@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mb-2">
        @if ($paginator->onFirstPage())
            <li class="page-item bg-primary">
                <a class="page-link disabled" href="#" tabindex="-1">&lsaquo;</a>
            </li>
        @else
            <li class="page-item bg-primary"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a></li>
        @endif
      
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled bg-primary">{{ $element }}</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active bg-primary">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item bg-primary">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <li class="page-item bg-primary">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled bg-primary">
                <a class="page-link" href="#">&rsaquo;</a>
            </li>
        @endif
    </ul>
@endif
