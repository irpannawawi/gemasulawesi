<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="card" data-widget="iframe">
        <div class="card-header">
            <a class="btn border btn-xs" href="{{ $_SERVER['REQUEST_URI'] }}"><i class="fa fa-sync"></i> Refresh</a>
            <div class="col-6 float-right">
                <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formSearch">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group-append">
                                <select name="rubrik" id="rubrikSelect" class="form-control">
                                    @php
                                        $rubriks = \App\Models\Rubrik::all();
                                    @endphp
                                        <option {{@$rubrikId==''?'selected':''}} value="">All</option>
                                    @foreach ($rubriks as $rubrik)
                                        <option {{@$rubrikId==$rubrik->rubrik_id?'selected':''}} value="{{$rubrik->rubrik_id}}">{{$rubrik->rubrik_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q"
                                    aria-label="Search" value="{{ !empty($q) ? $q : '' }}" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <button class="input-group-text btn btn-default" id="basic-addon1"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <h5>Pagination here</h5>
            </div>
            <div class="card-body no-padding">
                <div class="table-responsive no-margin">
                    <table class="table table-striped table-sm table-bordered" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Rubrik</th>
                                <th>Penulis</th>
                                <th>Editor</th>
                                <th>Published Date</th>

                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>{{ $post->rubrik->rubrik_name }}</td>
                                    <td>{{ $post->author->display_name }}</td>
                                    <td>{{ $post->editor->display_name }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <button class="btn btn-default btn-sm" onclick="sendBacaJuga('{{ $post->title }}', 'https:\/\/{{$_SERVER['SERVER_NAME']}}/id/{{str_replace(' ','-',$post->rubrik->rubrik_name)}}/{{$post->post_id}}/{{$post->slug}}')">Choose</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-2">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
    @php
        $modalTitle = 'Upload photo';
    @endphp
    <x-bs-modal id="uploadModal" :title="$modalTitle">
        <form method="post" enctype="multipart/form-data" action="{{ route('assets.photo.upload') }}">
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
                    <button class="btn btn-sm m-1 bg-primary float-right" type="submit">Upload</button>
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


    <script>
       $('#rubrikSelect').on('change', function(){
        $('#formSearch').submit()
       })
        // insert image 
        function sendBacaJuga(title, url) {
            window.parent.postMessage({
                mceAction: 'insertHTML',
                data: {
                    title: title,
                    url: url
                }
            }, "*")
        }

    </script>
</body>

</html>
