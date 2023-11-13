@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">

                <section>
                    <!-- #TagName -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>#{{ $tag_name }}</span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @foreach ($beritaTerkini[0] as $post)
                                        <li class="post-list-small__item">
                                            <article class="post-list-small__entry clearfix">
                                                <div class="post__img">
                                                    <a
                                                        href="{{ route('singlePost', [
                                                            'rubrik' => str_replace(' ', '-', $post->rubrik->rubrik_name),
                                                            'post_id' => $post->post_id,
                                                            'slug' => $post->slug,
                                                        ]) }}">
                                                        <img data-src="{{ get_post_image($post->post_id) }}"
                                                            src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                            class="lazyload">
                                                    </a>
                                                </div>
                                                <div class="post-list-small__body">
                                                    <ul class="entry__meta category underline">
                                                        <li>
                                                            <a href="{{ route('category', ['rubrik_name' => $post->rubrik->rubrik_name]) }}"
                                                                class="entry__meta-category">{{ $post->rubrik->rubrik_name }}</a>
                                                        </li>
                                                    </ul>
                                                    <h3 class="post-list-small__entry-title">
                                                        <a
                                                            href="{{ route('singlePost', [
                                                                'rubrik' => str_replace(' ', '-', $post->rubrik->rubrik_name),
                                                                'post_id' => $post->post_id,
                                                                'slug' => $post->slug,
                                                            ]) }}">{{ $post->title }}</a>
                                                    </h3>
                                                    <p class="bt__date">{{ convert_date_to_ID($post->created_at) }}</p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Ad Banner 728 -->
                                <div class="text-center pb-48">
                                    <a href="#">
                                        <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                            alt="">
                                    </a>
                                </div>

                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @foreach ($beritaTerkini[1] as $post)
                                        <li class="post-list-small__item">
                                            <article class="post-list-small__entry clearfix">
                                                <div class="post__img">
                                                    <a
                                                        href="{{ route('singlePost', [
                                                            'rubrik' => str_replace(' ', '-', $post->rubrik->rubrik_name),
                                                            'post_id' => $post->post_id,
                                                            'slug' => $post->slug,
                                                        ]) }}">
                                                        <img data-src="{{ get_post_image($post->post_id) }}"
                                                            src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                            class="lazyload">
                                                    </a>
                                                </div>
                                                <div class="post-list-small__body">
                                                    <ul class="entry__meta category underline">
                                                        <li>
                                                            <a href="{{ route('category', ['rubrik_name' => $post->rubrik->rubrik_name]) }}"
                                                                class="entry__meta-category">{{ $post->rubrik->rubrik_name }}</a>
                                                        </li>
                                                    </ul>
                                                    <h3 class="post-list-small__entry-title">
                                                        <a
                                                            href="{{ route('singlePost', [
                                                                'rubrik' => str_replace(' ', '-', $post->rubrik->rubrik_name),
                                                                'post_id' => $post->post_id,
                                                                'slug' => $post->slug,
                                                            ]) }}">{{ $post->title }}</a>
                                                    </h3>
                                                    <p class="bt__date">{{ convert_date_to_ID($post->created_at) }}</p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="paging paging--page">
                                    {{ $paginatedPost->onEachSide(1)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div> <!-- end slider -->

            <!-- Sidebar -->
            <x-sidebar />
            <!-- end sidebar -->
        </div> <!-- end content -->
    </div> <!-- end main container -->
@endsection
