@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="paging paging--page">
        <div class="paging__wrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- kosong --}}
            @else
                <div class="paging__item">
                    @php
                        $prevUrl = $paginator->previousPageUrl();
                        $cleanPrevUrl = Str::contains($prevUrl, '?page=1')
                            ? Str::replaceFirst('?page=1', '', $prevUrl)
                            : $prevUrl;
                    @endphp
                    <a href="{{ $cleanPrevUrl }}" class="paging__link paging__link--prev">Prev</a>
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
                                <a href="javascript:;" class="paging__link paging__link--active">{{ $page }}</a>
                            </div>
                        @else
                            @php
                                $cleanUrl = Str::contains($url, '?page=1')
                                    ? Str::replaceFirst('?page=1', '', $url)
                                    : $url;
                            @endphp
                            <div class="paging__item">
                                <a href="{{ $cleanUrl }} {{ isset($_GET['start_date']) ? '&start_date=' . $_GET['start_date'] . '&end_date=' . $_GET['end_date'] : '' }}"
                                    class="paging__link">{{ $page }}</a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div class="paging__item">
                    <a href="{{ $paginator->nextPageUrl() }} {{ isset($_GET['start_date']) ? '&start_date=' . $_GET['start_date'] . '&end_date=' . $_GET['end_date'] : '' }}"
                        class="paging__link paging__link--next">Next</a>
                </div>
            @else
            @endif
        </div>
    </div>
@endif
