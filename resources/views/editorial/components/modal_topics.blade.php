<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>
    <div class="card" data-widget="iframe">
       
        <div class="card-body">
            <div class="table-responsive no-margin">
                <table class="table table-striped datatables">
                    <thead>
                        <tr>
                            <th style="width: 10%;">#</th>
                            <th style="width: 10%;">No</th>
                            <th>Name</th>
                            <th>Ddescription</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($topics as $topic)
                            <tr>
                                <td>
                                    <input onchange="check_topics(this, {{ $topic->topic_id }}, '{{ $topic->topic_name }}')"
                                        type="checkbox" name="topicSelection[]" class="form-control" value="1">
                                </td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $topic->topic_name }}</td>
                                <td>{{ $topic->topic_description }}</td>
                                <td><img src="{{ $topic->topic_image }}" alt="Topik images" class="img-fluid"></td>
                                <td>
                                    <button class="btn btn-default " data-toggle="modal" data-target="#editTopicModal-ds"
                                        onclick="edit_topic('{{ $topic->topic_id }}', '{{ $topic->topic_name }}', '{{ $topic->topic_description }}')"><i
                                            class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger bg-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        {{-- Modals add tags --}}

        <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTagModalLabel">Tambah data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tags.add') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="tagName">Tag</label>
                                <input type="text" id="tagName" name="tag_name" class="form-control" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group mb-2">
                                <button type="button" class="btn bg-secondary btn-secondary"
                                    data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn bg-primary btn-primary">Simpan</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal edit tag --}}
        <div class="modal fade" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="editTagModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTagModalLabel">Tambah data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tags.edit') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group mb-2">
                                <label for="Tag">Nama Tag</label>
                                <input type="text" name="tag_name" class="form-control" required autocomplete="off"
                                    id="input-Tag-name">
                                <input type="hidden" name="tag_id" class="form-control" required autocomplete="off"
                                    id="input-Tag-id">
                            </div>
                            <div class="form-group mb-2">
                                <button type="button" class="btn bg-secondary btn-secondary"
                                    data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn bg-primary btn-primary">Simpan</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="{{ url('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('assets/AdminLTE') }}/dist/js/adminlte.min.js"></script>

        <script>
            // check or uncheck tags
            function check_topics(elm, id, text) {
                var data = {
                    id: id,
                    text: text
                };

                var newOption = new Option(data.text, data.id, true, true);
                $('#select2Topic', window.parent.document).append(newOption).trigger('change');

                if ($(elm, window.parent.document).is(':checked')) {
                    // add to selected 
                    let last_value = $('#select2Topic', window.parent.document).val();
                    last_value.push(id);
                    console.log(last_value)
                } else {
                    // remove from selected
                }
                $('#select2Topic', window.parent.document).trigger('change');
            }

            function edit_tag(id, name) {
                $('#input-Tag-name').val(name)
                $('#input-Tag-id').val(id)
            }
        </script>
</body>

</html>
