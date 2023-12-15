@extends('amp.layouts.web')
@section('content')
    <!-- Breadcrumbs -->
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url('/') }}" class="breadcrumbs__url"><i class="fa-solid fa-house"></i></a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('category', ['rubrik_name' => Str::slug($post->rubrik->rubrik_name)]) }}"
                    class="breadcrumbs__url">{{ $post->rubrik->rubrik_name }}</a>
            </li>
        </ul>
    </div>

    <div class="main-container container" id="main-container">

        <!-- Content -->
        <article class="row" style="padding: 10px;">
            <div class="flex-container">
                <div class="flex-item post-title">
                    <h1>
                        {{ $post->title }}
                    </h1>
                </div>
                <div class="flex-item post-author">
                    <span>Tim Gema</span> | {{ convert_date_to_ID($post->created_at) }}
                </div>
                <div class="flex-item">
                    <amp-img src="{{ get_post_image($post->post_id) }}" alt="{{ $post->title }}" layout="responsive"
                        height="320" width="480"></amp-img>
                    <p class="photo__caption">{!! !empty($post->image) ? strip_tags($post->image->caption) : '' !!}</p>
                </div>
                <div class="flex-item main-content">
                    @php
                        $article = $post->article;
                        $article = str_replace('../', '' . url('') . '/', $article);
                    @endphp
                    {!! $article !!}
                </div>
                <div class="flex-item">
                    <div class="croslink">
                        <a href="https://news.google.com/search?q=gemasulawesi.com&hl=id&gl=ID&ceid=ID%3Aid" target="_blank"
                            rel="noopener noreferrer">Ikuti Update Berita Terkini Gemasulawesi
                            di: <strong>Google News</strong></a>
                    </div>
                </div>
                <div class="flex-item">
                    <div class="editor__text">
                        <span>Editor: {{ $post->editor->display_name }}</span>
                    </div>
                </div>
                <div class="flex-item post-links" style="margin-top: 12px;">
                    <h2>Halaman:</h2>
                    <div class="halaman__wrap" style="position: relative; display: block;">
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <div class="halaman__item">
                                <a href="{{ route('singlePost', [
                                    'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                    'post_id' => $post->post_id,
                                    'slug' => $post->slug,
                                    'page' => $i,
                                ]) }}"
                                    class="rounded-button {{ $currentPage == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            </div>
                        @endfor
                        @if ($currentPage < $totalPages)
                            <div class="halaman__all">
                                <a href="{{ route('singlePost', [
                                    'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                    'post_id' => $post->post_id,
                                    'slug' => $post->slug,
                                    'page' => $currentPage + 1,
                                ]) }}"
                                    class="next-page-button">Selanjutnya</a>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- tags -->
                <div class="flex-item" style="margin-top: 12px;">
                    <h2>Tags:</h2>
                    <div class="tags" style="display: flex; flex-wrap: wrap;">
                        @php
                            if ($post->tags != null and $post->tags != 'null') {
                                foreach (json_decode($post->tags) as $tags) {
                                    $tag = \App\Models\Tags::find($tags);
                                    echo '<a class="tag-button" href="' . route('tags', ['tag_name' => $tag->tag_name]) . '" rel="tag">' . $tag->tag_name . '</a>';
                                }
                            }
                        @endphp
                    </div>
                </div> <!-- end tags -->
            </div>


            <!-- end sidebar -->

        </article> <!-- end content -->

        <div class="row bottom-widget" style="margin-top: 12px;">
            @if ($post->related_articles != null and $post->related_articles != 'null')
                <div class="berita-terkini-container">
                    <div class="berita-terkini-title">
                        <h2>Artikel terkait</h2>
                    </div>
                    <div class="berita-terkini">
                        <ol class="list-berita">
                            @foreach (json_decode($post->related_articles) as $related)
                                @php
                                    $related = \App\Models\Posts::find($related);
                                @endphp
                                <li>
                                        <a href="{{ route('singlePost', [
                                            'rubrik' => Str::slug($related->rubrik->rubrik_name),
                                            'post_id' => $related->post_id,
                                            'slug' => $related->slug,
                                        ]) }}"
                                            class="terkait__link">{{ $related->title }}</a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif
            <div class="berita-terkini-container" style="margin-top: 12px;">

                <div class="berita-terkini-title">
                    <h2>Berita Terkini</h2>
                </div>
                <div class="berita-terkini">
                    @foreach ($beritaTerkini as $post_item)
                        @php
                            $currentPostId = request()->segment(3);
                            $isCurrentPost = $currentPostId == $post_item->post_id;
                        @endphp
                        @if (!$isCurrentPost)
                            <div class="berita-terkini-items">
                                <div class="berita-terkini-img">
                                    <a
                                        href="{{ route('singlePost', [
                                            'rubrik' => Str::slug($post_item->rubrik->rubrik_name),
                                            'post_id' => $post_item->post_id,
                                            'slug' => $post_item->slug,
                                        ]) }}">
                                        <amp-img src="{{ get_post_image($post_item->post_id) }}"
                                             alt="{{ $post->title }}"
                                            class="lazyload" class="" height="100" width="100">
                                    </a>
                                </div>
                                <div class="berita-terkini-title">
                                    <a href="{{ route('singlePost', [
                                        'rubrik' => Str::slug($post_item->rubrik->rubrik_name),
                                        'post_id' => $post_item->post_id,
                                        'slug' => $post_item->slug,
                                    ]) }}"
                                        class="post-title"><b>{{ $post_item->title }}</b></a>
                                        <p class="bt__date"><small>{{ convert_date_to_ID($post_item->created_at) }}</small></p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
