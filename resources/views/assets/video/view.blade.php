<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Video') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <div data-module="photo/upload" class="form-group float-left">
                <a href="{{ route('assets.video.add') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah video
                </a>
                <a href="{{ route('assets.video.index') }}" class="btn btn-default btn-sm"><i class="fa fa-reload"></i>
                    Refresh</a>
            </div>
            <div class="float-right">
                <div class="form-inline">
                    <div class="form-group">
                        <select name="uploader" class=" form-control input-sm">
                            <option value="0">- All -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input id="input_search" type="text" class="form-control input-sm"
                            placeholder="Search..." data-url="https://editor.promediateknologi.id/photo/index"
                            data-query-string="" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row box-photo-upload">
                <div class="row col-12">
                    @foreach ($list_video as $video)
                        @php
                            $youtubeData = getYoutubeData($video->url)->snippet;

                        @endphp
                        <div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom:10px">
                            <div class="img-thumbnail overlay-wrapper">
                                <img src="{{ $youtubeData->thumbnails->medium->url }}" alt="{{ $video->title }}"
                                    class="img-responsive" title="{{ $video->title }}">
                                <div style="margin-top:5px">
                                    <small title="24953">by:
                                        <strong>{{ $video->uploader->display_name }}</strong></small>
                                </div>
                            </div>

                            <div style="position:absolute;top:10px;margin-left:10px">

                                <label class="badge badge-secondary">{{ substr($video->title, 0, 20) }}.....</label>
                            </div>
                            <div style="position:absolute;bottom:35px;margin-left:10px">
                                <a class="btn btn-default btn-xs"
                                    href="{{ route('assets.video.edit', ['id' => $video->video_id]) }}"><i
                                        class="fa fa-edit"></i> Edit</a>

                                <a class="btn btn-default btn-xs"
                                    href="{{ route('assets.video.delete', ['id' => $video->video_id]) }}"><i
                                        class="fa fa-trash delete-btn"></i>
                                    Delete</a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row mt-2">
                {{$list_video->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </div>
</x-app-layout>
