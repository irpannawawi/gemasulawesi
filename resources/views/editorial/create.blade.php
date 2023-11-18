@push('extra-css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  --}}


    <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            {{ __('Create Article') }}
        </h2>
    </x-slot>

    <div class="card">
        <form method="POST" action="{{ route('editorial.insert') }}">
            @csrf
            <div class="card-body" style="min-height: 400px">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" maxlength="120" name="title" class="form-control"
                                placeholder="Enter title ...">
                            <span class="badge badge-info">120 Character</span>

                        </div>
                        <div class="form-group">
                            <label for="content"><i class="mdi mdi-content-copy:"></i></label>
                            <textarea class="editor" name="content" id="content" class="form-control" cols="2"></textarea>
                        </div>

                        {{-- Related input --}}
                        <div class="form-group">
                            <label>Related article</label>
                            <select class="form-control select2-multiple" id="select2Related" name="related[]" multiple>
                                <option value="Sample Related article 1">Sample Related article 1</option>
                                <option value="Sample Related article 2">Sample Related article 2</option>
                                <option value="Sample Related article 3">Sample Related article 3</option>
                                <option value="Sample Related article 4">Sample Related article 4</option>
                            </select>

                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                data-target="#modalRelated"><i class="fa fa-plus"></i> Add/Select more</button>
                        </div>
                        {{-- ./Related input --}}

                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group p-1">
                            <label for="rubrik">Rubrik</label>
                            <select class="form-control" id="select2Rubrik" name="rubrik">
                                @foreach ($rubriks as $rubrik)
                                    <option value="{{ $rubrik->rubrik_id }}">{{ $rubrik->rubrik_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descriptions">Description</label>
                            <textarea maxlength="140" name="description" id="description" class="form-control" onchange="count_word_description()"
                                required></textarea>
                            <span class="badge badge-info"><span id="counter_word_description">140</span> Character
                                left</span>
                        </div>

                        {{-- Tags input --}}
                        <div class="form-group">
                            <label for="tag">Tag</label>
                            <select class="form-control select2-multiple" id="select2Tag" name="tags[]" multiple>
                                <option value="Sample Tag 1">Sample Tag 1</option>
                                <option value="Sample Tag 2">Sample Tag 2</option>
                                <option value="Sample Tag 3">Sample Tag 3</option>
                                <option value="Sample Tag 4">Sample Tag 4</option>
                            </select>

                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                data-target="#modalTags"><i class="fa fa-plus"></i> Add/Select more</button>
                        </div>
                        {{-- ./Tags input --}}


                        {{-- Source input --}}
                        <div class="form-group">
                            <label for="select2Source">Source</label>
                            <select class="form-control select2-multiple" id="select2source" name="sources[]" multiple>
                                <option value="Sample Source 1">Sample Source 1</option>
                                <option value="Sample Source 2">Sample Source 2</option>
                                <option value="Sample Source 3">Sample Source 3</option>
                                <option value="Sample Source 4">Sample Source 4</option>
                            </select>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                data-target="#modalSource"><i class="fa fa-plus"></i> Add/Select more</button>

                        </div>
                        {{-- ./Source input --}}


                        {{-- Author input --}}
                        <div class="form-group">
                            <label for="select2Author">Author</label>
                            <select class="form-control select2-multiple" id="select2Author" name="author" multiple>
                                <option value="Sample Author 1" selected>Sample Author 1</option>
                                <option value="Sample Author 2">Sample Author 2</option>
                                <option value="Sample Author 3">Sample Author 3</option>
                                <option value="Sample Author 4">Sample Author 4</option>
                            </select>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add/Select
                                more</button>

                        </div>
                        {{-- ./Author input --}}


                        {{-- Topic input --}}
                        <div class="form-group">
                            <label for="select2Topic">Topic</label>
                            <select class="form-control select2-multiple" id="select2Topic" name="topics[]" multiple>
                            </select>
                            <button type="button" class="btn btn-default btn-sm" data-target="#modalTopic"
                                data-toggle="modal"><i class="fa fa-plus"></i> Add/Select more</button>

                        </div>
                        {{-- ./Topic input --}}

                        {{-- other input --}}
                        <div class="form-group m-0">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="allow_comment" name="allow_comment" value="1">
                                    Allow Comment
                                </label>
                            </div>
                        </div>


                        <div class="form-group m-0">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="view_in_welcome_page" name="view_in_welcome_page"
                                        value="1">
                                    View in welcome page
                                </label>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="schedule" name="schedule" value="1">
                                    Schedule
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary bg-primary" type="submit"><i class="fa fa-paper-plane"></i>
                    Publish</button>
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
            const configBacaJuga = {
                title: 'Baca Juga',
                url: "{{ url('/browse_baca_juga') }}",
                width: 720,
                height: 480,
                onMessage: (instance, data) => {
                    tinymce.activeEditor.execCommand('insertHTML', false,
                        `<p><strong>Baca Juga: <a href="${data.data.url}" >${data.data.title}</a></strong></p>`);
                    instance.close();
                }
            };

            const configEditImage = {
                title: 'Edit Image',
                url: "",
                width: 720,
                height: 480,
                onMessage: (instance, data) => {

                    const imgHtml =
                        `<img data-id="${data.data.imageId}" src="${data.data.imageUrl}" />`;
                    tinymce.activeEditor.execCommand('mceInsertContent', false, imgHtml);

                    instance.close();
                    switch (data.mceAction) {
                        case 'insertImage':
                            break;
                    }
                }
            };

            // Registry plugin
            tinymce.PluginManager.add('customEditImage', function(editor, url) {
                // Logika untuk menangani klik pada gambar
                editor.on('dblclick', function(e) {
                    var element = e.target;

                    // Periksa apakah elemen yang diklik adalah gambar
                    if (element.nodeName === 'IMG') {
                        // Tampilkan dialog khusus di sini
                        showDialog(element.src, element.dataset.id);
                    }
                });

                // Fungsi untuk menampilkan dialog khusus
                function showDialog(imageSrc, dataId) {
                    // Logika untuk menampilkan dialog sesuai kebutuhan
                    // Gunakan library atau framework tertentu jika diperlukan
                    url = "{{ url('/browse_edit_image/') }}"
                    configEditImage.url = url + '/' + dataId
                    editor.windowManager.openUrl(configEditImage);
                }
            });

            tinymce.init({
                selector: '.editor',
                skin: 'oxide',
                autosave_interval: '2s', // Ubah interval sesuai kebutuhan Anda
                autosave_restore_when_empty: true,
                autosave_ask_before_unload: false, 
                autosave_retention: 'localStorage', // Opsional, defaultnya adalah 'localStorage'

                promotion: false,
                plugins: 'autosave image link code media preview lists table customEditImage',
                toolbar1: 'removeformat styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist table',
                toolbar2: ' code preview | link  dialog-insert-image media dialog-insert-baca-juga',
                image_title: true,
                setup: (editor) => {
                    // Insert image
                    editor.ui.registry.addButton('dialog-insert-image', {
                        icon: 'image',
                        onAction: () => {
                            const instanceApi = editor.windowManager.openUrl({
                                title: 'Photos',
                                url: "{{ url('/browse') }}",
                                width: 720,
                                height: 480,
                                onMessage: (instance, data) => {
                                    console.log(data.data)
                                    const imgHtml =
                                        `<img src="${data.data.imageUrl}" data-id="${data.data.imageId}" />`;
                                    tinymce.activeEditor.execCommand('mceInsertContent',
                                        false, imgHtml);

                                    instance.close();
                                    switch (data.mceAction) {
                                        case 'insertImage':
                                            break;
                                    }
                                }
                            });
                        },
                    });


                    function find_image() {
                        // list images 
                        var arr = new Array();
                        $(tinyMCE.activeEditor.dom.getRoot()).find('img').each(
                            function() {
                                console.log($(this).attr("src"));
                            });

                    }


                    // insert baca juga
                    editor.ui.registry.addButton('dialog-insert-baca-juga', {
                        icon: 'new-tab',
                        title: 'Baca Juga',
                        onAction: () => {
                            const instanceApiBacaJuga = editor.windowManager.openUrl(configBacaJuga);
                        },
                    });
                }
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
                var $state = $('<span><span class="text-white"></span></span>');
                $state.find("span").text(state.text);
                return $state;
            }

            $('#description').on('keyup', () => {
                count_word_description();
            });

            function count_word_description() {
                let desc_len = $('#description').val().length;
                $('#counter_word_description').text(140 - desc_len);
            }
        </script>
    @endpush
</x-app-layout>
