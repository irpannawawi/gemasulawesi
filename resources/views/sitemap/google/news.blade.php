@php
    use Illuminate\Support\Carbon;
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    @foreach ($posts as $post)
        <url>
            <loc>
                {{ route('singlePost', [
                    'rubrik' => Str::slug($post->rubrik->rubrik_name),
                    'post_id' => $post->post_id,
                    'slug' => $post->slug,
                ]) }}
            </loc>
            <news:news>
                <news:publication>
                    <news:name>{{$post->rubrik->rubrik_name}}</news:name>
                    <news:language>id</news:language>
                </news:publication>
                <news:publication_date>{{ Carbon::parse($post['published_at'])->format('Y-m-d\TH:i:sP') }}</news:publication_date>
                <news:title>{{ $post['title'] }}</news:title>

                @if ($post->tags != null and $post->tags != 'null')
                    <news:keywords>
                        @foreach (json_decode($post->tags) as $tags)
                            @php
                                $tag = \App\Models\Tags::find($tags);
                            @endphp
                            {{ $tag->tag_name . ',' }}
                        @endforeach
                    </news:keywords>
                @endif
            </news:news>
        </url>
    @endforeach
</urlset>
