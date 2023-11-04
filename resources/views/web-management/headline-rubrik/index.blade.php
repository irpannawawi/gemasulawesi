<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-bars"></i> {{ __('Headline Rubrik ' . $rubrik->rubrik_name) }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="card col-md-3">
                <div class="card-body p-1">
                    <label>Headline 1</label>
                    <img id="imgheadline1"
                        src="{{@get_post_image($headline->post->post_id)}}"
                        class="img img-responsive"
                        title="{{@$headline->post->title}}"
                        style="">
                    <input id="hdheadline1" type="hidden" name="hdHeadline[]" value="9606620">
                    <input type="text" class="form-control p-1" name="title[]"
                        title="{{@$headline->post->title}}"
                        value="{{@$headline->post->title}}"
                        readonly="">
                    <div style="position:absolute;top:35px;right:11px">
                        <div class="btn-group">
                            <button id="select_article" class="btn btn-default btn-sm btn-flat btn-dialog" title="Select Section Headline" data-toggle="modal" data-target="#modalArticle"><i class="fa fa-external-link"></i> Choose</button>
                            <button type="button" onclick="return delete_headline('{{$rubrik->rubrik_id}}')"
                                class="btn btn-danger bg-danger btn-sm btn-flat " data-no="1"><i
                                    class="fa fa-trash"></i> Delete</button>
                        </div>
                    </div>
                </div>
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
                    <iframe src="{{ route('modal.select-article',['rubrik_id'=>$rubrik->rubrik_id]) }}" frameborder="0"
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
        function change_article(post_id)
        {
            let  rubrik_id = '{{$rubrik->rubrik_id}}'
            
            url = '{{url('rubrik-headline-management-change')}}/'+rubrik_id+'/'+post_id
            window.location.href = url;
        }

        function delete_headline(id)
        {
            if(confirm('Kosongkan headline rubrik'))
            {
                window.location.href = '{{url('rubrik-headline-management-delete')}}/'+id
            }
        }
    </script>
@endpush

</x-app-layout>
