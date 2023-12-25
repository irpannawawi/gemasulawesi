@php
    if ($num == '' || empty($num)) {
        $ads = App\Models\Ad::where('position', $position)->get();
    }

    if ($num == '0') {
        $ads = App\Models\Ad::where('position', $position)
            ->limit(1)
            ->get();
    }

    if ($num == '1') {
        $ads = App\Models\Ad::where('position', $position)->get();
        if ($ads->count() == 2) {
            $ads = $ads->skip(1);
        } else {
            $ads = [];
        }
    }

@endphp

@foreach ($ads as $ad)
    @if ($ad->type == 'img')
        <div class="ads p-2 mb-2 mt-2 bg-body" style="width: 100%;">
            <div class="ads__box">
                <div class="div-gpt-ad-giant">
                    <a href="{{ $ad->link == '' ? '#' : $ad->link }}" target="__blank">
                        <img loading="lazy" src="{{ Storage::url('ads/' . $ad->value) }}" alt="Iklan" style="width:100%;">
                    </a>
                </div>
            </div>
        </div>
    @else
        {!! $ad->value !!}
    @endif
@endforeach
