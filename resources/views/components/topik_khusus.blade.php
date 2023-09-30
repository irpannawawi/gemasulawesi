<div class="pilihan-editor">
    <div class="title-wrap">
        <h3 class="section-title-editor">TOPIK KHUSUS</h3>
    </div>

   <!-- Slider -->
   <div class="wrap-owl">
    <div id="owl-pilihan-editor" class="owl-carousel owl-theme owl-carousel--arrows-outside">
        @foreach ($topikKhusus as $topik)
            <article class="entry" style="background-color: white; border-radius:10px;">
                <div class="entry__img-holder mb-0">
                    <a href="#">
                        <div class="thumb-container thumb-65">
                            <img data-src="{{ $topik->topic_image}}"
                                src="{{ url('assets/frontend') }}/img/empty.png"
                                class="entry__img lazyload" alt="{{ $topik->description }}">
                        </div>
                    </a>
                </div>
                <div class="entry__body mt-0">
                    <div class="entry__header text-center">
                        <h2 class="entry__title">
                            <a
                                href="#">{{ $topik->topic_name }}</a>
                        </h2>
                        <p class="bt__date">{{convert_date_to_ID($topik->created_at)}}</p>
                    </div>
                </div>
            </article>
        @endforeach
    </div> <!-- end slider -->
    <div class="wrap-btn-slider">
        <div class="btn-slider">
            <button class="btn-prev" id="prevPost3"><i class="ui-arrow-left"></i></button>
            <button class="btn-nect" id="nextPost3"><i class="ui-arrow-right"></i></button>
        </div>
    </div>
</div>
</div>