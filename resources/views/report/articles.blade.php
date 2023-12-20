@push('extra-css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Report Articles') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <div class="row mb-2">
                <div class="col-6">
                    <form action="{{ route('report.articles') }}" method="GET">
                        @csrf
                        <label for="date">Filter Date</label>
                        <div class="input-group">
                            <input type="text" name="daterange" value="{{ $daterange }}" class="form-control" />
                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-info bg-info">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-6 text-right mt-5">
                    <form action="{{ route('report.articles.download') }}" method="GET">
                        @csrf
                        <input hidden type="text" name="daterange" value="{{ $daterange }}" class="form-control" />
                        <button type="submit" class="btn btn-default" title="Export"><i class="fa fa-file-excel"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm ">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Section</th>
                        <th>Author</th>
                        <th>Editor</th>
                        <th>Published at</th>
                        <th>Visitor</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                        if(!empty($_GET['page'])){

                            if($_GET['page']!='' && $_GET['page']>1){
                                $n= $_GET['page']*20+1;
                            }
                        }
                    @endphp
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td class="text-left" style="width: 40%">{{ $post->title }}</td>
                            <td>{{ $post->rubrik->rubrik_name }}</td>
                            <td>{{ $post->author->display_name }}</td>
                            <td>{{ $post->editor->display_name }}</td>
                            <td>{{ $post->published_at }}</td>
                            <td>{{ $post->visit }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$posts->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>


    {{-- Modals add rubrik --}}

    <div class="modal fade" id="addRubrikModal" tabindex="-1" role="dialog" aria-labelledby="addRubrikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRubrikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rubrik.add') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="rubrik">Nama rubrik</label>
                            <input type="text" name="rubrik_name" class="form-control" required autocomplete="off">
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

    {{-- Modal edit rubrik --}}
    <div class="modal fade" id="editRubrikModal" tabindex="-1" role="dialog" aria-labelledby="editRubrikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRubrikModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rubrik.edit') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="rubrik">Nama rubrik</label>
                            <input type="text" name="rubrik_name" class="form-control" required autocomplete="off"
                                id="input-rubrik-name">
                            <input type="hidden" name="rubrik_id" class="form-control" required autocomplete="off"
                                id="input-rubrik-id">
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
        <script defer type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script defer type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <script type="text/javascript" defer>
            document.addEventListener("DOMContentLoaded",()=>{
                $('input[name="daterange"]').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
