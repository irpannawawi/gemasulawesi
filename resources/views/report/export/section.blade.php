@push('extra-css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Report Section') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body table-responsive">
            <form action="{{ route('report.editor') }}" method="GET">
            <div class="row">
                    @csrf
                    <div class="col-md-4 col-sm-6 col-sx-12 col-lg-4">
                        <label for="date">Filter Date</label>
                        <div class="input-group">
                            <input type="text" name="daterange" value="{{$daterange}}" class="form-control" />
                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-info bg-info">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-sm table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Editor</th>
                        <th>Articles</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                        $total = 0;
                    @endphp
                    @foreach ($users as $user)
                        @php
                            $total += $user->posts->count();
                        @endphp
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $user->display_name }}</td>
                            <td>{{ $user->posts->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{ $total }}</th>
                    </tr>
                </tfoot>
            </table>
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
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <script>
            function edit_rubrik(id, name) {
                $('#input-rubrik-name').val(name)
                $('#input-rubrik-id').val(id)
            }
        </script>

        <script type="text/javascript">
            $('input[name="daterange"]').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        </script>
    @endpush
</x-app-layout>
