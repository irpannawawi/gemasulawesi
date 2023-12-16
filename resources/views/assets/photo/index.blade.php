<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Photo') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <div data-module="photo/upload" class="form-group float-left">
                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#uploadModal">
                    <i class="fa fa-plus"></i> Upload Files
                </button>
                <a href="{{ route('assets.photo.index') }}" class="btn btn-default btn-sm"><i class="fa fa-reload"></i>
                    Refresh</a>
            </div>


            <div class="float-right">
                <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formSearch">
                    @csrf
                    <div class="form-inline">
                        <div class="form-group">
                            <select name="uploader" id="authorSelect" class=" form-control input-sm">
                                <option value="">- All -</option>
                                @foreach (\App\Models\User::all() as $user)
                                    <option {{ $uploader == $user->id ? 'selected' : '' }} value="{{ $user->id }}">
                                        {{ $user->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="input_search" name="q" type="text" class="form-control input-sm"
                                placeholder="Search..." value="{{ $q }}" autocomplete="off">
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row box-photo-upload">
                @foreach ($photos as $photo)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card p-1">
                            <div class="img-thumbnail">
                                <img src="{{ url('storage/photos/' . $photo->asset->file_name) }}" alt=""
                                    title="" class="img-responsive"
                                    style="width:100%; height:95px; margin: 0px auto;">
                            </div>
                            <div class="img-detail">
                                <small title="">{{@Str::substr($photo->caption, 0, 20)}}...</small><br>
                                <small title="Uploader"><b>by: {{ @$photo->uploader->display_name }}</b></small>
                            </div>
                            <div class="img-action">
                                <div class="float-right">
                                    <a href="{{ route('assets.photo.edit', ['id' => $photo->image_id]) }}"
                                        class="btn btn-xs btn-info btn-edit" title="Edit"><i
                                            class="fa fa-edit" aria-hidden="true"></i>
                                    </a> <a type="button"
                                         class="btn btn-xs btn-danger text-white bg-danger btn-hapus delete-btn"
                                        href="{{ route('assets.photo.delete', ['id' => $photo->image_id]) }}"
                                        title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-2">
                {{ $photos->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
    @php
        $modalTitle = 'Upload photo';
    @endphp
    <x-bs-modal id="uploadModal" :title="$modalTitle">
        <form method="post" enctype="multipart/form-data" action="{{ route('assets.photo.upload') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group p-0 mb-1">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" name="photo" id="photo">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="caption">Caption</label>
                    <input type="text" class="form-control" name="caption" id="caption">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="credit">Credit</label>
                    <input type="text" class="form-control" name="credit" id="credit">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" id="author">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="source">Source</label>
                    <input type="text" class="form-control" name="source" id="source">
                </div>


                <div class="form-group p-0 mt-3">
                    <button class="btn btn-sm m-1 bg-primary float-right" type="submit">Upload</button>
                    <button class="btn btn-sm m-1 bg-danger float-right" data-dismiss="modal"
                        type="button">Batal</button>
                </div>
            </div>
        </form>
    </x-bs-modal>



    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $('#authorSelect').on('change', function() {
                $('#formSearch').submit()
            })
        });
    </script>
</x-app-layout>
