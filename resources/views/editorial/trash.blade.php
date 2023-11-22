<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-edit"></i>{{ __('Editorial - Trash') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary btn-xs" href="{{ route('editorial.create') }}"><i class="fa fa-edit"></i>Tambah
                data</a>

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
                            <td>{{ $post->title }}</td>
                            <td><span class="badge badge-warning">{{ $post->status }}</span></td>
                            <td><span class="badge badge-secondary">{{ $post->rubrik->rubrik_name }}</span></td>
                            <td>{{ $post->author->display_name }}</td>
                            <td>{{ $post->editor->display_name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('editorial.edit', ['id' => $post->post_id]) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{ route('editorial.delete', ['id' => $post->post_id]) }}"
                                        class="btn btn-sm btn-danger delete-btn">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-2">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>


</x-app-layout>
