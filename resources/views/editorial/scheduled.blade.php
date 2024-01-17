<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-edit"></i>{{ __('Editorial - Scheduled') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary btn-xs" href="{{ route('editorial.create') }}"><i class="fa fa-edit"></i>Tambah
                data</a>
                <a class="btn border btn-xs" href="{{ route('editorial.scheduled') }}"><i class="fa fa-sync"></i> Refresh</a>
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
                                            <option {{@$rubrikId==''?'selected':''}} value="">All</option>
                                        @foreach ($rubriks as $rubrik)
                                            <option {{@$rubrikId==$rubrik->rubrik_id?'selected':''}} value="{{$rubrik->rubrik_id}}">{{$rubrik->rubrik_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="q"
                                        aria-label="Search" value="{{ !empty($q) ? $q : '' }}" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <button class="input-group-text btn btn-default" id="basic-addon1"><i class="fa fa-search"></i></button>
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
                        <th>Author</th>
                        <th>Editor</th>
                        <th>Date Created</th>
                        <th>Date Scheduled</th>
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
                            <td class="text-left">{{ $post->title }} <a target="__blank"
                                target="__blank"
                                rel="noreferrer"
                                    href="{{ route('singlePost', [
                                        'rubrik' => str_replace(' ', '-', $post->rubrik->rubrik_name),
                                        'post_id' => $post->post_id,
                                        'slug' => $post->slug,
                                    ]) }}"><i
                                        class="fa fa-external-link-alt"></i></a></td>
                            <td><span class="badge badge-warning">{{ $post->status }}</span></td>
                            <td><span class="badge badge-secondary">{{ $post->rubrik->rubrik_name }}</span></td>
                            <td>{{ $post->author->display_name }}</td>
                            <td>{{ $post->editor->display_name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->scheduled_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('editorial.edit', ['id' => $post->post_id]) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{ route('editorial.delete', ['id' => $post->post_id]) }}"
                                        class="btn btn-sm btn-danger">Hapus</a>
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
