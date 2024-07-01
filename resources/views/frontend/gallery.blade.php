@extends('layouts.web')
@section('css')
@endsection
@section('content')
    <div class="main-container container" id="main-container">
        <!-- Content -->
        <div class="row row-20">

            <div class="col-lg-8 order-lg-2">
                <x-ad-item position='top_page' />

                <section>
                    <div class="berita-terkini">
                        <div class="title-list-berita">
                            <h1>Gallery Berita Terkini</h1>
                        </div>
                        <div class="pilihan-editor">
                            <!-- Hihglit -->
                            <div class="pt-3 d-flex flex-row">
                                    @foreach ($gallery->slice(0, 2) as $key)
                                        <div class="col-6">
                                            <div class="card text-white">
                                                <a
                                                    href="{{ route('galerydetail', [
                                                        'galery_id' => $key->galery_id,
                                                        'galery_name' => Str::slug($key->galery_name),
                                                    ]) }}">
                                                    <img src="{{ Storage::url('galery-images/' . $key->galery_thumbnail) }}"
                                                        class="card-img" alt="Card image">
                                                    <div class="card-caption mt-1 p-2">
                                                        <p class="card-title m-0"><b>{{ $key->galery_name }}</b></p>
                                                        <p><small>{{ convert_date_to_ID($key->created_at) }}</small></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- @foreach ($gallery->slice(0, 3) as $key)
                                        <article class="entry" style="background-color: white; border-radius:10px;">
                                            <div class="entry__img-editorial mb-0">
                                                <a
                                                    href="{{ route('galerydetail', [
                                                        'galery_id' => $key->galery_id,
                                                        'galery_name' => Str::slug($key->galery_name),
                                                    ]) }}">
                                                    <div class="thumb-container thumb-65">
                                                        <img src="{{ Storage::url('galery-images/' . $key->galery_thumbnail) }}"
                                                            src="{{ url('assets/frontend') }}/img/empty.jpg"
                                                            class="entry__img" alt="{{ $key->galery_description }}">
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="entry__body mt-0">
                                                <div class="entry__header text-center">
                                                    <h2 class="entry__title">
                                                        <a
                                                            href="{{ route('galerydetail', [
                                                                'galery_id' => $key->galery_id,
                                                                'galery_name' => Str::slug($key->galery_name),
                                                            ]) }}">{{ $key->galery_name }}</a>
                                                    </h2>
                                                    <p class="bt__date">{{ convert_date_to_ID($key->created_at) }}</p>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach --}}
                            </div>
                        </div>
                        {{-- ./end highlit --}}
                        <div class="row mb-3 p-2">
                            @php
                                $for_sliders = $galery;
                            @endphp
                            @foreach ($for_sliders->slice(2) as $galery)
                                <div class="col-lg-4 col-md-6 col-sm-6 p-1 m-0">
                                    <div class="card text-white">
                                        <a
                                            href="{{ route('galerydetail', [
                                                'galery_id' => $galery->galery_id,
                                                'galery_name' => Str::slug($galery->galery_name),
                                            ]) }}">
                                            <img src="{{ Storage::url('galery-images/' . $galery->galery_thumbnail) }}"
                                                class="card-img" alt="Card image">
                                            <div class="card-caption mt-1 p-2">
                                                <p class="card-title m-0"><b>{{ $galery->galery_name }}</b></p>
                                                <p><small>{{ convert_date_to_ID($galery->created_at) }}</small></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            {{-- </div>
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
                                                        <img data-src="{{ Storage::url('galery-images/' . $galery->galery_thumbnail) }}"
                                                            src="{{ url('assets/frontend') }}/img/empty.jpg"
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
                        </div> --}}
                        </div>
                </section>
            </div>
            <x-sidebar />
        </div>
        <!-- end content -->
        <div class="col-lg-8">
            <x-ad-item position='footer' />
        </div>
    </div> <!-- end main container -->
@endsection
