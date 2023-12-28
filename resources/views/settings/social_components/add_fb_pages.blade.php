@foreach ($pages as $page)
    <form action="{{ route('socials.facebook.insertPages') }}" method="POST">
        @csrf
        <div class="info-box">
            <span class="info-box-icon">
                <img src="{{ $page->picture->data->url}}" alt="">
            </span>
            <div class="info-box-content">
                <span class="info-box-number">{{ $page->name }}</span>
                <span class="info-box-text">{{ $page->category}}</span>
            </div>
            <span class="info-box-icon">
                <input type="submit" class="btn p-2 m-2 btn-primary" value="Pilih">
            </span>

        </div>

        <textarea name="pageData" hidden>{{ json_encode($page) }}</textarea>
    </form>
@endforeach
