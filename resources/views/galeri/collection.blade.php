<x-app-layout>
    @push('extra-css')
        <style>
            .image-checkbox {
                cursor: pointer;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                border: 4px solid transparent;
                outline: 0;
            }

            .image-checkbox input[type="checkbox"] {
                display: none;
            }

            .image-checkbox-checked {
                border-color: #f58723;
            }
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Collection : ' . $galery->galery_name) }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <div data-module="photo/upload" class="form-group float-left">
                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#selectImage">
                    <i class="fa fa-images"></i> Select Image
                </button>
                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#selectVideo">
                    <i class="fa fa-video"></i> Select Video
                </button>
                <a href="{{ route('galeri.view', ['id' => $galery->galery_id]) }}" class="btn btn-default btn-sm"><i
                        class="fa fa-reload"></i>
                    Refresh</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row box-photo-upload">
                <div class="row">
                    @foreach ($collections as $collect)
                        @if ($collect->type == 'image')
                            <div id="" class="photo-list float-left">
                                <div style="margin-left:15px;margin-bottom:15px;position:relative">
                                    <div class="img-thumbnail overlay-wrapper">
                                        <img src="{{ url('storage/photos/' . $collect->photo->asset->file_name) }}"
                                            alt="" title="" class="img-responsive"
                                            style="width:214px;height:95px">
                                        <div style="margin-top:5px">
                                            <small title="">&nbsp;</small><br>
                                            <small title="Uploader"><b>by: Uploader</b></small>
                                            <br><small title="Zona Bandung">Penulis</small>
                                            <div class="float-right">
                                                <a type="button"
                                                    class="btn btn-xs btn-danger text-white bg-danger btn-hapus"
                                                    href="{{ route('galeri.collection.delete', ['id' => $collect->collection_id]) }}"
                                                    onclick="return confirm('Hapus foto?')" title="Delete"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="imagedata" style="display:none">
                                    {"id":7381762,"caption":"","author":"","source":"","credit":"","src":"https:\/\/assets-e.promediateknologi.id\/photo\/p1\/120\/2023\/08\/25\/photostudio_1692978514289-877277862.jpg","crop":"","watermark":0,"status":1,"site_id":120,"created_date":"2023-08-25
                                    22:48:47","modified_date":"2023-08-25
                                    22:48:47","created_by":"4488","modified_by":""}
                                </div>
                            </div>
                        @else
                            @php
                                $youtubeData = getYoutubeData($collect->video->url)->snippet;
                            @endphp
                            <div class="col-md-3 text-xs-center">
                                <label class="image-checkbox" title="England">
                                    <img src="{{ $youtubeData->thumbnails->medium->url }}" alt="{{ $collect->video->title }}"
                                        class="img-responsive" title="{{ $collect->video->title }}">
                                </label>
                                
                                <div class="float-right">
                                    <a type="button"
                                        class="btn btn-xs btn-danger text-white bg-danger btn-hapus"
                                        href="{{ route('galeri.collection.delete', ['id' => $collect->collection_id]) }}"
                                        onclick="return confirm('Hapus foto?')" title="Delete"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="selectImage" tabindex="-1" role="dialog" aria-labelledby="selectImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="selectImageLabel">Select Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" enctype="multipart/form-data" action="{{ route('galeri.collection.insert') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-3 text-xs-center mb-2 p-2" style="height: 150px;">
                                <label class="image-checkbox" title="England" style="height: 100%; width:100%;">
                                    <img style="height: 100%; width:100%;" class="img border rounded" loading="lazy" src="{{ Storage::url('public/photos/' . $photo->asset->file_name) }}" />
                                    <input type="checkbox" name="files[]" value="{{ $photo->image_id }}" />
                                    <input type="hidden" name="type" value="image" />
                                    <input type="hidden" name="galery_id" value="{{ $galery->galery_id }}" />
                                </label>
                            </div>
                        @endforeach
                    </div>
                    {{$photos->links('vendor.pagination.bootstrap-4')}}
                </div>
                <div class="modal-footer">
        
                    <div class="form-group p-0 mt-3">
                        <button class="btn btn-sm m-1 bg-primary float-right" type="submit">Upload</button>
                        <button class="btn btn-sm m-1 bg-danger float-right" data-dismiss="modal"
                            type="button">Batal</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="selectImage" tabindex="-1" role="dialog" aria-labelledby="selectImageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="selectImageLabel">Select Image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    @php
        $modalTitle = 'Select Video';
    @endphp
    <x-bs-modal id="selectVideo" :title="$modalTitle">
        <form method="post" enctype="multipart/form-data" action="{{ route('galeri.collection.insert') }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    @foreach ($videos as $video)
                        @php
                            $youtubeData = getYoutubeData($video->url)->snippet;
                        @endphp
                        <div class="col-md-3 text-xs-center">
                            <label class="image-checkbox" title="England">
                                <img src="{{ $youtubeData->thumbnails->medium->url }}" alt="{{ $video->title }}"
                                    class="img-responsive" title="{{ $video->title }}">
                                <input type="checkbox" name="files[]" value="{{ $video->video_id }}" />
                                <input type="hidden" name="type" value="video" />
                                <input type="hidden" name="galery_id" value="{{ $galery->galery_id }}" />
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">

                <div class="form-group p-0 mt-3">
                    <button class="btn btn-sm m-1 bg-primary float-right" type="submit">Upload</button>
                    <button class="btn btn-sm m-1 bg-danger float-right" data-dismiss="modal"
                        type="button">Batal</button>
                </div>
            </div>
        </form>
    </x-bs-modal>

    @push('custom-scripts')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded",()=>{
                jQuery(function($) {
                    // init the state from the input
                    $(".image-checkbox").each(function() {
                        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                            $(this).addClass('image-checkbox-checked');
                        } else {
                            $(this).removeClass('image-checkbox-checked');
                        }
                    });
    
                    // sync the state to the input
                    $(".image-checkbox").on("click", function(e) {
                        if ($(this).hasClass('image-checkbox-checked')) {
                            $(this).removeClass('image-checkbox-checked');
                            $(this).find('input[type="checkbox"]').first().removeAttr("checked");
                        } else {
                            $(this).addClass('image-checkbox-checked');
                            $(this).find('input[type="checkbox"]').first().attr("checked", "checked");
                        }
    
                        e.preventDefault();
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
