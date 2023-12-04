<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Theme style -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>
    <div class="card" data-widget="iframe">
        <div class="card-header">
            {{-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addpostModal">Tambah data</button> --}}
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
                                    <option {{ @$rubrikId == '' ? 'selected' : '' }} value="">All</option>
                                    @foreach ($rubriks as $rubrik)
                                        <option {{ @$rubrikId == $rubrik->rubrik_id ? 'selected' : '' }}
                                            value="{{ $rubrik->rubrik_id }}">{{ $rubrik->rubrik_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q"
                                    aria-label="Search" value="{{ !empty($q) ? $q : '' }}"
                                    aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <button class="input-group-text btn btn-default" id="basic-addon1"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive no-margin">
                <table class="table table-striped table-borderd table-sm datatable" style="width: 100%;">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Rubrik</th>
                            <th>Author</th>
                            <th>Editor</th>
                            <th>Date Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $n = 1;
                        @endphp
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td class="text-left">{{ $post->title }}</td>
                                <td><span class="badge badge-secondary">{{ $post->rubrik->rubrik_name }}</span></td>
                                <td>{{ $post->author->display_name }}</td>
                                <td>{{ $post->editor->display_name }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button"
                                            onclick="sendMessage('{{ $post->post_id }}', '{{ $post->title }}')"
                                            class="btn btn-sm btn-default" data-dismiss="modal">Choose</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>


        <!-- jQuery -->
        <script src="{{ url('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('assets/AdminLTE') }}/dist/js/adminlte.min.js"></script>

        <script>
            function sendMessage(id, title) {
                message = {
                    id: id,
                    title: title
                }
                console.log(message)
                window.parent.postMessage(message, '*');
            }
        </script>
</body>

</html>
