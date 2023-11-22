<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Rubrik Management') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addRubrikModal"><i
                    class="fa fa-plus"></i>Tambah data</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Rubrik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($rubriks as $rubrik)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $rubrik->rubrik_name }}</td>
                            <td>
                                <button class="btn btn-info" data-target="#editRubrikModal" data-toggle="modal"
                                    onclick="edit_rubrik('{{ $rubrik->rubrik_id }}','{{ $rubrik->rubrik_name }}')">Edit</button>
                                <a class="btn btn-danger delete-btn"
                                    href="{{ route('rubrik.delete', ['id' => $rubrik->rubrik_id]) }}">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                            <input type="text" name="rubrik_name" class="form-control" required autocomplete="off"
                                id="input-rubrik-name">
                            <input type="hidden" name="rubrik_id" class="form-control" required autocomplete="off"
                                id="input-rubrik-id">
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
