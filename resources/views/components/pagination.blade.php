@if ($paginator->hasPages())
    <div class="pagination">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="pagination__arrow is-disabled">
                <div class="arrow-long arrow-long--left"></div>
            </div>
        @else
            <a class="pagination__arrow" href="{{ $paginator->previousPageUrl() }}">
                <div class="arrow-long arrow-long--left"></div>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="pagination__link">{{ $element }}</div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="pagination__link is-current">{{ $page }}</div>
                    @else
                        <a class="pagination__link" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination__arrow" href="{{ $paginator->nextPageUrl() }}">
                <div class="arrow-long arrow-long--right"></div>
            </a>
        @else
            <div class="pagination__arrow is-disabled">
                <div class="arrow-long arrow-long--right"></div>
            </div>
        @endif
    </div>
@endif
