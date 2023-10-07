@if ($paginator->hasPages())
    <!-- Pagination -->
    {{-- <nav class="pagination">
        <a href="#" class="pagination__page">2</a>
        <a href="#" class="pagination__page">3</a>
        <a href="#" class="pagination__page">4</a>
        <a href="#" class="pagination__page pagination__icon pagination__page--next"><i
                class="ui-arrow-right"></i></a>
    </nav> --}}
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <span class="pagination__page pagination__page--current"></span> --}}
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="pagination__page pagination__icon"><i class="ui-arrow-left"></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="{{ $url }}" class="pagination__page pagination__page--current">{{ $page }}</a>
                            
                            {{-- <li class="active" aria-current="page"><span>{{ $page }}</span></li> --}}
                            @else
                            <a href="{{ $url }}" class="pagination__page ">{{ $page }}</a>
                            {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a href="{{$paginator->nextPageUrl()}}" class="pagination__page pagination__icon pagination__page--next"><i
                class="ui-arrow-right"></i></a>
            @else
            @endif
        </ul>
    </nav>
@endif
