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
            <div class="row">
                <div class="col-5">
                    <img src="{{ Storage::url('photos/' . $image->asset->file_name) }}" alt="">
                </div>
                <div class="col">
                    <form method="post" enctype="multipart/form-data"
                        action="{{ route('assets.photo.updateTinymce') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group p-0 mb-1">
                                <label for="caption">Caption</label>
                                {{-- <input type="text" value="{{ $image->image_id }}" name="image_id" /> --}}
                                <input type="text" class="form-control" value="{{ $image->caption }}" name="caption"
                                    id="caption">
                            </div>
                            <div class="form-group p-0 mb-1">
                                <label for="credit">Credit</label>
                                <input type="text" class="form-control" value="{{ $image->credit }}" name="credit"
                                    id="credit">
                            </div>
                            <div class="form-group p-0 mb-1">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" value="{{ @$image->author }}"
                                    name="author" id="author">
                            </div>
                            <div class="form-group p-0 mb-1">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" value="{{ $image->source }}" name="source"
                                    id="source">
                            </div>
                            <div class="form-group p-0 mt-3">
                                <button class="btn btn-sm m-1 bg-primary float-right" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @php
        $modalTitle = 'Upload photo';
    @endphp
    {{-- <x-bs-modal id="uploadModal" :title="$modalTitle"> --}}

    {{-- </x-bs-modal> --}}
    <!-- jQuery -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assets/AdminLTE') }}/dist/js/adminlte.min.js"></script>


    <script>
        // insert image 
        function sendImageData(id, url) {
            console.log({
                id: id,
            })
            window.parent.postMessage({
                mceAction: 'insertImage',
                data: {
                    imageUrl: url,
                    imageId: id
                }
            }, "*")
        }

        window.addEventListener('message', (event) => {
            var data = event.data;

            // Do something with the data received here
            console.log('message received from TinyMCE', data);
        });
        // insert image 
        @if(Session::has('msg'))
           sendImageData("{{Session::get('image_id')}}","{{Session::get('image_url')}}") 
        @endif
    </script>
</body>

</html>
