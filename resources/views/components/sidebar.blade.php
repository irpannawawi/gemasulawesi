@php
    use Carbon\Carbon;

    $today = Carbon::today();
    $yesterday = Carbon::yesterday();
    $hotPost = cache()->remember('hotTopics', 120, function()use($today, $yesterday){
        return App\Models\Posts::orderBy('visit', 'desc')
            ->where(['status' => 'published'])
            ->where('published_at', '>=', $yesterday)
            ->where('published_at', '<=', $today)
            ->limit(10)
            ->get();
    }); 
    $n = 1;
    // dd($hotPost);
@endphp
<aside class="col-lg sidebar order-lg-3 mb-4">
    <x-ad-item position='above_sidebar' />
    <!-- Widget Popular Posts -->
    <section class="mt-4">
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
    </section>
    <x-ad-item position='below_sidebar' />
</aside>
<script>
    // // JavaScript untuk tampilan mobile
    // if (window.innerWidth <= 767) {
    //     var mostItems = document.querySelectorAll('.most__item');
    //     for (var i = 5; i < mostItems.length; i++) {
    //         mostItems[i].style.display = 'none';
    //     }
    // }
</script>
