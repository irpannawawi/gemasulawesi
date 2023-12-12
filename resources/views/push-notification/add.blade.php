<x-app-layout>
    @push('extra-css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Push Notification') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h2>Tambah Push Notification</h2>
        </div>
        <div class="card-body table-responsive">
            <form action="{{ route('pushNotification.insert') }}" method="POST">
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
                    <label for="description">Title</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group mb-2 col-3">
                    <label for="description">Schedule</label>
                    <input type="datetime-local" required name="schedule" id="schedule" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>

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
                <div class="modal-body p-0">
                    <iframe src="{{ route('pushNotification.browse') }}" style="width: 100%; min-height:480px;"
                        frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

        <script>
            let table = new DataTable('.datatable')

            document.addEventListener("DOMContentLoaded", () => {
                window.addEventListener('message', message => {
                    data = message.data.data
                    fill_form(data.id, data.title, data.description)
                    $('#choosePostModal').modal('toggle')
                });
            });

            function fill_form(post_id, title, description) {
                $('#post_id').val(post_id)
                $('#title').val(title)
                $('#description').val(description)

            }
        </script>
    @endpush
</x-app-layout>
