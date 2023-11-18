@push('extra-css')
    <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            {{ __('Setting Frontend') }}
        </h2>
    </x-slot>

    <div class="card">
        <form method="POST" action="{{ route('editorial.insert') }}">
            @csrf
            <div class="card-body" style="min-height: 400px">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="title">Judul Website Portal Berita</label>
                            <input type="text" maxlength="120" name="title" class="form-control"
                                placeholder="Enter title ...">
                        </div>
                        <div class="form-group">
                            <label>Meta Deskripsi</label>
                            <textarea class="editor" name="content" id="content" class="form-control" cols="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-secondary bg-secondary" type="button"><i class="fa fa-save"></i>
                    Simpan</button>
            </div>
        </form>
    </div>


    {{-- modals --}}
    <!-- Button trigger modal -->

    <!-- Modal Tags -->
    <div class="modal fade" id="modalTags" tabindex="-1" role="dialog" aria-labelledby="modalTagsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTagsLabel">Tags management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ route('modal.tags') }}" frameborder="0"
                        style="width: 100%; height: 750px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn bg-primary btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Source-->
    <div class="modal fade" id="modalSource" tabindex="-1" role="dialog" aria-labelledby="modalSourceLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSourceLabel">Source management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ route('modal.source') }}" frameborder="0"
                        style="width: 100%; height: 750px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn bg-primary btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Related article -->
    <div class="modal fade" id="modalRelated" tabindex="-1" role="dialog" aria-labelledby="modalRelatedLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRelatedLabel">Related article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ route('modal.related') }}" frameborder="0"
                        style="width: 100%; height: 750px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn bg-primary btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Topic -->
    <div class="modal fade" id="modalTopic" tabindex="-1" role="dialog" aria-labelledby="modalTopicLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTopicLabel">Topic management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ route('modal.topic') }}" frameborder="0"
                        style="width: 100%; height: 750px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn bg-primary btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    @push('custom-scripts')
        <script src="{{ url('/') }}/build/public/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="{{ url('assets/AdminLTE') }}/plugins/select2/js/select2.min.js" referrerpolicy="origin"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

        <script>
            tinymce.init({
                selector: 'textarea',
                skin: 'oxide',
                promotion: false,
                plugins: 'image link code media preview lists table',
                toolbar1: 'styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist table'
            });

            $(document).ready(function() {
                $('#select2Rubrik').select2({
                    theme: "bootstrap4",
                    // allowClear: true
                });
                $('.select2-multiple').select2({
                    theme: "bootstrap4",
                    templateSelection: formatState,
                    // allowClear: true
                });
            });


            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<span><span class="text-white"></span></span>'
                );
                $state.find("span").text(state.text);
                return $state;
            }

            $('#description').on('keyup', () => {
                count_word_description();
            })

            function count_word_description() {
                let desc_len = $('#description').val().length
                $('#counter_word_description').text(140 - desc_len)
            }
        </script>
    @endpush
</x-app-layout>
