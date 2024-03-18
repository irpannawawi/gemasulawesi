<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-check-square"></i> {{ __('Tags Management') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="card" data-widget="iframe">
                <div class="card-header">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addTagModal">Tambah data</button>
                    <a class="btn border btn-xs" href="{{ route('tags.index') }}"><i class="fa fa-sync"></i> Refresh</a>
                    <div class="col-3 float-right">
                        <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formSearch">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q"
                                    aria-label="Search" value="{{ !empty($q) ? $q : '' }}" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <button class="input-group-text btn btn-default" id="basic-addon1"><i
                                            class="fa fa-search"></i></button>
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
                                    <th style="width: 10%;">No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = !empty(request()->get('page')) ? (request()->get('page') - 1) * $tags->perPage() + 1 : 1;
                                @endphp
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $tag->tag_name }}</td>
                                        <td>
                                            <button class="btn btn-default " data-toggle="modal" data-target="#editTagModal"
                                                onclick="edit_tag('{{ $tag->tag_id }}', '{{ $tag->tag_name }}')"><i
                                                    class="fa fa-edit"></i></button>
                                            <a class="btn btn-danger bg-danger" href="{{ route('tags.destroy', $tag->tag_id) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="float-right">
                                {{ $tags->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
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
                                        <input type="text" name="tag_name" class="form-control" required
                                            autocomplete="off" id="input-Tag-name">
                                        <input type="hidden" name="tag_id" class="form-control" required
                                            autocomplete="off" id="input-Tag-id">
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
                    function check_tags(elm, id, text) {
                        var data = {
                            id: id,
                            text: text
                        };
        
                        var newOption = new Option(data.text, data.id, true, true);
                        $('#select2Tag', window.parent.document).append(newOption).trigger('change');
        
                        if ($(elm, window.parent.document).is(':checked')) {
                            // add to selected 
                            let last_value = $('#select2Tag', window.parent.document).val();
                            last_value.push(id);
                            console.log(last_value)
                        } else {
                            // remove from selected
                            $('#select2Tag option[value="'+id+'"]', window.parent.document).remove();
                        }
                        $('#select2Tag', window.parent.document).trigger('change');
                    }
        
                    function edit_tag(id, name) {
                        $('#input-Tag-name').val(name)
                        $('#input-Tag-id').val(id)
                    }
        
                    function has_value_check(){
                        last_value_data =  $('#select2Tag', window.parent.document).val();
                        last_value_data.forEach(function(item, index){
                            elm = $('#'+item)
                            console.log(elm.prop('checked', true))
                        })
                    }
                    has_value_check()
                </script>
        </div>
    </div>



</x-app-layout>
