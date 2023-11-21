<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-edit"></i>{{ __('Editorial - Published') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary btn-xs" href="{{route('editorial.create')}}"><i
                    class="fa fa-edit"></i>Tambah data</a>

        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Rubrik</th>
                        <th>Author</th>
                        <th>Editor</th>
                        <th>Date Created</th>
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
                            <td><span class="badge badge-success">{{ $post->status }}</span></td>
                            <td><span class="badge badge-secondary">{{ $post->rubrik->rubrik_name }}</span></td>
                            <td>{{ $post->author->display_name }}</td>
                            <td>{{ $post->editor->display_name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('editorial.edit', ['id'=>$post->post_id])}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{route('editorial.delete', ['id'=>$post->post_id])}}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
            <div class="row mt-2">
                {{$posts->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>


    {{-- Modals add rubrik --}}

    <div class="modal fade" id="addRubrikModal" tabindex="-1" role="dialog" aria-labelledby="addRubrikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRubrikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rubrik.add') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="rubrik">Nama rubrik</label>
                            <input type="text" name="rubrik_name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit rubrik --}}
    <div class="modal fade" id="editRubrikModal" tabindex="-1" role="dialog" aria-labelledby="editRubrikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRubrikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rubrik.edit') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="rubrik">Nama rubrik</label>
                            <input type="text" name="rubrik_name" class="form-control" required autocomplete="off" id="input-rubrik-name">
                            <input type="hidden" name="rubrik_id" class="form-control" required autocomplete="off" id="input-rubrik-id">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            function edit_rubrik(id, name) {
                $('#input-rubrik-name').val(name)
                $('#input-rubrik-id').val(id)
            }
        </script>
    @endpush
</x-app-layout>
