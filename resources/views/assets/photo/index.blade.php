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
                <form action="{{route('browseImage')}}">
                @csrf
                <div class="form-inline">
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <input id="input_search" type="search" class="form-control input-sm" placeholder="Search..."
                            name="q" value="{{!empty($q)?$q:''}}">
                        <button class="btn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                </form>
            </div>  
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <h5>Pagination here</h5>
            </div>
            <div class="row box-photo-upload">
                <div class="row">
                    @foreach ($photos as $photo)
                        <div id="{{ $photo->image_id }}" class="photo-list float-left">
                            <div style="margin-left:15px;margin-bottom:15px;position:relative">
                                <div class="img-thumbnail overlay-wrapper">
                                    <img src="{{ url('storage/photos/' . $photo->asset->file_name) }}" alt=""
                                        title="" class="img-responsive" style="width:214px;height:95px">
                                    <div style="margin-top:5px">
                                        <small title="">&nbsp;</small><br>
                                        <small title="Uploader"><b>by: Uploader</b></small>
                                        <br><small title="Zona Bandung">Author Name</small>
                                        <div class="float-right">
                                            <button type="button" class="btn btn-xs btn-default btn-edit"
                                                data-id="7381762" title="Use/Edit"><i class="fa fa-edit"
                                                    aria-hidden="true"></i>
                                            </button><a type="button"
                                                class="btn btn-xs btn-danger text-white bg-danger btn-hapus delete-btn"
                                                href="{{ route('assets.photo.delete', ['id' => $photo->image_id]) }}"
                                                title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="imagedata" style="display:none">
                                {"id":7381762,"caption":"","author":"","source":"","credit":"","src":"https:\/\/assets-e.promediateknologi.id\/photo\/p1\/120\/2023\/08\/25\/photostudio_1692978514289-877277862.jpg","crop":"","watermark":0,"status":1,"site_id":120,"created_date":"2023-08-25
                                22:48:47","modified_date":"2023-08-25 22:48:47","created_by":"4488","modified_by":""}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row mt-2">
                {{$photos->links('vendor.pagination.bootstrap-4')}}
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
</x-app-layout>
