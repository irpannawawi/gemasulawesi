<div class="card card-outline card-info">
    <div class="card-header">
        <h2 class="card-title">{{ $title }} <small class="text-danger"><sup>{{$alert}}</sup></small></h2>
        <div class="card-tools">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <div class="row">
            <div class="col-6">
                @php
                    $limit = false;
                    $limit_message='';
                    // limit 1 ad
                    if (in_array($page_name, ['content', 'pop_up']) && $ads->count() > 0) {
                        $limit = true;
                        $limit_message = 'Hanya bisa memasukan 1 iklan';
                    }
                    // limit 2 ad
                    if (in_array($page_name, ['in_article_list']) && $ads->count() > 1) {
                        $limit = true;
                        $limit_message = 'Hanya bisa memasukan 2 iklan';
                    }   
                @endphp
                @if (!$limit)
                    @if ($page_name!='html_script')
                        
                    <a href="#" data-toggle="modal" data-target="#addNewAdsImage"
                    class="btn btn-sm btn-primary mb-2 p-1">+ Add image</a>
                    @endif
                    @if ($page_name != 'content')
                        <a href="#" data-toggle="modal" data-target="#addNewAdsScript"
                            class="btn btn-sm btn-info mb-2 p-1">+ Add script</a>
                    @endif
                    @else
                    <p class="text-xs text-danger"><sup>*</sup>{{$limit_message}}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <table class="table table-striped table-bordered">
                    <tr class="bg-dark text-center">
                        <th>#</th>
                        <th>Notes</th>
                        <th>Value</th>
                        {{-- <th>Order priority</th> --}}
                        <th>Action</th>
                    </tr>
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($ads as $ad)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $ad->title }}</td>
                            <td class="text-center">
                                @if ($ad->type == 'img')
                                    <img style="max-width: 200px; margin: 0px auto;"
                                        src="{{ Storage::url('public/ads/' . $ad->value) }}" alt=""
                                        class="img img-responsive">
                                    <p>{{ @$ad->link }}</p>
                                @else
                                    <textarea class="form-control">{{ @$ad->value }}</textarea>
                                @endif
                            </td>
                            <td class="text-center"> 
                                <div class="btn-group">
                                    {{-- <a class="btn btn-sm btn-warning " --}}
                                        {{-- href="{{ route('ads.edit_script', ['ad' => $ad->ads_id]) }}"><i
                                            class="fa fa-edit"></i></a> --}}
                                    <a class="btn btn-sm btn-danger" style="color: white;" onclick="return confirm('Hapus ad?')"
                                        href="{{ route('ads.delete', ['ad' => $ad->ads_id]) }}"><i
                                            class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


{{-- Modal ads image --}}
<!-- Modal -->
<div class="modal fade" id="addNewAdsImage" tabindex="-1" role="dialog" aria-labelledby="addNewAdsImageLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewAdsImageLabel">Add new image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('ads.store') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="formTitle">Note <sup>*</sup></label>
                        <input type="text" name="title" id="formTitle" class="form-control" required>
                        <input type="hidden" name="type" value="img">
                        <input type="hidden" name="page_name" value="{{ $page_name }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="formTitle">Link url</label>
                        <input type="text" name="link" id="link" class="form-control">
                    </div>

                    <div class="form-group mb-2" id="formGambar">
                        <label for="formImage">Pilih Gambar</label>
                        <input type="file" name="image" id="formImage" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- ./Modal ads image --}}


{{-- Modal ad script --}}
<!-- Modal -->
<div class="modal fade" id="addNewAdsScript" tabindex="-1" role="dialog" aria-labelledby="addNewAdsScriptLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewAdsScriptLabel">Add new image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('ads.store_script') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="formTitle">Title <sup>*</sup></label>
                        <input type="text" name="title" id="formTitle" class="form-control" required>
                        <input type="hidden" name="type" value="html">
                        <input type="hidden" name="page_name" value="{{ $page_name }}">
                    </div>

                    <div class="form-group mb-2" id="formScript">
                        <label for="formImage">Isi script</label>
                        <textarea name="value" id="script" class="form-control" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
