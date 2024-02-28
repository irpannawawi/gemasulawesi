<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-edit"></i>{{ __('Editorial - Trash') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn border btn-xs" href="{{ route('editorial.trash') }}"><i class="fa fa-sync"></i> Refresh</a> &nbsp;&nbsp;&nbsp;&nbsp; 
            <a class="btn border btn-xs btn-danger" onclick="return confirm('Are you sure?')" href="{{ route('editorial.emptyTrash') }}"><i class="fa fa-trash"></i> Empty Trash</a>
            <div class="col-6 float-right">
                <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formSearch">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="input-group-append">
                                <select name="rubrik" id="rubrikSelect" class="form-control">
                                    @php
                                        $rubriks = \App\Models\Rubrik::all();
                                    @endphp
                                    <option {{ @$rubrikId == '' ? 'selected' : '' }} value="">All</option>
                                    @foreach ($rubriks as $rubrik)
                                        <option {{ @$rubrikId == $rubrik->rubrik_id ? 'selected' : '' }}
                                            value="{{ $rubrik->rubrik_id }}">{{ $rubrik->rubrik_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q"
                                    aria-label="Search" value="{{ !empty($q) ? $q : '' }}"
                                    aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <button class="input-group-text btn btn-default" id="basic-addon1"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Rubrik</th>
                        <th>Penulis</th>
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
                                    <a href="{{ route('editorial.restore', ['id' => $post->post_id]) }}"
                                        class="btn btn-sm btn-primary delete-btn">Restore</a>
                                    <a href="{{ route('editorial.hardDelete', ['id' => $post->post_id]) }}"
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $('#rubrikSelect').on('change', function() {
                $('#formSearch').submit()
            })
            // insert image 
            function sendBacaJuga(title, url) {

                window.parent.postMessage({
                    mceAction: 'insertHTML',
                    data: {
                        title: title,
                        url: url
                    }
                }, "*")
            }
        });
    </script>

</x-app-layout>
