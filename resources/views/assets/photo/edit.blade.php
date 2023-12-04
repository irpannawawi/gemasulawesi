<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Photo - Edit') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-5">
                    <img src="{{ Storage::url('photos/' . $image->asset->file_name) }}" alt="">
                </div>
                <div class="col">
                    <form method="post" enctype="multipart/form-data"
                        action="{{ route('assets.photo.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{ $image->image_id }}" name="image_id" />
                        <input type="hidden" value="original" name="source_image" />
                        <div class="modal-body">
                            <div class="form-group p-0 mb-1">
                                <label for="caption">Caption</label>
                                <input type="text" class="form-control" value="{{ $image->caption }}" name="caption"
                                    id="caption">
                            </div>
                            <div class="form-group p-0 mb-1">
                                <label for="credit">Credit</label>
                                <input type="text" class="form-control" value="{{ $image->credit }}" name="credit"
                                    id="credit">
                            </div>
                            <div class="form-group p-0 mb-1">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" value="{{ @$image->author }}"
                                    name="author" id="author">
                            </div>
                            <div class="form-group p-0 mb-1">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" value="{{ $image->source }}" name="source"
                                    id="source">
                            </div>
                            <div class="form-group p-0 mt-3">
                                <button class="btn btn-sm m-1 bg-primary float-right" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>