<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Ads Management') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Global</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" id="top_page" href="#">Top Page</a>
                                <a class="dropdown-item" id="below_headline" href="#">Below Headline</a>
                                <a class="dropdown-item" id="in_article_list" href="#">In Article list</a>
                                <a class="dropdown-item" id="footer" href="#">Footer</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Article</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Above Content</a>
                                <a class="dropdown-item" href="#">Below Heading</a>
                                <a class="dropdown-item" href="#">Content</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Sidebar</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Above Sidebar</a>
                                <a class="dropdown-item" href="#">Below Sidebar</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Popup Ads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Scripts</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12" id="adsWraper">

                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let wraper = $('#adsWraper')

                // buttone
                let top_page = $('#top_page')
                let below_headline = $('#below_headline')
                let in_article_list = $('#in_article_list')
                let footer = $('#footer')

                function load_page(page_name) {
                    $.get("{{ url('/ads/load_page') }}" + '/' + page_name, {}, (res) => {
                        wraper.html(res);
                    });
                }

                load_page('top_page')
            });
        </script>
    @endpush
</x-app-layout>
