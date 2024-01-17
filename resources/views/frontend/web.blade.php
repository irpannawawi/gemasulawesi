@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">

        <!-- Content -->
        <div class="row row-20">

            <!-- slider -->
            <div class="col-lg-8 order-lg-2">
                <x-ad-item position='top_page' />

                <section>
                    <div class="wrapper-owl">
                        <div class="headline">
                            Headline
                        </div>
                        <div class="owl-carousel owl-carousel-thumbs" data-slider-id="5">
                            @foreach ($headlineWp as $headline)
                                <article class="entry thumb--size-3 mb-0">
                                    <div class="entry__img-holder homehead thumb__img-holder"
                                        style="background-image: url('{{ url('/') . '/storage/photos/' . $headline->post->image->asset->file_name }}');">
                                        <img src="{{ url('/') . '/storage/photos/' . $headline->post->image->asset->file_name }}"
                                            loading="lazy" alt="Deskripsi gambar">
                                        <div class="bottom-gradient"></div>
                                        <div class="thumb-text-holder thumb-text-holder--3">
                                            <ul class="entry__meta">
                                                <li>
                                                    <a href="{{ route('category', ['rubrik_name' => Str::slug($headline->post->rubrik->rubrik_name)]) }}"
                                                        class="entry__meta-category entry__meta-category--label entry__meta-category--tosca"
                                                        style="font-size: 12px;">{{ $headline->post->rubrik->rubrik_name }}</a>
                                                </li>
                                            </ul>
                                            <h2 class="thumb-entry-title">
                                                <a
                                                    href="{{ route('singlePost', [
                                                        'rubrik' => Str::slug($headline->post->rubrik->rubrik_name),
                                                        'post_id' => $headline->post->post_id,
                                                        'slug' => $headline->post->slug,
                                                    ]) }}">{{ $headline->post->title }}</a>
                                            </h2>
                                            {{-- <ul class="entry__meta">
                                                    <li class="entry__meta-views">
                                                        <i class="ui-eye"></i>
                                                        <span>1356</span>
                                                    </li>
                                                    <li class="entry__meta-comments">
                                                        <a href="#">
                                                            <i class="ui-chat-empty"></i>13
                                                        </a>
                                                    </li>
                                                </ul> --}}
                                        </div>
                                        <a class="thumb-url"></a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    <div class="owl-thumbs row mb-3 d-none d-md-flex w-100 mx-auto" data-slider-id="5">
                        @foreach ($headlineWp as $headline)
                            <div class="owl-thumb-item col-3 p-0">
                                <div class="card mt-3" style="border: none;">
                                    <a
                                        href="{{ route('singlePost', [
                                            'rubrik' => Str::slug($headline->post->rubrik->rubrik_name),
                                            'post_id' => $headline->post->post_id,
                                            'slug' => $headline->post->slug,
                                        ]) }}">
                                        <img src="{{ get_post_image($headline->post->post_id) }}"
                                            style="object-fit: cover;object-position: top;"
                                            alt="{{ $headline->post->title }}">
                                    </a>
                                    <div class="card-body">
                                        <a
                                            href="{{ route('singlePost', [
                                                'rubrik' => Str::slug($headline->post->rubrik->rubrik_name),
                                                'post_id' => $headline->post->post_id,
                                                'slug' => $headline->post->slug,
                                            ]) }}">
                                            {{ Str::limit($headline->post->title, 80) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <x-ad-item position='below_headline' />

                    <div class="pilihan-editor">
                        <div class="title-post">
                            <span>Editorial</span>
                        </div>

                        <!-- Slider -->
                        <div class="wrap-owl">
                            <div id="owl-pilihan-editor" class="owl-carousel owl-theme owl-carousel--arrows-outside">
                                @foreach ($editorCohice as $choice)
                                    <article class="entry">
                                        <div class="entry__img-editorial">
                                            <a
                                                href="{{ route('singlePost', [
                                                    'rubrik' => Str::slug($choice->post->rubrik->rubrik_name),
                                                    'post_id' => $choice->post_id,
                                                    'slug' => $choice->post->slug,
                                                ]) }}">
                                                <div class="thumb-container thumb-65">
                                                    <img data-src="{{ get_post_thumbnail($choice->post->post_id) }}"
                                                        src="{{ url('assets/frontend') }}/img/empty.png"
                                                        class="entry__img lazyload" alt="{{ $choice->post->title }}">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="entry__body">
                                            <div class="entry__header">
                                                <ul class="entry__meta">
                                                    <li>
                                                        <a href="{{ route('singlePost', [
                                                            'rubrik' => Str::slug($choice->post->rubrik->rubrik_name),
                                                            'post_id' => $choice->post_id,
                                                            'slug' => $choice->post->slug,
                                                        ]) }}"
                                                            class="entry__meta-category">{{ $choice->post->rubrik->rubrik_name }}</a>
                                                    </li>
                                                </ul>
                                                <h2 class="entry__title">
                                                    <a
                                                        href="{{ route('singlePost', [
                                                            'rubrik' => Str::slug($choice->post->rubrik->rubrik_name),
                                                            'post_id' => $choice->post_id,
                                                            'slug' => $choice->post->slug,
                                                        ]) }}">{{ Str::limit($choice->post->title, 60) }}</a>
                                                </h2>
                                                <p class="bt__date">{{ convert_date_to_ID($choice->post->published_at) }}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div> <!-- end slider -->
                            <div class="wrap-btn-slider">
                                <div class="btn-slider">
                                    <a href="javascript:;" class="btn-prev" id="prevPost3"><i class="ui-arrow-left"></i></a>
                                    <a href="javascript:;" class="btn-nect" id="nextPost3"><i
                                            class="ui-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Berita Terkini -->
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>Berita Terkini</span>
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
                                                            'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                            'post_id' => $post->post_id,
                                                            'slug' => $post->slug,
                                                        ]) }}">
                                                        <img data-src="{{ get_post_thumbnail($post->post_id) }}"
                                                            src="{{ url('assets/frontend') }}/img/empty.png"
                                                            alt="{{ $post->title }}" class="lazyload">
                                                    </a>
                                                </div>
                                                <div class="post-list-small__body">
                                                    <ul class="entry__meta category underline">
                                                        <li>
                                                            <a href="{{ route('category', ['rubrik_name' => Str::slug($post->rubrik->rubrik_name)]) }}"
                                                                class="entry__meta-category">{{ $post->rubrik->rubrik_name }}</a>
                                                        </li>
                                                    </ul>
                                                    <h3 class="post-list-small__entry-title">
                                                        <a href="{{ route('singlePost', [
                                                            'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                            'post_id' => $post->post_id,
                                                            'slug' => $post->slug,
                                                        ]) }}"
                                                            class="post-title">{{ $post->title }}</a>
                                                    </h3>
                                                    <p class="bt__date">{{ convert_date_to_ID($post->published_at) }}
                                                    </p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                                <x-ad-item position='in_article_list' num="0" />

                                <x-topik_khusus :$topikKhusus />

                                <!-- Ad Banner 728 -->
                                {{-- <div class="text-center mt-3 mb-3">
                                    <a href="#">
                                        <img src="{{ url('assets/frontend') }}/img/content/placeholder_728.jpg"
                                            alt="">
                                    </a>
                                </div> --}}

                            </div>

                        </div>
                    </div>
                </section>


            </div> <!-- end slider -->

            <!-- Sidebar -->

            <x-sidebar />
            <!-- end sidebar -->

        </div> <!-- end content -->

        {{-- row bawah --}}
        <div class="row row-20 row__bawah">
            <div class="col-lg-8 order-lg-2">
                <x-ad-item position='in_article_list' num="1" />

                <section>
                    <div class="row">
                        <div class="col">
                            <ul class="post-list-small post-list-small--2 mb-32">
                                @foreach ($beritaTerkini[1] as $post)
                                    <li class="post-list-small__item">
                                        <article class="post-list-small__entry clearfix">
                                            <div class="post__img">
                                                <a
                                                    href="{{ route('singlePost', [
                                                        'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                        'post_id' => $post->post_id,
                                                        'slug' => $post->slug,
                                                    ]) }}">
                                                    <img data-src="{{ get_post_thumbnail($post->post_id) }}"
                                                        src="{{ url('assets/frontend') }}/img/empty.png"
                                                        alt="{{ $post->title }}" class="lazyload">
                                                </a>
                                            </div>
                                            <div class="post-list-small__body">
                                                <ul class="entry__meta category underline">
                                                    <li>
                                                        <a href="{{ route('category', ['rubrik_name' => Str::slug($post->rubrik->rubrik_name)]) }}"
                                                            class="entry__meta-category">{{ $post->rubrik->rubrik_name }}</a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-list-small__entry-title">
                                                    <a href="{{ route('singlePost', [
                                                        'rubrik' => Str::slug($post->rubrik->rubrik_name),
                                                        'post_id' => $post->post_id,
                                                        'slug' => $post->slug,
                                                    ]) }}"
                                                        class="post-title">{{ $post->title }}</a>
                                                </h3>
                                                <p class="bt__date">{{ convert_date_to_ID($post->published_at) }}</p>
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="loadmore">
                                <a href="{{ url('indeks-berita') }}" class="tombolmore">Lihat Semua</a>
                            </div>

                            <x-ad-item position='footer' />

                        </div>
                    </div>
                </section> <!-- end carousel posts -->
            </div>

        </div>
    </div> <!-- end main container -->

    <!-- Modal Ads -->
    @php
        $popup = App\Models\Ad::where('position', 'pop_up')->get();
    @endphp
    @if ($popup->count() > 0)
        <div class="modal fade" id="adModal" tabindex="-1" aria-labelledby="adModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="">
                <div class="modal-content">
                    <div class="modal-body p-0" style="">
                        <button type="button" style="position: absolute; right: 10px;" class="close m-2 text-dark"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img class="img img-responsive" style="width: 100%"
                            src="{{ Storage::url('public/ads/' . $popup[0]->value) }}" alt="">
                    </div>
                    <div class="modal-footer p-0">
                        <div class="input-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="disableAd">
                                <label class="form-check-label" for="disableAd">
                                    Matikan pop up hari ini
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('extra-js')
            <script>
                function setWithExpiry(key, value) {
                    const now = new Date()

                    // `item` is an object which contains the original value
                    // as well as the time when it's supposed to expire
                    const item = {
                        value: value,
                        expiry: now.getTime() + 1000 * 60 * 60 * 24,
                    }
                    localStorage.setItem(key, JSON.stringify(item))
                }

                function getWithExpiry(key) {
                    const itemStr = localStorage.getItem(key)
                    // if the item doesn't exist, return null
                    if (!itemStr) {
                        return null
                    }
                    const item = JSON.parse(itemStr)
                    const now = new Date()
                    // compare the expiry time of the item with the current time
                    if (now.getTime() > item.expiry) {
                        // If the item is expired, delete the item from storage
                        // and return null
                        localStorage.removeItem(key)
                        return null
                    }
                    return item.value
                }



                // display ad
                // cek kuki jika disabled maka jangan tampilkan

                if (getWithExpiry('disableAd') == null) {
                    $('#adModal').modal('toggle');
                }

                $("#adModal").on("hide.bs.modal", function() {
                    // check value checkbox
                    var disableAd = $('#disableAd').prop('checked');

                    if (disableAd) {
                        // If checkbox is checked, set a cookie to disable ads for one day
                        setWithExpiry('disableAd', true)
                        console.log('disabled for 1 day')
                    }
                });
            </script>
        @endpush
    @endif
@endsection
