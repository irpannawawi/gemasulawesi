@push('extra-css')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  --}}


<link rel="stylesheet" href="{{url('assets/AdminLTE')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{url('assets/AdminLTE')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body" style="min-height: 400px">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" placeholder="Enter title ...">
                        <span class="badge badge-info">200 Character</span>

                    </div>
                    <div class="form-group">
                        <label for="content"><i class="mdi mdi-content-copy:"></i></label>
                        <textarea class="editor" name="content" id="content" class="form-control" cols="2"></textarea>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="form-group p-1">
                        <label for="rubruk">Rubrik</label>
                        <select class="form-control select2-single" id="select2Rubrik" >
                            <option value="Rubrik1" >Rubrik1</option>
                            <option value="Rubrik2">Rubrik2</option>
                            <option value="Rubrik3">Rubrik3</option>
                            <option value="Rubrik4">Rubrik4</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descriptions">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                        <span class="badge badge-info">140 Character</span>
                    </div>

                    {{-- Tags input --}}
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <select class="form-control select2" id="select2Tag" multiple>
                            <option value="Sample Tag 1" >Sample Tag 1</option>
                            <option value="Sample Tag 2">Sample Tag 2</option>
                            <option value="Sample Tag 3">Sample Tag 3</option>
                            <option value="Sample Tag 4">Sample Tag 4</option>
                        </select>
                    </div>
                    {{-- ./Tags input --}}


                    {{-- Source input --}}
                    <div class="form-group">
                        <label for="select2Source">Source</label>
                        <select class="form-control select2" id="select2Source" multiple>
                            <option value="Sample Source 1" >Sample Source 1</option>
                            <option value="Sample Source 2">Sample Source 2</option>
                            <option value="Sample Source 3">Sample Source 3</option>
                            <option value="Sample Source 4">Sample Source 4</option>
                        </select>
                    </div>
                    {{-- ./Source input --}}

                    
                    {{-- Author input --}}
                    <div class="form-group">
                        <label for="select2Author">Author</label>
                        <select class="form-control select2" id="select2Author" multiple>
                            <option value="Sample Author 1" >Sample Author 1</option>
                            <option value="Sample Author 2">Sample Author 2</option>
                            <option value="Sample Author 3">Sample Author 3</option>
                            <option value="Sample Author 4">Sample Author 4</option>
                        </select>
                    </div>
                    {{-- ./Author input --}}

                    
                    {{-- Topic input --}}
                    <div class="form-group">
                        <label for="select2Topic">Topic</label>
                        <select class="form-control select2" id="select2Topic" multiple>
                            <option value="Sample Topic 1" >Sample Topic 1</option>
                            <option value="Sample Topic 2">Sample Topic 2</option>
                            <option value="Sample Topic 3">Sample Topic 3</option>
                            <option value="Sample Topic 4">Sample Topic 4</option>
                        </select>
                    </div>
                    {{-- ./Topic input --}}


                </div>
            </div>
        </div>
    </div>


    {{-- modals --}}


    @push('custom-scripts')
    <script src="{{ url('/') }}/build/public/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ url('assets/AdminLTE') }}/plugins/select2/js/select2.min.js" referrerpolicy="origin"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

        <script>
            tinymce.init({
                selector: '.editor',
                skin: 'oxide',
                promotion: false,
                plugins: 'image link code media preview lists table',
                toolbar1: 'styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist table',
                toolbar2: ' code preview | link  dialog-insert-image media',
                setup: (editor) => {
                    editor.ui.registry.addButton('dialog-insert-image', {
                        icon: 'image',
                        onAction: () => editor.windowManager.openUrl({
                            title: 'Just a title',
                            url: "{{ url('/browse') }}",
                            width: 720,
                            height: 480,
                        })
                    })
                }
            });

            $(document).ready(function() {
                $('#select2Rubrik').select2({
                    theme: "bootstrap4",
                    allowClear: true
                });
                $('.select2').select2({
                    theme: "bootstrap4",
                    allowClear: true
                });
            });


        </script>
    @endpush
</x-app-layout>
