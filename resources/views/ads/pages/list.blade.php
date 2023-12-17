<div class="card card-outline card-info">
    <div class="card-header">
        <h2 class="card-title">{{ $title }}</h2>
        <div class="card-tools">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <div class="row">
            <div class="col-3">
                <a href="#" data-toggle="modal" data-target="#addNewAdsImage"
                    class="btn btn-sm btn-primary mb-2 p-1">+ Add image</a>
                <a href="#" data-toggle="modal" data-target="#addNewAdsScript"
                    class="btn btn-sm btn-info mb-2 p-1">+ Add script</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <table class="table table-striped table-bordered">
                    <tr class="bg-dark">
                        <th>#</th>
                        <th>Notes</th>
                        <th>Value</th>
                        <th>Order priority</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($ads as $ad)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $ad->title }}</td>
                            <td>

                                <textarea class="form-control">{{ $ads->value }}</textarea>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning"
                                    href="{{ route('ads.edit_script', ['ad' => $ads->ads_id]) }}">Edit</a>
                                <a class="btn btn-sm btn-danger"
                                    href="{{ route('ads.delete', ['ad' => $ads->ads_id]) }}">Delete</a>
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
                <form method="POST" enctype="multipart/form-data" action="{{ route('ads.store_big_hero') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="formTitle">Title <sup>*</sup></label>
                        <input type="text" name="title" id="formTitle" class="form-control" required>
                        <input type="hidden" name="type" value="image">
                    </div>

                    <div class="form-group mb-2" id="formGambar">
                        <label for="formImage">Pilih Gambar</label>
                        <input type="file" name="image" id="formImage" class="form-control">
                    </div>

                    <div class="form-group mb-2" id="formScript" style="display: none;">
                        <label for="formImage">Isi script</label>
                        <textarea name="script" id="script" class="form-control" rows="10"></textarea>
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
                <form method="POST" enctype="multipart/form-data" action="{{ route('ads.store_big_hero') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="formTitle">Title <sup>*</sup></label>
                        <input type="text" name="title" id="formTitle" class="form-control" required>
                        <input type="hidden" name="type" value="script">
                    </div>

                    <div class="form-group mb-2" id="formScript">
                        <label for="formImage">Isi script</label>
                        <textarea name="script" id="script" class="form-control" rows="10"></textarea>
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