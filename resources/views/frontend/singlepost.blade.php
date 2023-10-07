@extends('layouts.web')
@section('content')
    <!-- Breadcrumbs -->
    <div class="container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ url('/') }}" class="breadcrumbs__url"><i class="fa-solid fa-house"></i></a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('category', ['rubrik_name' => $post->rubrik->rubrik_name]) }}"
                    class="breadcrumbs__url">{{ $post->rubrik->rubrik_name }}</a>
            </li>
        </ul>
    </div>

    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row">

            <!-- post content -->
            <div class="col-lg-8 blog__content mb-72">
                <div class="meta-single-post">
                    <h1 class="title-single-post single-post__title-single-post">
                        {{ $post->title }}
                    </h1>
                    <div class="entry__meta-holder">
                        <ul class="entry__meta">
                            <li class="entry__meta-author">
                                <span>Tim Gema</span>
                            </li>
                            <li class="entry__meta-date">
                                {{ convert_date_to_ID($post->created_at) }}
                            </li>
                        </ul>
                    </div>
                    <div class="social-post socials--medium socials--rounded">
                        <a href="#" class="social social-facebook" aria-label="facebook"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social social-twitter" aria-label="twitter"><i
                                class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="social social-youtube" aria-label="youtube"><i
                                class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="social social-instagram" aria-label="instagram"><i
                                class="ui-instagram"></i></a>
                        <a href="#" class="social social-telegram" aria-label="instagram"><i
                                class="fa-brands fa-telegram"></i></a>
                    </div>
                </div>
                <!-- Entry Image -->
                {{-- <div class="thumb image-single-post">
                    <div class="entry__img-holder thumb__img-holder"
                        style="background-image: url('{{ get_string_between($post->article, '<img src="', '">') }}');">
                    </div>
                    <p class="photo__caption">Photo caption unavailable</p>
                </div> --}}

                <!-- standard post -->
                <article class="entry mb-0">
                    <div class="entry__article-wrap mt-0">
                        <div class="entry__article">
                            <article class="read__content">
                                @php
                                    $article = $post->article;
                                    if($post->tags!=null){

                                        foreach (json_decode($post->tags) as $tags) {
                                            $tag = \App\Models\Tags::find($tags);
                                            $article = str_ireplace($tag->tag_name, "<a href=\"".route('tags', ['tag_name'=>$tag->tag_name])."\" >" . $tag->tag_name . '</a>', $article);
                                            // dd($article);
                                        }
                                    }
                                    $article = str_replace('../', '' . url('') . '/', $article);
                                    // echo $article;
                                @endphp
                                {!! $article !!}
                                <!-- halaman -->
                                <div class="halaman">
                                    <divs class="halaman__teaser">Halaman: </divs>
                                    <div class="halaman__wrap">
                                        <div class="halaman__item">
                                            <span class="pagination__page pagination__page--current">1</span>
                                        </div>
                                        <div class="halaman__item">
                                            <a href="#" class="pagination__page">2</a>
                                        </div>
                                        <div class="halaman__all">
                                            <a href="#" class="halaman__selanjutnya">Selanjutnya</a>
                                        </div>
                                    </div>
                                </div>
                                <p>Editor: <a>Mitha Paradilla Rayadi</a></p>

                                <!-- tags -->
                                <div class="entry__tags">
                                    <i class="ui-tags"></i>
                                    <span class="entry__tags-label">Tags:</span>

                                    @php
                                    if($post->tags != null){

                                        foreach (json_decode($post->tags) as $tags) {
                                            $tag = \App\Models\Tags::find($tags);
                                            echo '<a href="'.route('tags', ['tag_name'=>$tag->tag_name]).'" rel="tag">' . $tag->tag_name . '</a>';
                                        }
                                    }
                                    @endphp
                                </div> <!-- end tags -->
                            </article>

                        </div> <!-- end entry article -->
                    </div> <!-- end entry article wrap -->

                    <!-- Related Posts -->
                    <section class="section related-posts mt-40 mb-0">
                        <div class="title-wrap title-wrap--line title-wrap--pr">
                            <h4 style="text-align: center">SHARE:</h4>
                            <div class="social-post socials--medium socials--rounded">
                                <a href="#" class="social social-facebook" aria-label="facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="social social-twitter" aria-label="twitter"><i
                                        class="fa-brands fa-x-twitter"></i></a>
                                <a href="#" class="social social-youtube" aria-label="youtube"><i
                                        class="fa-brands fa-youtube"></i></a>
                                <a href="#" class="social social-instagram" aria-label="instagram"><i
                                        class="ui-instagram"></i></a>
                                <a href="#" class="social social-telegram" aria-label="instagram"><i
                                        class="fa-brands fa-telegram"></i></a>
                            </div>
                        </div>

                        <!-- Slider -->
                        <div id="owl-posts-3-items" class="owl-carousel owl-theme owl-carousel--arrows-outside">
                            <article class="entry thumb thumb--size-1">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('img/content/carousel/carousel_post_1.jpg');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            <a href="single-post.html">9 Things to Consider Before Accepting a New Job</a>
                                        </h2>
                                    </div>
                                    <a href="single-post.html" class="thumb-url"></a>
                                </div>
                            </article>
                            <article class="entry thumb thumb--size-1">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('img/content/carousel/carousel_post_2.jpg');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            <a href="single-post.html">Gov’t Toughens Rules to Ensure 3rd Telco Player
                                                Doesn’t Slack Off</a>
                                        </h2>
                                    </div>
                                    <a href="single-post.html" class="thumb-url"></a>
                                </div>
                            </article>
                            <article class="entry thumb thumb--size-1">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('img/content/carousel/carousel_post_3.jpg');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            <a href="single-post.html">(Infographic) Is Work-Life Balance Even
                                                Possible?</a>
                                        </h2>
                                    </div>
                                    <a href="single-post.html" class="thumb-url"></a>
                                </div>
                            </article>
                            <article class="entry thumb thumb--size-1">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('img/content/carousel/carousel_post_4.jpg');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            <a href="single-post.html">Is Uber Considering To Sell its Southeast Asia
                                                Business to Grab?</a>
                                        </h2>
                                    </div>
                                    <a href="single-post.html" class="thumb-url"></a>
                                </div>
                            </article>
                            <article class="entry thumb thumb--size-1">
                                <div class="entry__img-holder thumb__img-holder"
                                    style="background-image: url('img/content/carousel/carousel_post_2.jpg');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                            <a href="single-post.html">Gov’t Toughens Rules to Ensure 3rd Telco Player
                                                Doesn’t Slack Off</a>
                                        </h2>
                                    </div>
                                    <a href="single-post.html" class="thumb-url"></a>
                                </div>
                            </article>
                        </div> <!-- end slider -->

                    </section> <!-- end related posts -->

                </article> <!-- end standard post -->

                <!-- Comments -->
                <div class="entry-comments">
                    <div class="title-wrap title-wrap--line">
                        <h3 class="section-title">3 comments</h3>
                    </div>
                    <ul class="comment-list">
                        <li class="comment">
                            <div class="comment-body">
                                <div class="comment-avatar">
                                    <img alt="" src="img/content/single/comment_1.jpg">
                                </div>
                                <div class="comment-text">
                                    <h6 class="comment-author">Joeby Ragpa</h6>
                                    <div class="comment-metadata">
                                        <a href="#" class="comment-date">July 17, 2017 at 12:48 pm</a>
                                    </div>
                                    <p>This template is so awesome. I didn’t expect so many features inside. E-commerce
                                        pages are very useful, you can launch your online store in few seconds. I will rate
                                        5 stars.</p>
                                    <a href="#" class="comment-reply">Reply</a>
                                </div>
                            </div>

                            <ul class="children">
                                <li class="comment">
                                    <div class="comment-body">
                                        <div class="comment-avatar">
                                            <img alt="" src="img/content/single/comment_2.jpg">
                                        </div>
                                        <div class="comment-text">
                                            <h6 class="comment-author">Alexander Samokhin</h6>
                                            <div class="comment-metadata">
                                                <a href="#" class="comment-date">July 17, 2017 at 12:48 pm</a>
                                            </div>
                                            <p>This template is so awesome. I didn’t expect so many features inside.
                                                E-commerce pages are very useful, you can launch your online store in few
                                                seconds. I will rate 5 stars.</p>
                                            <a href="#" class="comment-reply">Reply</a>
                                        </div>
                                    </div>
                                </li> <!-- end reply comment -->
                            </ul>

                        </li> <!-- end 1-2 comment -->

                        <li>
                            <div class="comment-body">
                                <div class="comment-avatar">
                                    <img alt="" src="img/content/single/comment_3.jpg">
                                </div>
                                <div class="comment-text">
                                    <h6 class="comment-author">Chris Root</h6>
                                    <div class="comment-metadata">
                                        <a href="#" class="comment-date">July 17, 2017 at 12:48 pm</a>
                                    </div>
                                    <p>This template is so awesome. I didn’t expect so many features inside. E-commerce
                                        pages are very useful, you can launch your online store in few seconds. I will rate
                                        5 stars.</p>
                                    <a href="#" class="comment-reply">Reply</a>
                                </div>
                            </div>
                        </li> <!-- end 3 comment -->

                    </ul>
                </div> <!-- end comments -->

                <!-- Comment Form -->
                <div id="respond" class="comment-respond">
                    <div class="title-wrap">
                        <h5 class="comment-respond__title section-title">Leave a Reply</h5>
                    </div>
                    <form id="form" class="comment-form" method="post" action="#">
                        <p class="comment-form-comment">
                            <label for="comment">Comment</label>
                            <textarea id="comment" name="comment" rows="5" required="required"></textarea>
                        </p>

                        <div class="row row-20">
                            <div class="col-lg-4">
                                <label for="name">Name: *</label>
                                <input name="name" id="name" type="text">
                            </div>
                            <div class="col-lg-4">
                                <label for="comment">Email: *</label>
                                <input name="email" id="email" type="email">
                            </div>
                            <div class="col-lg-4">
                                <label for="comment">Website:</label>
                                <input name="website" id="website" type="text">
                            </div>
                        </div>

                        <p class="comment-form-submit">
                            <input type="submit" class="btn btn-lg btn-color btn-button" value="Post Comment"
                                id="submit-message">
                        </p>

                    </form>
                </div> <!-- end comment form -->
            </div> <!-- end post content -->

            <!-- Sidebar -->
            <aside class="col-lg-4 sidebar sidebar--right">
                <!-- Widget Terpopuler -->
                <aside class="widget widget-popular-posts">
                    <h4 class="widget-title">Terpopuler</h4>
                    <ul class="post-list-small">
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <a href="single-post.html">
                                        <div class="thumb-container thumb-80">
                                            <img data-src="{{ url('assets/frontend') }}/img/content/post_small/post_small_5.jpg"
                                                src="img/empty.png" alt="" class="lazyload">
                                        </div>
                                    </a>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                        <a href="single-post.html">Follow These Smartphone Habits of Successful
                                            Entrepreneurs</a>
                                    </h3>
                                    <ul class="entry__meta">
                                        <li class="entry__meta-author">
                                            <span>by</span>
                                            <a href="#">DeoThemes</a>
                                        </li>
                                        <li class="entry__meta-date">
                                            Jan 21, 2018
                                        </li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                    </ul>
                </aside> <!-- end widget Terpopuler -->
            </aside> <!-- end sidebar -->

        </div> <!-- end content -->

        <div class="row row-20">
            <div class="col-lg-8 order-lg-2">

                <h3 class="title-terkait"><span>Berita Terkait</span></h3>
                <div class="berita__terkait">
                    <ul class="terkait__list">
                        <li>
                            <h2 class="terkait__title">
                                <a href="#" class="terkait__link">15 Twibbon Nuzulul Qur'an 1444 H, Spesial untuk
                                    Memperingati Turunnya Kitab Suci ke Bumi</a>
                            </h2>
                        </li>
                        <li>
                            <h2 class="terkait__title">
                                <a href="#" class="terkait__link">15 Twibbon Nuzulul Qur'an 1444 H, Spesial untuk
                                    Memperingati Turunnya Kitab Suci ke Bumi</a>
                            </h2>
                        </li>
                        <li>
                            <h2 class="terkait__title">
                                <a href="#" class="terkait__link">15 Twibbon Nuzulul Qur'an 1444 H, Spesial untuk
                                    Memperingati Turunnya Kitab Suci ke Bumi</a>
                            </h2>
                        </li>
                        <li>
                            <h2 class="terkait__title">
                                <a href="#" class="terkait__link">15 Twibbon Nuzulul Qur'an 1444 H, Spesial untuk
                                    Memperingati Turunnya Kitab Suci ke Bumi</a>
                            </h2>
                        </li>
                        <li>
                            <h2 class="terkait__title">
                                <a href="#" class="terkait__link">15 Twibbon Nuzulul Qur'an 1444 H, Spesial untuk
                                    Memperingati Turunnya Kitab Suci ke Bumi</a>
                            </h2>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 order-lg-2 mt-4">

                <h3 class="title-terkait"><span>Terkini</span></h3>
                <div class="row">
                    <div class="col">
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_1.jpg"
                                                    src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                    class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration
                                                camp':
                                                Bangladesh defends plan to house Rohingya on island with
                                                armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_2.jpg"
                                                    src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                    class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration
                                                camp':
                                                Bangladesh defends plan to house Rohingya on island with
                                                armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_3.jpg"
                                                    src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                    class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration
                                                camp':
                                                Bangladesh defends plan to house Rohingya on island with
                                                armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_4.jpg"
                                                    src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                    class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration
                                                camp':
                                                Bangladesh defends plan to house Rohingya on island with
                                                armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                        <ul class="post-list-small post-list-small--2 mb-32">
                            <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                    <div class="post-list-small__img-holder">
                                        <div class="thumb-container thumb-70">
                                            <a href="single-post-politics.html">
                                                <img data-src="{{ url('assets/frontend') }}/img/content/grid/grid_post_5.jpg"
                                                    src="{{ url('assets/frontend') }}/img/empty.png" alt=""
                                                    class=" lazyload">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="post-list-small__body">
                                        <ul class="entry__meta">
                                            <li>
                                                <a href="#" class="entry__meta-category">Category</a>
                                            </li>
                                        </ul>
                                        <h3 class="post-list-small__entry-title">
                                            <a href="single-post-politics.html">'It's not a concentration
                                                camp':
                                                Bangladesh defends plan to house Rohingya on island with
                                                armed
                                                police</a>
                                        </h3>
                                        <p class="bt__date">14 September 2023, 13:56 WIB</p>
                                    </div>
                                </article>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
