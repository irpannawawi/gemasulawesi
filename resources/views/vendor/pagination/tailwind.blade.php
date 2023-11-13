@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="paging__wrap">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- <span class="pagination__page pagination__page--current"></span> --}}
        @else
            <div class="paging__item">
                <a href="{{ $paginator->previousPageUrl() }}" class="paging__link paging__link--prev">Prev</a>
            </div>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="paging__item">
                    <a class="paging__link" href="javascript:;">{{ $element }}</a>
                </div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="paging__item">
                            <a href="{{ $url }}"
                                class="paging__link paging__link--active">{{ $page }}</a>
                        </div>
                        {{-- <li class="active" aria-current="page"><span>{{ $page }}</span></li> --}}
                    @else
                        <div class="paging__item">
                            <a href="{{ $url }}" class="paging__link">{{ $page }}</a>
                        </div>
                        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <div class="paging__item">
                <a href="{{ $paginator->nextPageUrl() }}" class="paging__link paging__link--next">Next</a>
            </div>
        @else
        @endif
    </div>
@endif
