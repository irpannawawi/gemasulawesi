@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">
        <!-- Content -->
        <div class="row row-20">
            <div class="col-lg-8 order-lg-2">

                <section>
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <span>Gallery Berita Terkini</span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="post-list-small post-list-small--2 mb-32">
                                    @foreach ($galery as $galery)
                                        <li class="post-list-small__item">
                                            <article class="post-list-small__entry clearfix">
                                                <div class="post__img">
                                                    <a
                                                        href="{{ route('galerydetail', [
                                                            'galery_id' => $galery->galery_id,
                                                            'galery_name' => Str::slug($galery->galery_name),
                                                        ]) }}">
                                                        {{-- <i class="play__buttom fas fa-play-circle"></i> --}}
                                                        <img data-src="#" src="{{ url('assets/frontend') }}/img/empty.jpg"
                                                            alt="{{ $galery->galery_name }}" class="lazyload">
                                                    </a>
                                                </div>
                                                <div class="post-list-small__body">
                                                    <ul class="entry__meta category underline">
                                                        <li>
                                                            <a href="{{ route('gallery') }}"
                                                                class="entry__meta-category">Gallery</a>
                                                        </li>
                                                    </ul>
                                                    <h3 class="post-list-small__entry-title">
                                                        <a href="{{ route('galerydetail', [
                                                            'galery_id' => $galery->galery_id,
                                                            'galery_name' => Str::slug($galery->galery_name),
                                                        ]) }}"
                                                            class="post-title">{{ $galery->galery_name }}</a>
                                                    </h3>
                                                    <p class="bt__date">{{ convert_date_to_ID($galery->created_at) }}</p>
                                                </div>
                                            </article>
                                        </li>
                                    @endforeach
                                </ul>
                                {{ $pagination->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <x-sidebar />
            <!-- end content -->
        </div>
    </div> <!-- end main container -->
@endsection
