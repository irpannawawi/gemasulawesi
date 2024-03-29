<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-bars"></i> {{ __('Headline WP ') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body d-flex flex-row">
                {{-- Headline 1  --}}
                <div class="card m-1">

                    <div class="card-body p-1" style="min-height: 200px;">
                        <label>Headline 1</label>
                        <img id="imgheadline1"
                            src="{{@get_post_image($headline[0]->post->post_id)}}"
                            class="img img-responsive"
                            title="{{@$headline[0]->post->title}}"
                            style="height: 160px; width:100%;">
                        <input id="hdheadline1" type="hidden" name="hdHeadline[]" value="9606620">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[0]->post->title}}"
                            value="{{@$headline[0]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(0)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('0')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat "><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ./ Headline 1 --}}

                {{-- Headline 2 --}}
                <div class="card m-1">

                    <div class="card-body p-1" style="min-height: 200px;">
                        <label>Headline 2</label>
                        <img id="imgheadline2"
                            src="{{@get_post_image($headline[1]->post->post_id)}}"
                            class="img img-responsive"
                            title="{{@$headline[1]->post->title}}"
                            style="height: 160px; width:100%;">
                        <input id="hdheadline2" type="hidden" name="hdHeadline[]" value="9606621">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[1]->post->title}}"
                            value="{{@$headline[1]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(1)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('1')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat "><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ./ Headline 2 --}}
                {{-- Headline 3 --}}
                <div class="card m-1">

                    <div class="card-body p-1" style="min-height: 200px;">
                        <label>Headline 3</label>
                        <img id="imgheadline3"
                            src="{{@get_post_image($headline[2]->post->post_id)}}"
                            class="img img-responsive"
                            title="{{@$headline[2]->post->title}}"
                            style="height: 160px; width:100%;">
                        <input id="hdheadline3" type="hidden" name="hdHeadline[]" value="9606622">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[2]->post->title}}"
                            value="{{@$headline[2]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(2)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('2')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat "><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ./ Headline 3 --}}
                {{-- Headline 4 --}}
                <div class="card m-1">

                    <div class="card-body p-1" style="min-height: 200px;">
                        <label>Headline 4</label>
                        <img id="imgheadline4"
                            src="{{@get_post_image($headline[3]->post->post_id)}}"
                            class="img img-responsive"
                            title="{{@$headline[3]->post->title}}"
                            style="height: 160px; width:100%;">
                        <input id="hdheadline4" type="hidden" name="hdHeadline[]" value="9606623">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[3]->post->title}}"
                            value="{{@$headline[3]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(3)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('3')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat "><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ./ Headline 4 --}}
            </div>
        </div>
    </div>


    <!-- Modal Source-->
    <div class="modal fade" id="modalArticle" tabindex="-1" role="dialog" aria-labelledby="modalArticleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalArticleLabel">Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ route('modal.select-article-all') }}" frameborder="0"
                        style="width: 100%; height: 750px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn bg-primary btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
@push('custom-scripts')
    <script>
        var WPID = null;
        function wp_id_selection(id)
        {
            WPID = id;
        }
        function change_article(post_id)
        {
            
            url = '{{url('wp-headline-management-change')}}/'+WPID+'/'+post_id
            window.location.href = url;
        }

        function delete_headline(id)
        {
            if(confirm('Kosongkan headline rubrik'))
            {
                window.location.href = '{{url('wp-headline-management-delete')}}/'+id
            }
        }
    </script>
@endpush

</x-app-layout>
