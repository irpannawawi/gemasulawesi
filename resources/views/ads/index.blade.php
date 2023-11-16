<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Ads Management') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h2 class="card-title"><b>Big Banner</b></h2>
                            <div class="card-tools">
                                <!-- Collapse Button -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-12 text-center">
                                    @if ($big_hero->count() > 0)
                                        <h3>{{ $big_hero[0]->title }}</h3>
                                        @if ($big_hero[0]->type == 'img')
                                            <img src="{{ Storage::url('ads/' . $big_hero[0]->value) }}" alt="Ads Banner">
                                        @else
                                            <textarea name="big_banner" id="big-banner" class="form-control" rows="10">{{ $big_hero[0]->value }}</textarea>
                                        @endif
                                    @else
                                        <a href="{{ route('ads.create_big_hero') }}" class="btn btn-primary btn-sm ">+
                                            Tambah</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if ($big_hero->count() > 0)
                                {{-- <button class="btn btn-warning btn-sm">Update</button> --}}
                                <a href="{{ route('ads.clear_big_hero') }}"
                                    onclick="return confirm('Yakin ingin menghapus data?')"
                                    class="btn btn-danger btn-sm">Clear</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h2 class="card-title"><b>Ad Units</b></h2>
                            <div class="card-tools">
                                <!-- Collapse Button -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <a href="{{ route('ads.create') }}" class="btn btn-sm btn-primary mb-2 p-1">+ Tambah</a>
                                <div class="col-12">
                                    <table class="table table-striped table-bordered table-sm">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                        @php
                                            $n = 1;
                                        @endphp
                                        @foreach ($ad_units as $ads)
                                            <tr>
                                                <td>{{ $n++ }}</td>
                                                <td>{{ $ads->title }}</td>
                                                <td>
                                                    @if ($ads->type == 'img')
                                                        <img src="{{ Storage::url('ads/' . $ads->value) }}"
                                                            alt="{{$ads->title}}">
                                                    @else
                                                        <textarea  class="form-control">{{ $ads->value }}</textarea>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-warning" href="{{route('ads.edit', ['ad'=>$ads->ads_id])}}">Edit</a>
                                                    <br>
                                                    <a class="btn btn-sm btn-danger" href="{{route('ads.delete', ['ad'=>$ads->ads_id])}}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h2 class="card-title"><b>Scripts</b> <small>(Javascript / Meta Tag)</small></h2>
                            <div class="card-tools">
                                <!-- Collapse Button -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <a href="{{ route('ads.create_script') }}" class="btn btn-sm btn-primary mb-2 p-1">+ Tambah</a>
                            <div class="row">
                                <div class="col-12">
                                    
                                    <table class="table table-striped table-bordered">
                                        <tr class="bg-dark">
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                        @php
                                            $n = 1;
                                        @endphp
                                        @foreach ($ad_script as $ads)
                                            <tr>
                                                <td>{{ $n++ }}</td>
                                                <td>{{ $ads->title }}</td>
                                                <td>
                                                    
                                                        <textarea  class="form-control">{{ $ads->value }}</textarea>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning" href="{{route('ads.edit_script', ['ad'=>$ads->ads_id])}}">Edit</a>
                                                    <a class="btn btn-sm btn-danger" href="{{route('ads.delete', ['ad'=>$ads->ads_id])}}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modals add rubrik --}}

    <div class="modal fade" id="addTopikModal" tabindex="-1" role="dialog" aria-labelledby="addTopikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTopikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('topik-khusus.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="topic_name">Nama Topik</label>
                            <input type="text" name="topic_name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_description">Deskripsi</label>
                            <textarea name="topic_description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_image">Gambar</label>
                            <input type="file" name="topic_image" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit topik --}}
    <div class="modal fade" id="editTopikModal" tabindex="-1" role="dialog" aria-labelledby="editTopikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTopikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('topik-khusus.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <input type="hidden" name="topic_id" class="form-control" required autocomplete="off"
                                id="input-topic-id">
                            <label for="topic_name">Nama Topik<sup>*</sup></label>
                            <input type="text" name="topic_name" id="input-topic-name" class="form-control"
                                required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_description">Deskripsi <sup>*</sup></label>
                            <textarea name="topic_description" class="form-control" id="input-topic-description" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="topic_image">Gambar</label>
                            <input type="file" name="topic_image" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            function edit_topik(id, name, description) {
                $('#input-topic-name').val(name)
                $('#input-topic-description').val(description)
                $('#input-topic-id').val(id)
            }
        </script>
    @endpush
</x-app-layout>
