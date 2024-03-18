@if ($paginator->hasPages())

    {{-- @dd($paginator->getUrlRange($paginator->currentPage(), $paginator->currentPage()+1)); --}}

    <nav style="font-size: 12px;" class="col-12" >
        <ul class="pagination" style="float: right">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            @else
            
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" rel="next"
                    aria-label="@lang('pagination.next')">&lsaquo;&lsaquo; First</a>
            </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements 1 --}}
            @if ($paginator->currentPage() > 1)
                @foreach ($paginator->getUrlRange($paginator->currentPage()== $paginator->lastPage() ? $paginator->currentPage() - 2 : $paginator->currentPage()-1, $paginator->currentPage() - 1) as $page => $url)
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif



            {{-- Pagination Elements 2 --}}
                @foreach ($paginator->getUrlRange(
                    $paginator->currentPage(), 
                    $paginator->currentPage() == $paginator->lastPage() ? $paginator->currentPage() : $paginator->currentPage()+2) as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span
                                class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next"
                        aria-label="@lang('pagination.next')">Last &rsaquo;&rsaquo;</a>
                </li>
            @else
            @endif
        </ul>
    </nav>
@endif
