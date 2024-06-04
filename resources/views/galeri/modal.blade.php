<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .image-checkbox {
            cursor: pointer;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border: 4px solid transparent;
            outline: 0;
        }

        .image-checkbox input[type="checkbox"] {
            display: none;
        }

        .image-checkbox-checked {
            border-color: #f58723;
        }

        .image-checkbox:hover .caption {
            opacity: 1;
        }
    </style>

</head>

<body>
    <div class="card">
        <div class="card-header">
            <div data-module="photo/upload" class="form-group float-left">
                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#uploadModal">
                    <i class="fa fa-plus"></i> Upload Files
                </button>
                <a href="{{ route('galeri.modal', ['id' => $galery->galery_id]) }}" class="btn btn-default btn-sm"><i
                        class="fa fa-reload"></i>
                    Refresh</a>
            </div>
            <div class="float-right">
                <form action="{{ route('galeri.modal', ['id' => $galery->galery_id]) }}">
                    @csrf
                    <div class="form-inline">
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <input id="input_search" type="search" class="form-control input-sm"
                                placeholder="Search..." name="q" value="{{ !empty($q) ? $q : '' }}">
                            <button class="btn"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="{{ route('galeri.collection.insert') }}">
                @csrf
                <div class="row">
                    @foreach ($photos as $photo)
                        @if (!in_array($photo->image_id, $collections))
                            <div class="col-3 text-xs-center mb-2 border p-1"
                                style="height: 150px; position: relative; padding: 10px;">
                                <label class="image-checkbox" style="height: 100%; width:100%; display: block;">
                                    <img style="height: 100%; width:100%;" class="img border rounded" loading="lazy"
                                        src="{{ Storage::url('public/photos/' . $photo->asset->file_name) }}" />
                                    <input type="checkbox" name="files[]" value="{{ $photo->image_id }}" />
                                    <input type="hidden" name="type" value="image" />
                                    <input type="hidden" name="galery_id" value="{{ $galery->galery_id }}" />
                                    <div class="caption"
                                        style="position: absolute; bottom: 8px; right: 8px; left: 8px; background: rgba(0, 0, 0, 0.5); color: white; padding: 5px; maargin: 10px; text-align: center;">
                                        <small>{{ substr($photo->caption, 0, 28) }}...</small><br>
                                    </div>
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    {{ $photos->links('vendor.pagination.bootstrap-4') }}
                </div>

                <div class="card-footer">
                    <div class="form-group p-0 mt-3">
                        <button id="btn_submit" class="btn btn-sm m-1 bg-primary float-right"
                            type="submit">Upload</button>
                        <button class="btn btn-sm m-1 bg-danger float-right" data-dismiss="modal"
                            type="button">Batal</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>


    @php
        $modalTitle = 'Upload photo';
    @endphp
    <x-bs-modal id="uploadModal" :title="$modalTitle">
        <form method="post" enctype="multipart/form-data" action="{{ route('assets.photo.browse.upload') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group p-0 mb-1">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" name="photo" id="photo">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="caption">Caption</label>
                    <input type="text" class="form-control" name="caption" id="caption">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="credit">Credit</label>
                    <input type="text" class="form-control" name="credit" id="credit">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" id="author">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="source">Source</label>
                    <input type="text" class="form-control" name="source" id="source">
                </div>


                <div class="form-group p-0 mt-3">
                    <button id="uploadBtn" class="btn btn-sm m-1 bg-primary float-right"
                        type="submit">Upload</button>
                    <button class="btn btn-sm m-1 bg-danger float-right" data-dismiss="modal"
                        type="button">Batal</button>
                </div>
            </div>
        </form>
    </x-bs-modal>
    <!-- jQuery -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assets/AdminLTE') }}/dist/js/adminlte.min.js"></script>


    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            $('#uploadBtn').on('click', function() {
                console.log('ok')
                var button = this;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            });

            $('#btn_submit').on('click', function() {
                var button = this;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            });
            @if (session()->has('success') && session()->get('success') == 'success')
            window.parent.postMessage('refresh', '*');
            @endif

            jQuery(function($) {
                // init the state from the input
                $(".image-checkbox").each(function() {
                    if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                        $(this).addClass('image-checkbox-checked');
                    } else {
                        $(this).removeClass('image-checkbox-checked');
                    }
                });

                // sync the state to the input
                $(".image-checkbox").on("click", function(e) {
                    if ($(this).hasClass('image-checkbox-checked')) {
                        $(this).removeClass('image-checkbox-checked');
                        $(this).find('input[type="checkbox"]').first().removeAttr("checked");
                    } else {
                        $(this).addClass('image-checkbox-checked');
                        $(this).find('input[type="checkbox"]').first().attr("checked", "checked");
                    }

                    e.preventDefault();
                });
            });
        });
    </script>
