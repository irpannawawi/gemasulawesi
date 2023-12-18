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
                            <a id="home_page" class="nav-link active dropdown-toggle" data-toggle="dropdown"
                                href="#" role="button" aria-haspopup="true" aria-expanded="false">Home Page</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="load_page('top_page')" id="top_page"
                                    href="#">Top Page</a>
                                <a class="dropdown-item" onclick="load_page('below_headline')" id="below_headline"
                                    href="#">Below Headline</a>
                                <a class="dropdown-item" onclick="load_page('in_article_list')" id="in_article_list"
                                    href="#">In Article list</a>
                                <a class="dropdown-item" onclick="load_page('footer')" id="footer"
                                    href="#">Footer</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="in_article" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Article</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="load_page('above_content')" id="above_content" href="#">Above Content</a>
                                <a class="dropdown-item" onclick="load_page('below_heading')" id="below_heading" href="#">Below Heading</a>
                                <a class="dropdown-item" onclick="load_page('content')" id="content" href="#">Content</a>
                                <a class="dropdown-item" onclick="load_page('below_content')" id="below_content" href="#">Below Content</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" id="sidebar" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Sidebar</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="load_page('above_sidebar')" id="above_sidebar" href="#">Above Sidebar</a>
                                <a class="dropdown-item" onclick="load_page('below_sidebar')" id="below_sidebar" href="#">Below Sidebar</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="load_page('pop_up')" id="pop_up">Popup Ads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="load_page('html_script')" id="html_script">Scripts</a>
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
            document.addEventListener('DOMContentLoaded', function() {});
            var wraper = $('#adsWraper')

            // buttone
            home_pages = ['top_page', 'below_headline', 'in_article_list', 'footer']
            sidebar = ['above_sidebar', 'below_sidebar'];
            single_page = ['above_content', 'below_heading', 'content', 'below_content']


            function load_page(page_name) {
                $.get("{{ url('/ads/load_page') }}" + '/' + page_name, {}, (res) => {
                    wraper.html(res);
                    $('.dropdown-item').removeClass('active')
                    $('#' + page_name).addClass('active')
                    

                    // nav active
                    
                    $('.nav-link').removeClass('active')
                    if (home_pages.includes(page_name)) {
                        $('#home_page').addClass('active')
                    }

                    if (sidebar.includes(page_name)) {
                        $('#sidebar').addClass('active')
                    }

                    if (single_page.includes(page_name)) {
                        $('#in_article').addClass('active')
                    }
                    if (page_name=='pop_up') {
                        $('#pop_up').addClass('active')
                    }
                    
                    if (page_name=='html_script') {
                        $('#html_script').addClass('active')
                    }
                });
            }
            @if (Session::has('last_load'))
                load_page('{{ Session::get('last_load') }}')
            @else
                load_page('top_page')
            @endif
        </script>
    @endpush
</x-app-layout>
