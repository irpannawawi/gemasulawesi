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
@push('custom-css')
    <style>
        .ads__banner {
            padding-bottom: 1.5rem;
        }

        .ads {
            position: relative;
            border: 1px solid #eff0f6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            border-radius: 5px;
        }

        .ads__box {
            text-align: center;
            position: relative;
        }
    </style>
@endpush

@foreach ($ads as $ad)
    @if ($ad->type == 'img')
        <div class="ads p-2 mb-2 mt-2 bg-body" style="width: 100%;">
            <div class="ads__box">
                <div class="div-gpt-ad-giant">
                    <a href="{{ $ad->link == '' ? '#' : $ad->link }}" target="__blank">
                        <img src="{{ Storage::url('ads/' . $ad->value) }}" alt="Iklan" style="width:100%;">
                    </a>
                </div>
            </div>
        </div>
    @else
        {!! $ad->value !!}
    @endif
@endforeach
