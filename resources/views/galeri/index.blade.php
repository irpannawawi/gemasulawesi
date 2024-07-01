<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Galeri') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary btn-xs float-right" data-toggle="modal" data-target="#addgaleriModal"><i
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
                    @foreach ($galeris as $galeri)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $galeri->galery_name }}</td>
                            <td>{{ $galeri->galery_description }}</td>
                            <td style="max-width: 150px;">
                                <img class="img-fluid"
                                    src="{{ Storage::url('galery-images/' . $galeri->galery_thumbnail) }}"
                                    alt="{{ $galeri->galery_name }}">
                            </td>
                            <td>
                                <a class="btn btn-info"
                                    href="{{ route('galeri.view', ['id' => $galeri->galery_id]) }}"><i
                                        class="fa fa-images"></i></a>
                                <div class="btn-group">
                                    <button class="btn btn-warning" data-target="#editgaleriModal" data-toggle="modal"
                                        onclick="edit_galeri('{{ $galeri->galery_id }}','{{ $galeri->galery_name }}','{{ $galeri->galery_description }}', '{{ Illuminate\Support\Carbon::createFromDate($galeri->created_at)->format('Y-m-d H:i') }}')">Edit</button>
                                    <a class="btn btn-danger delete-btn"
                                        href="{{ route('galeri.delete', ['id' => $galeri->galery_id]) }}">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- Modals add galeri --}}

    <div class="modal fade" id="addgaleriModal" tabindex="-1" role="dialog" aria-labelledby="addgaleriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addgaleriModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('galeri.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="galery_name">Nama galeri</label>
                            <input type="text" name="galery_name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="galery_description">Deskripsi</label>
                            <textarea name="galery_description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="galery_thumbnail">Gambar</label>
                            <input type="file" name="galery_thumbnail" class="form-control" required>
                        </div>
                        <div class="form-group mb-1 mt-1" id="form-published-time">
                            <div class="checkbox">
                                <label>Publish date</label>
                                <input type="datetime-local" value="{{ date('Y-m-d') . 'T' . date('H:i') }}" class="form-control" name="created_at">
                            </div>
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

    {{-- Modal edit galeri --}}
    <div class="modal fade" id="editgaleriModal" tabindex="-1" role="dialog" aria-labelledby="editgaleriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editgaleriModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('galeri.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <input type="hidden" name="galery_id" class="form-control" required autocomplete="off"
                                id="input-galery-id">
                            <label for="galery_name">Nama galeri<sup>*</sup></label>
                            <input type="text" name="galery_name" id="input-galery-name" class="form-control"
                                required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="galery_description">Deskripsi <sup>*</sup></label>
                            <textarea name="galery_description" class="form-control" id="input-galery-description" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="galery_thumbnail">Gambar</label>
                            <input type="file" name="galery_thumbnail" class="form-control">
                        </div>

                        <div class="form-group mb-1 mt-1" id="form-published-time">
                            <div class="checkbox">
                                <label>Publish date</label>
                                <input type="datetime-local"
                                    id="input-created_at" class="form-control" name="created_at">
                            </div>
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
            function edit_galeri(id, name, description, publish_date) {
                $('#input-galery-name').val(name)
                $('#input-galery-description').val(description)
                $('#input-galery-id').val(id)
                $('#input-created_at').val(publish_date)

            }
        </script>
    @endpush
</x-app-layout>
