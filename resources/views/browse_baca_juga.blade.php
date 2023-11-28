
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
        <div class="card" data-widget="iframe">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <div class="float-right">
                    <div class="form-inline">
                        <div class="form-group">
    
                        </div>
                        <a class="btn border btn-xs" href="{{$_SERVER['PHP_SELF']}}"><i class="fa fa-sync"></i> Refresh</a>
                        <div class="col-3 float-right">
                            <form action="{{$_SERVER['PHP_SELF']}}">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="q"
                                        aria-label="Search" value="{{ !empty($q) ? $q : '' }}" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <h5>Pagination here</h5>
                </div>
                <div class="card-body no-padding">
                    <div class="table-responsive no-margin">
                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Rubrik</th>
                                    <th>Author</th>
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
                                        <td>{{ $post->category }}</td>
                                        <td>{{ $post->author->display_name }}</td>
                                        <td>{{ $post->editor->display_name }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <button class="btn btn-default btn-sm" onclick="sendBacaJuga('{{$post->title}}', '{{ route('singlePost', [
                                                'rubrik' => $post->rubrik->rubrik_name,
                                                'post_id' => $post->post_id,
                                                'slug' => $post->slug,
                                            ]) }}')">Choose</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-2">
                    {{$posts->links('vendor.pagination.bootstrap-4')}}
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
