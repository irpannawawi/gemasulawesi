@php
    $breakingNews = cache()->remember('breakingNews', 120, function(){
        return App\Models\Breakingnews::with(['post.rubrik'])->get();
    }); 
@endphp

        <!-- Trending Now -->
        @if ($breakingNews->count() > 0)
            <div class="kontiner">
                <div class="trending-now trending-now--1">
                    <span class="trending-now__label">
                        <i class="ui-flash"></i>
                        <span class="trending-now__text d-lg-inline-block d-none">Breaking News</span>
                    </span>
                    <div class="newsticker">
                        <ul class="newsticker__list">
                            @foreach ($breakingNews as $news)
                                <li class="newsticker__item">
                                    <i class="fa-solid fa-newspaper"></i>
                                    <a href="{{ route('singlePost', [
                                        'rubrik' => $news->post->rubrik->rubrik_name,
                                        'post_id' => $news->post->post_id,
                                        'slug' => $news->post->slug,
                                    ]) }}"
                                        class="newsticker__item-url">{{ $news->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif