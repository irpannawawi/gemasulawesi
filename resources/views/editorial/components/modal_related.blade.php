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
                            <th>Author</th>
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
                                        type="checkbox" name="relatedSelection[]" class="" value="1">
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
            {{$posts->links('vendor.pagination.bootstrap-4')}}
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
                    alert('uncheck')
                }
                $('#select2Related', window.parent.document).trigger('change');
            }

            function edit_post(id, name, alias, web, logo) {
                $('#input-post-name').val(name)
                $('#input-post-alias').val(alias)
                $('#input-post-website').val(web)
                $('#input-post-logo').val(logo)
                $('#input-post-id').val(id)
            }
        </script>
</body>

</html>
