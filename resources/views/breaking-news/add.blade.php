<x-app-layout>
    @push('extra-css')
        {{-- <link defer rel="stylesheet" href="{{url('/')}}/assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> --}}
        {{-- <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">
        
        <script src="{{url('/')}}/assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-1.13.8/datatables.min.js"></script> --}}
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Breaking News') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h2>Tambah Breaking News</h2>
        </div>
        <div class="card-body table-responsive">
            <form action="{{ route('breakingNews.insert') }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <button class="btn btn-default" type="button" data-toggle="modal"
                        data-target="#choosePostModal">Pilih Artikel</button>
                </div>
                <div class="form-group mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required autocomplete="off"
                        readonly>
                    <input type="hidden" name="post_id" id="post_id" class="form-control" required
                        autocomplete="off">
                </div>
                <div class="form-group mb-2">
                    <a  class="btn btn-secondary" href="{{ route('breakingNews') }}">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </div>
            </form>
        </div>
    </div>



    {{-- Modal edit rubrik --}}
    <div class="modal fade" id="choosePostModal" tabindex="-1" role="dialog" aria-labelledby="choosePostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="choosePostModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <iframe style="width: 100%; height: 400px; margin:0px;" src="{{ route('breakingNews.browse') }}"
                        loading="lazy" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        {{-- @vite('resources/js/datatable.js') --}}
        <script>
            
            window.addEventListener('message', receiveMessage, false);
            
            function receiveMessage(event) {
                $('#post_id').val(event.data.id)
                $('#title').val(event.data.title)
                console.log(event)
                $('#choosePostModal').modal('toggle');
            }
        </script>
    @endpush
</x-app-layout>
