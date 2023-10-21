<x-app-layout>
    @push('extra-css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
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
            <form action="{{ route('breakingNews.update', ['id'=>$news->breaking_news_id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group mb-2">
                    <button class="btn btn-default" type="button" data-toggle="modal"
                        data-target="#choosePostModal">Pilih Artikel</button>
                </div>
                <div class="form-group mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required autocomplete="off" value="{{$news->title}}" readonly>
                    <input type="hidden" name="post_id" id="post_id " value="{{$news->post_id}}" class="form-control" required autocomplete="off">
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
                    <table class="table table-sm datatable">
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
                        <tbody class="text-center">
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
                                            <button type="button" onclick="fill_form('{{$post->post_id}}', '{{$post->title}}')" class="btn btn-sm btn-default" data-dismiss="modal">Choose</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

        <script>
            let table = new DataTable('.datatable')
            function fill_form(post_id, title)
            {
                $('#post_id').val(post_id)
                $('#title').val(title)

            }
        </script>
    @endpush
</x-app-layout>
