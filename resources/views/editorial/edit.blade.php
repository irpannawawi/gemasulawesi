@push('extra-css')
    <style>
        .form-group {
            padding: 0px 0px 0px 20px;
            margin: 25px 0px 0px 0px;
        }

        .card-body {
            font-size: 14px;
            padding: 5px;
        }
    </style>
    @vite('resources/js/select2.js')
    @vite('resources/js/tempus.js')
    {{-- <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
    <!-- Tempus Dominus Bootstrap CSS -->
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            {{ __('Edit Article') }}
        </h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <li>Error:</li>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </x-slot>
 
    <div class="card">
        <form id="article-form" method="POST" action="{{ route('editorial.update', ['id' => $post->post_id]) }}">
            @csrf
            {{-- POST IMAGE --}}
            <input type="hidden" id="postImage" name="post_image" value="{{ $post->post_image }}">
            <div class="card-body" style="min-height: 400px">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" value="{{ $post->title }}" maxlength="140" name="title"
                                class="form-control" placeholder="Enter title ...">
                            <span class="badge badge-info">140 Character</span>

                        </div>
                        <div class="form-group">
                            <label for="content"><i class="mdi mdi-content-copy:"></i></label>
                            <textarea class="editor" name="content" id="content" class="form-control" cols="2" rows="50">@if($post->image)<img src="{{ url('/') . '/storage/photos/' . $post->image->asset->file_name }}" data-source={{$post->image->image_sc_type}} data-id="{{ $post->image->image_id }}" />@endif{!! $post->article !!}</textarea>
                        </div>

                        {{-- Related input --}}
                        <div class="form-group">
                              
                            <label>Related article</label>
                            <select class="form-control select2-multiple" id="select2Related" name="related[]" multiple>
                                @if ($post->related_articles != 'null' && $post->related_articles != null)
                                @foreach (json_decode($post->related_articles) as $article)
                                        @php
                                            $articleData = App\Models\Posts::find($article);
                                        @endphp
                                        <option value="{{ $article }}" selected>{{ $articleData->title }}</option>
                                    @endforeach
                                @endif
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
                                    <option {{ $post->rubrik->rubrik_name == $rubrik->rubrik_name ? 'selected' : '' }}
                                        value="{{ $rubrik->rubrik_id }}">{{ $rubrik->rubrik_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descriptions">Description</label>
                            <textarea maxlength="140" name="description" id="description" class="form-control" onchange="count_word_description()"
                                required>{{ $post->description }}</textarea>
                            <span class="badge badge-info"><span id="counter_word_description">140</span> Character
                                left</span>
                        </div>

                        {{-- Tags input --}}
                        <div class="form-group">
                            <label for="tag">Tag</label>
                            <select class="form-control" id="select2Tag" name="tags[]" multiple>
                                @if ($post->tags != null && $post->tags!='null')
                                    @foreach (json_decode($post->tags) as $tag)
                                        @php
                                            $articleData = App\Models\Tags::find($tag);
                                        @endphp
                                        <option value="{{ $tag }}" selected>{{ $articleData->tag_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                data-target="#modalTags"><i class="fa fa-plus"></i> Add/Select more</button>
                        </div>
                        {{-- ./Tags input --}}


                        {{-- Source input --}}
                        <div class="form-group">
                            <label for="select2Source">Source</label>
                            <select class="form-control" id="select2Source" name="sources[]" multiple>
                                @if ($post->sources != null && $post->sources!='null' && $post->sources != '[]')
                                    @foreach (json_decode($post->sources) as $source)
                                        @php
                                            $articleData = App\Models\Source::find($source);
                                        @endphp
                                        <option value="{{ $source }}" selected>{{ $articleData->source_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                data-target="#modalSource"><i class="fa fa-plus"></i> Add/Select more</button>

                        </div>
                        {{-- ./Source input --}}


                        {{-- Author input --}}
                        <div class="form-group">
                            <label for="select2Author">Penulis</label>
                            <select class="form-control select2-multiple" id="select2Author" name="author" multiple>
                                <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->display_name }}
                                </option>
                            </select>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add/Select
                                more</button>

                        </div>
                        {{-- ./Author input --}}


                        {{-- Topic input --}}
                        <div class="form-group">
                            <label for="select2Topic">Topic</label>
                            <select class="form-control select2-multiple" id="select2Topic" name="topics[]" multiple>
                                @if ($post->topics != null && $post->topics!='null')
                                    @foreach (json_decode($post->topics) as $topic)
                                        @php
                                            $articleData = App\Models\Topic::find($topic);
                                        @endphp
                                        <option value="{{ $topic }}" selected>{{ $articleData->topic_name }}
                                        </option>
                                    @endforeach
                                @endif
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
                        <div class="form-group mb-1 mt-1" id="form-schedule-time" style="display: none">
                            <div class="checkbox">
                                <label>
                                </label>
                                <input type="datetime-local" id="schedule_time" class="form-control" name="schedule_time">
                            </div>
                        </div>
                        
                        <div class="form-group mb-1 mt-1" id="form-published-time">
                            <div class="checkbox">
                                <label>Publish date</label>
                                <input type="datetime-local" id="publish_date" value="{{ Str::replace(' ', 'T', $post->published_at) }}" class="form-control" name="published_at">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary bg-primary" id="publishBtn" type="submit"><i
                        class="fa fa-paper-plane"></i>
                    Update</button>

                <input type="hidden" id="isDraft" name="is_draft">
                <button id="saveDraft" class="btn btn-secondary bg-secondary" type="button"><i
                        class="fa fa-save"></i>
                    Simpan ke draft</button>
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
                    <iframe loading="lazy" src="{{ route('modal.tags') }}" frameborder="0"
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
                    <iframe loading="lazy" src="{{ route('modal.source') }}" frameborder="0"
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
                    <iframe loading="lazy" src="{{ route('modal.related') }}" frameborder="0"
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
                    <iframe loading="lazy" src="{{ route('modal.topic') }}" frameborder="0"
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
        <script defer src="{{ url('assets/AdminLTE') }}/plugins/select2/js/select2.min.js" referrerpolicy="origin"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
        @vite('resources/js/select2.js')

        <script defer>
            const configBacaJuga = {
                title: 'Baca Juga',
                url: "{{ url('/browse_baca_juga') }}",
                width: 720,
                height: 480,
                onMessage: (instance, data) => {
                    tinymce.activeEditor.execCommand('insertHTML', false,
                        `<p class="baca-juga"><strong>Baca Juga: <br /><a href="${data.data.url}" >${data.data.title}</a></strong></p>`);
                    instance.close();
                }
            };

            const configEditImage = {
                title: 'Edit Image',
                url: "",
                width: 720,
                height: 480,
                onMessage: (instance, data) => {
                    $('#postImage').val(data.data.imageId)
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
                        showDialog(element.src, element.dataset.id, element.dataset.source);
                    }
                });

                // Fungsi untuk menampilkan dialog khusus
                function showDialog(imageSrc, dataId, source) {
                    // Logika untuk menampilkan dialog sesuai kebutuhan
                    // Gunakan library atau framework tertentu jika diperlukan
                    url = "{{ url('/browse_edit_image/') }}"
                    configEditImage.url = url + '/' + dataId + '/' + source
                    editor.windowManager.openUrl(configEditImage);
                }
            });

            tinymce.init({
                contextmenu: false,
                selector: '.editor',
                skin: 'oxide',
                // =========== autosave tinymce ====================

                autosave_interval: '10s', // Ubah interval sesuai kebutuhan Anda
                autosave_restore_when_empty: true,
                autosave_ask_before_unload: false,
                autosave_retention: 'localStorage', // Opsional, defaultnya adalah 'localStorage'

                // =========== ./autosave tinymce ====================

                promotion: false,
                fullscreen_native: true,
                plugins: 'autosave image link code media preview lists table customEditImage fullscreen',
                toolbar1: 'removeformat styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist table fullscreen',
                toolbar2: ' code preview | link  dialog-insert-image media dialog-insert-baca-juga | restoredraft',
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
                                    $('#postImage').val(data.data.imageId)
                                    const imgHtml =
                                        `<img src="${data.data.imageUrl}" data-source="${data.data.source}" data-id="${data.data.imageId}" />`;
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
                },
                // fungsi lain
            });



            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $('<span><span class="text-white"></span></span>');
                $state.find("span").text(state.text);
                return $state;
            }

            
            document.addEventListener("DOMContentLoaded",()=>{
                $('#description').on('keyup', () => {
                    count_word_description();
                });
    
                function count_word_description() {
                    let desc_len = $('#description').val().length;
                    $('#counter_word_description').text(140 - desc_len);
                }
                $('#saveDraft').on('click', (event) => {
                    event.preventDefault();
                    localStorage.removeItem('tinymce-autosave-/editorial/create-content-time')
                    localStorage.removeItem('tinymce-autosave-/editorial/create-content-draft')
                    $('#isDraft').val('1')
                    $('#article-form').submit()
                })
    
                $('#publishBtn').on('click', (event) => {
                    event.preventDefault();
                    // Mengambil nilai dari textarea dengan id 'description'
                    const descriptionValue = $('#description').val();
    
                    // Memeriksa panjang karakter
                    if (descriptionValue.length < 100 || descriptionValue.length > 140) {
                        // Menampilkan pesan kesalahan jika tidak memenuhi persyaratan
                        alert('Description harus memiliki panjang antara 100 dan 140 karakter.');
                        return; // Menghentikan proses lebih lanjut jika tidak memenuhi persyaratan
                    }
    
                    localStorage.removeItem('tinymce-autosave-/editorial/create-content-time')
                    localStorage.removeItem('tinymce-autosave-/editorial/create-content-draft')
                    $('#article-form').submit()
                })

                // schedule time
                var checkbox_schedule = $('#schedule')
                var form_schedule = $('#form-schedule-time')
                checkbox_schedule.on('change', (event) => {
                    if (event.currentTarget.checked) {
                        form_schedule.show()
                        $('#saveDraft').hide()
                    } else {
                        form_schedule.val('')
                        $('#saveDraft').show()
                        form_schedule.hide()
                    }
                })
                // Select 2
                $('#select2Rubrik').select2({
                    theme: "bootstrap4",
                    // allowClear: true
                });

                $('.select2-multiple').select2({
                    theme: "bootstrap4",
                    templateSelection: formatState,
                    // allowClear: true
                });

                $('#select2Tag').select2({
                    theme: "bootstrap4",
                    templateSelection: formatState,
                    placeholder: 'Pilih Tag',
                    ajax: {
                        url: '/api/tags',
                        dataType: 'json',
                        processResults: function(data) {
                            return {
                                results: $.map(data.tags, function(tag) {
                                    return {
                                        id: tag.tag_id,
                                        text: tag.tag_name
                                    };
                                })
                            };
                        }
                    }
                });


                $('#select2Source').select2({
                    theme: "bootstrap4",
                    templateSelection: formatState,
                    placeholder: 'Pilih Source',
                    ajax: {
                        url: '/api/sources',
                        dataType: 'json',
                        processResults: function(data) {
                            return {
                                results: $.map(data.sources, function(source) {
                                    return {
                                        id: source.source_id,
                                        text: source.source_name
                                    };
                                })
                            };
                        }
                    }
                });


                $('#select2Related').select2({
                    theme: "bootstrap4",
                    templateSelection: formatState,
                    placeholder: 'Pilih Artikel',
                    ajax: {
                        url: '/api/related',
                        dataType: 'json',
                        processResults: function(data) {
                            return {
                                results: $.map(data.posts, function(post) {
                                    return {
                                        id: post.post_id,
                                        text: post.title
                                    };
                                })
                            };
                        }
                    }
                });
                $('#select2Topic').select2({
                    theme: "bootstrap4",
                    templateSelection: formatState,
                    placeholder: 'Pilih Topic',
                    ajax: {
                        url: '/api/topics',
                        dataType: 'json',
                        processResults: function(data) {
                            return {
                                results: $.map(data.topics, function(topic) {
                                    return {
                                        id: topic.topic_id,
                                        text: topic.topic_name
                                    };
                                })
                            };
                        }
                    }
                });

            });
        </script>
    @endpush
</x-app-layout>
