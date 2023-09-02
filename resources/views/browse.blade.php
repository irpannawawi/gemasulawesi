<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/dist/css/adminlte.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="card">
        <div class="card-header">
            <div data-module="photo/upload" class="form-group float-left">
                <button class="btn btn-sm btn-default">
                    <i class="fa fa-plus"></i> Upload Files <input type="file" id="imagefiles"
                        name="imagefiles[]" style="display: none !important;" multiple="">
                </button>
                <a href="{{ route('assets.photo.index') }}" class="btn btn-default btn-sm"><i
                        class="fa fa-reload"></i> Refresh</a>
            </div>
            <div class="float-right">
                <div class="form-inline">
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <input id="input_search" type="text" class="form-control input-sm"
                            placeholder="Search..."
                            data-url="https://editor.promediateknologi.id/photo/index" data-query-string=""
                            value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <h5>Pagination here</h5>
            </div>
            <div class="row box-photo-upload">
                <div class="row">
                    @for ($i = 0; $i < 15; $i++)
                        <div id="photo-7381762" class="photo-list float-left">
                            <div style="margin-left:15px;margin-bottom:15px;position:relative">
                                <div class="img-thumbnail overlay-wrapper">
                                    <img src="https://picsum.photos/200" alt="" title=""
                                        class="img-responsive" style="width:214px;height:95px">
                                    <div style="margin-top:5px">
                                        <small title="">&nbsp;</small><br>
                                        <small title="Uploader"><b>by: Uploader</b></small>
                                        <br><small title="Zona Bandung">Author Name</small>
                                        <div class="float-right">
                                            <button type="button" class="btn btn-xs btn-default btn-edit"
                                                data-id="7381762" title="Use/Edit"><i class="fa fa-edit"
                                                    aria-hidden="true"></i>
                                            </button><button type="button"
                                                class="btn btn-xs btn-danger text-white bg-danger btn-hapus"
                                                data-src="https://picsum.photos/200" data-id="7381762"
                                                title="Delete"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="imagedata" style="display:none">
                                {"id":7381762,"caption":"","author":"","source":"","credit":"","src":"https:\/\/assets-e.promediateknologi.id\/photo\/p1\/120\/2023\/08\/25\/photostudio_1692978514289-877277862.jpg","crop":"","watermark":0,"status":1,"site_id":120,"created_date":"2023-08-25
                                22:48:47","modified_date":"2023-08-25
                                22:48:47","created_by":"4488","modified_by":""}
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="row mt-2">
                <h5>Pagination here</h5>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assets/AdminLTE') }}/dist/js/adminlte.min.js"></script>

</body>

</html>
