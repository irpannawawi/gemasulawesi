<rss xmlns:media="http://search.yahoo.com/mrss/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
    <channel>
        <atom:link href="{{ url($meta['link']) }}" rel="self" type="application/rss+xml" />
        <title>{!! \Spatie\Feed\Helpers\Cdata::out($meta['title']) !!}</title>
        <link>{!! \Spatie\Feed\Helpers\Cdata::out(url($meta['link'])) !!}</link>
        @if (!empty($meta['image']))
            <image>
                <url>{{ $meta['image'] }}</url>
                <title>{!! \Spatie\Feed\Helpers\Cdata::out($meta['title']) !!}</title>
                <link>{!! \Spatie\Feed\Helpers\Cdata::out(url($meta['link'])) !!}</link>
            </image>                        
        @endif
        <description>{!! \Spatie\Feed\Helpers\Cdata::out($meta['description']) !!}</description>
        <language>{{ $meta['language'] }}</language>
        <pubDate>{{ $meta['updated'] }}</pubDate>

        @foreach ($items as $item)
            <item>
                <title>{!! \Spatie\Feed\Helpers\Cdata::out($item->title) !!}</title>
                <link>{{ url($item->link) }}</link>
                <author>{{ $item->authorEmail.' '.($item->authorName) }}</author>
                <description>{!! \Spatie\Feed\Helpers\Cdata::out($item->summary) !!}</description>
                <guid>{{ url($item->link) }}</guid>
                <pubDate>{{ $item->timestamp() }}</pubDate>
                @foreach ($item->category as $category)
                    <category>{{ $category }}</category>
                @endforeach
                <content:encoded>{!! \Spatie\Feed\Helpers\Cdata::out($item->content) !!}</content:encoded>
                @if ($item->__isset('enclosure'))
                    <enclosure url="{{ url($item->enclosure) }}"
                        length="{{ !empty($item->enclosureLength) ? $item->enclosureLength : '' }}"
                        type="{{ $item->enclosureType }}" />
                @endif


            </item>
        @endforeach
    </channel>
</rss>
