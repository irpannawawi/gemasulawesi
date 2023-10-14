<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-check-square"></i> {{ __('Pilihan Editor') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row col-12">

                {{-- Headline 1  --}}
                <div class="card col-md-3 m-1">
                    <div class="card-body p-1">
                        <label>Headline 1</label>
                        <img id="imgheadline1"
                            src="{{@$headline[0]->img_url}}"
                            class="img-responsive"
                            title="{{@$headline[0]->post->title}}"
                            style="height:150px !important">
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
    
                {{-- Headline 2  --}}
                <div class="card col-md-3 m-1">
                    <div class="card-body p-1">
                        <label>Headline 2</label>
                        <img id="imgheadline1"
                            src="{{@$headline[1]->img_url}}"
                            class="img-responsive"
                            title="{{@$headline[1]->post->title}}"
                            style="height:150px !important">
                        <input id="hdheadline1" type="hidden" name="hdHeadline[]" value="9606620">
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
    
                {{-- Headline 3  --}}
                <div class="card col-md-3 m-1">
                    <div class="card-body p-1">
                        <label>Headline 3</label>
                        <img id="imgheadline1"
                            src="{{@$headline[2]->img_url}}"
                            class="img-responsive"
                            title="{{@$headline[2]->post->title}}"
                            style="height:150px !important">
                        <input id="hdheadline1" type="hidden" name="hdHeadline[]" value="9606620">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[2]->post->title}}"
                            value="{{@$headline[2]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(2)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('2')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat " ><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ./ Headline 3 --}}
    
                {{-- Headline 4  --}}
                <div class="card col-md-3 m-1">
                    <div class="card-body p-1">
                        <label>Headline 4</label>
                        <img id="imgheadline1"
                            src="{{@$headline[3]->img_url}}"
                            class="img-responsive"
                            title="{{@$headline[3]->post->title}}"
                            style="height:150px !important">
                        <input id="hdheadline1" type="hidden" name="hdHeadline[]" value="9606620">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[3]->post->title}}"
                            value="{{@$headline[3]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(3)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('3')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat " data-no="1"><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ./ Headline 4 --}}

                {{-- Headline 5  --}}
                <div class="card col-md-3 m-1">
                    <div class="card-body p-1">
                        <label>Headline 5</label>
                        <img id="imgheadline1"
                            src="{{@$headline[4]->img_url}}"
                            class="img-responsive"
                            title="{{@$headline[4]->post->title}}"
                            style="height:150px !important">
                        <input id="hdheadline1" type="hidden" name="hdHeadline[]" value="9606620">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[4]->post->title}}"
                            value="{{@$headline[4]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(4)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('4')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat " data-no="1"><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ./ Headline 5 --}}

                {{-- Headline 6  --}}
                <div class="card col-md-3 m-1">
                    <div class="card-body p-1">
                        <label>Headline 6</label>
                        <img id="imgheadline1"
                            src="{{@$headline[5]->img_url}}"
                            class="img-responsive"
                            title="{{@$headline[5]->post->title}}"
                            style="height:150px !important">
                        <input id="hdheadline1" type="hidden" name="hdHeadline[]" value="9606620">
                        <input type="text" class="form-control p-1" name="title[]"
                            title="{{@$headline[5]->post->title}}"
                            value="{{@$headline[5]->post->title}}"
                            readonly="">
                        <div style="position:absolute;top:35px;right:11px">
                            <div class="btn-group">
                                <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" onclick="wp_id_selection(5)" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                                <button type="button" onclick="return delete_headline('5')"
                                    class="btn btn-danger bg-danger btn-sm btn-flat " data-no="1"><i
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
            
            url = '{{url('editor-choice-change')}}/'+WPID+'/'+post_id
            window.location.href = url;
        }

        function delete_headline(id)
        {
            if(confirm('Kosongkan headline rubrik'))
            {
                window.location.href = '{{url('editor-choice-delete')}}/'+id
            }
        }
    </script>
@endpush

</x-app-layout>
