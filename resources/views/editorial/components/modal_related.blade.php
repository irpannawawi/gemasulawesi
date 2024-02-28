<!DOCTYPE html>
<html lang="id">

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
                <table class="table table-sm">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>No</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Rubrik</th>
                            <th>Penulis</th>
                            <th>Editor</th>
                            <th>Date Created</th>
                            <th>Date Published</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $n = 1;
                        @endphp
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <input onchange="check_related(this, {{ $post->post_id }}, '{{ $post->title }}')"
                                        type="checkbox" name="relatedSelection[]" id="{{$post->post_id}}" class="" value="1">
                                </td>
                                <td>{{ $n++ }}</td>
                                <td class="text-left">{{ $post->title }}</td>
                                <td><span class="badge badge-success">{{ $post->status }}</span></td>
                                <td><span class="badge badge-secondary">{{ $post->rubrik->rubrik_name }}</span></td>
                                <td>{{ $post->author->display_name }}</td>
                                <td>{{ $post->editor->display_name }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->published_at }}</td>
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
            // check or uncheck posts
            function check_related(elm, id, text) {
                var data = {
                    id: id,
                    text: text
                };

                var newOption = new Option(data.text, data.id, true, true);
                $('#select2Related', window.parent.document).append(newOption).trigger('change');

                if ($(elm, window.parent.document).is(':checked')) {
                    // add to selected 
                    let last_value = $('#select2Related', window.parent.document).val();
                    last_value.push(id);
                    console.log(last_value)
                } else {
                    // remove from selected
                    $('#select2Related option[value="'+id+'"]', window.parent.document).remove();

                }
                $('#select2Related', window.parent.document).trigger('change');
            }

            function has_value_check(){
                last_value_data =  $('#select2Related', window.parent.document).val();
                last_value_data.forEach(function(item, index){
                    elm = $('#'+item)
                    console.log(elm.prop('checked', true))
                })
            }
            has_value_check()

            function edit_post(id, name, alias, web, logo) {
                $('#input-post-name').val(name)
                $('#input-post-alias').val(alias)
                $('#input-post-website').val(web)
                $('#input-post-logo').val(logo)
                $('#input-post-id').val(id)
            }
            
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
