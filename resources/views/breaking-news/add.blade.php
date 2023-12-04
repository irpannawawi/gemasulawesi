<x-app-layout>
    @push('extra-css')
        {{-- <link defer rel="stylesheet" href="{{url('/')}}/assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> --}}
        <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">
        
        <script src="{{url('/')}}/assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
        @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Breaking News') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h2>Tambah Breaking News</h2>
        </div>
        <div class="card-body table-responsive">
            <form action="{{ route('breakingNews.insert') }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <button class="btn btn-default" type="button" data-toggle="modal"
                        data-target="#choosePostModal">Pilih Artikel</button>
                </div>
                <div class="form-group mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required autocomplete="off"
                        readonly>
                    <input type="hidden" name="post_id" id="post_id" class="form-control" required
                        autocomplete="off">
                </div>
                <div class="form-group mb-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </div>
            </form>
        </div>
    </div>



    {{-- Modal edit rubrik --}}
    <div class="modal fade" id="choosePostModal" tabindex="-1" role="dialog" aria-labelledby="choosePostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="choosePostModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
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
                        {{-- <tbody class="text-center">
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
                                                onclick="fill_form('{{ $post->post_id }}', '{{ $post->title }}')"
                                                class="btn btn-sm btn-default" data-dismiss="modal">Choose</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        {{-- @vite('resources/js/datatable.js') --}}
        <script>
            function fill_form(post_id, title) {
                $('#post_id').val(post_id)
                $('#title').val(title)

            }

            document.addEventListener("DOMContentLoaded", function() {
                let table = new DataTable('.datatable', {
                    ajax: '/api/articles',
                    serverSide: true,
                    processing: true,
                    columns: [{
                        data: 'post_id',
                        name: 'post_id'
                    }, {
                        data: 'title',
                        name: 'title'
                    }, {
                        data: 'rubrik.rubrik_name',
                        name: 'rubrik.rubrik_name'
                    }, {
                        data: 'author.display_name',
                        name: 'author.display_name'
                    }, {
                        data: 'editor.display_name',
                        name: 'editor.display_name'
                    }, {
                        data: 'published_at',
                        name: 'published_at'
                    }, {
                        data: 'post_id',
                        name: 'post_data'
                    }],
                    // Menambahkan tombol di kolom terakhir
                    columnDefs: [{
                        targets: -1,
                        data: '',
                        render: function(data, type, row) {
                            return '<div class="btn-group"><button type="button" onclick="fill_form(' +
                                row.post_id + ', \'' + row.title +
                                '\')" class="btn btn-sm btn-default" data-dismiss="modal">Choose</a> </div>';
                        },
                    }, ],
                });
            })
        </script>
    @endpush
</x-app-layout>
