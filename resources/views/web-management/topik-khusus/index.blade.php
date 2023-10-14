<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Topik Khusus') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#addTopikModal"><i
                    class="fa fa-plus"></i>Tambah data</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($topiks as $topik)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $topik->topic_name }}</td>
                            <td>{{ $topik->topic_description }}</td>
                            <td style="max-width: 150px;">
                                <img class="img-fluid" src="{{ Storage::url('topic-images/'.$topik->topic_image) }}" alt="{{ $topik->topic_name }}">
                            </td>
                            <td>
                                <button class="btn btn-info" data-target="#editTopikModal" data-toggle="modal" onclick="edit_topik('{{$topik->topic_id}}','{{$topik->topic_name}}','{{$topik->topic_description}}')">Edit</button>
                                <a class="btn btn-danger" onclick="return confirm('Hapus topik?')"
                                    href="{{ route('topik-khusus.delete', ['id' => $topik->topic_id]) }}">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- Modals add rubrik --}}

    <div class="modal fade" id="addTopikModal" tabindex="-1" role="dialog" aria-labelledby="addTopikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTopikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('topik-khusus.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="topic_name">Nama Topik</label>
                            <input type="text" name="topic_name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_description">Deskripsi</label>
                            <textarea name="topic_description" class="form-control" required ></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_image">Gambar</label>
                            <input type="file" name="topic_image" class="form-control" required >
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

    {{-- Modal edit topik --}}
    <div class="modal fade" id="editTopikModal" tabindex="-1" role="dialog" aria-labelledby="editTopikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTopikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('topik-khusus.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <input type="hidden" name="topic_id" class="form-control" required autocomplete="off" id="input-topic-id">
                            <label for="topic_name">Nama Topik<sup>*</sup></label>
                            <input type="text" name="topic_name" id="input-topic-name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_description">Deskripsi <sup>*</sup></label>
                            <textarea name="topic_description" class="form-control" id="input-topic-description" required ></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_image">Gambar</label>
                            <input type="file" name="topic_image" class="form-control" >
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
            function edit_topik(id, name, description) {
                $('#input-topic-name').val(name)
                $('#input-topic-description').val(description)
                $('#input-topic-id').val(id)
            }
        </script>
    @endpush
</x-app-layout>
