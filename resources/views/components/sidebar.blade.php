@php
    $hotPost = App\Models\Posts::orderBy('visit', 'desc')
        ->where(['status' => 'published'])
        ->limit(10)
        ->get();
    $n = 1;
    // dd($hotPost);
@endphp
<aside class="col-lg sidebar order-lg-3 mb-4">
    <!-- Widget Popular Posts -->
    <h3 class="title-sidebar">
        <span>HOT TOPIC &#128293;</span>
    </h3>
    <div class="most__wrap">
        @foreach ($hotPost as $post)
            <div class="most__item">
                <div class="most__number">{{ $n++ }}</div>
                <div class="most__right">
                    <a href="{{ route('singlePost', [
                        'rubrik' => Str::slug($post->rubrik?->rubrik_name),
                        'post_id' => $post->post_id,
                        'slug' => $post->slug,
                    ]) }}"
                        class="most__link">
                        <h2 class="most__title">{{ $post->title }}</h2>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</aside>
