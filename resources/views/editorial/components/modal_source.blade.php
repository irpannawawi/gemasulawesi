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
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addsourceModal">Tambah data</button>
            <a class="btn border btn-xs" href="{{ $_SERVER['REQUEST_URI'] }}"><i class="fa fa-sync"></i> Refresh</a>
            <div class="col-3 float-right">
                <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formSearch">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="q"
                            aria-label="Search" value="{{ !empty($q) ? $q : '' }}" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <button class="input-group-text btn btn-default" id="basic-addon1"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive no-margin">
                <table class="table table-striped datatables">
                    <thead>
                        <tr>
                            <th style="width: 10%;">#</th>
                            <th style="width: 10%;">No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($sources as $source)
                            <tr>
                                <td>
                                    <input onchange="check_sources(this, {{ $source->source_id }}, '{{ $source->source_name }}')"
                                        type="checkbox" name="sourceSelection[]" class="" value="1">
                                </td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $source->source_name }}</td>
                                <td>
                                    <button class="btn btn-default " data-toggle="modal" data-target="#editsourceModal"
                                        onclick="edit_source('{{ $source->source_id }}', '{{ $source->source_name }}', '{{ $source->source_alias }}', '{{ $source->source_website }}', '{{ $source->source_logo_url }}')"><i
                                            class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger bg-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        {{-- Modals add sources --}}

        <div class="modal fade" id="addsourceModal" tabindex="-1" role="dialog" aria-labelledby="addsourceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addsourceModalLabel">Tambah data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sources.add') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="sourceName">Name <sup>* </sup></label>
                                <input type="text" id="sourceName" name="source_name" class="form-control" required
                                    autocomplete="off" >
                            </div>
                            <div class="form-group mb-2">
                                <label for="sourcealias">Alias</label>
                                <input type="text" id="sourcealias" name="source_alias" class="form-control" 
                                    autocomplete="off" >
                            </div>
                            <div class="form-group mb-2">
                                <label for="sourcewebsite">Website</label>
                                <input type="text" id="sourcewebsite" name="source_website" class="form-control" 
                                    autocomplete="off" >
                            </div>
                            <div class="form-group mb-2">
                                <label for="sourcelogo_url">Logo url</label>
                                <input type="url" id="sourcelogo_url" name="source_logo_url" class="form-control" 
                                    autocomplete="off" >
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

        {{-- Modal edit source --}}
        <div class="modal fade" id="editsourceModal" tabindex="-1" role="dialog" aria-labelledby="editsourceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editsourceModalLabel">Ubah data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sources.edit') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group mb-2">
                                <label for="source">Name <sup>*</sup></label>
                                <input type="text" name="source_name" class="form-control" required autocomplete="off" id="input-source-name">
                                <input type="hidden" name="source_id" class="form-control" required autocomplete="off"
                                    id="input-source-id">
                            </div>
                            <div class="form-group mb-2">
                                <label for="sourcealias">Alias</label>
                                <input type="text" name="source_alias" class="form-control"  autocomplete="off" id="input-source-alias">
                            </div>
                            <div class="form-group mb-2">
                                <label for="sourcewebsite">Website</label>
                                <input type="text" name="source_website" class="form-control"  autocomplete="off" id="input-source-website">
                            </div>
                            <div class="form-group mb-2">
                                <label for="sourcelogo">Logo</label>
                                <input type="text" name="source_logo" class="form-control"  autocomplete="off" id="input-source-logo">
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
            // check or uncheck sources
            function check_sources(elm, id, text) {
                var data = {
                    id: id,
                    text: text
                };

                var newOption = new Option(data.text, data.id, true, true);
                $('#select2Source', window.parent.document).append(newOption).trigger('change');

                if ($(elm, window.parent.document).is(':checked')) {
                    // add to selected 
                    let last_value = $('#select2Source', window.parent.document).val();
                    last_value.push(id);
                    console.log(last_value)
                } else {
                    // remove from selected
                    alert('uncheck')
                }
                $('#select2Source', window.parent.document).trigger('change');
            }

            function edit_source(id, name, alias, web, logo) {
                $('#input-source-name').val(name)
                $('#input-source-alias').val(alias)
                $('#input-source-website').val(web)
                $('#input-source-logo').val(logo)
                $('#input-source-id').val(id)
            }
        </script>
</body>

</html>
