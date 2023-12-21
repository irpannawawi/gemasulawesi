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
            <a class="btn btn-primary btn-xs" href="{{ route('pushNotification.add') }}"><i class="fa fa-plus"></i>Tambah
                data</a>
            <p class="float-right">Subscribers: {{ App\Models\Subscriber::get()->count() }}</p>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th nowrap>Schedule</th>
                        <th nowrap>Updated at</th>
                        <th nowrap>Created at</th>
                        <th nowrap>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($pushNotification as $news)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td class="text-left">{{ $news->title }}</td>
                            <td class="text-left">{{ $news->body }}</td>
                            <td class="text-center">{{ strtoupper($news->status) }}</td>
                            <td class="text-center">{{ $news->scheduled_at }}</td>
                            <td class="text-center">{{ $news->updated_at }}</td>
                            <td class="text-center">{{ $news->created_at }}</td>
                            <td>
                                <div class="btn-group">

                                    <a href="{{ route('pushNotification.send', ['id' => $news->notif_id]) }}"
                                        class="btn btn-info btn-sm">Broadcast</a>
                                    <a class="btn btn-danger btn-sm delete-btn"
                                        href="{{ route('pushNotification.delete', ['id' => $news->notif_id]) }}">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$pushNotification->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>



    @push('custom-scripts')
        <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script>
            let table = new DataTable('.datatable')

            function fill_form(post_id, title) {
                $('#post_id').val(post_id)
                $('#title').val(title)

            }
        </script>
    @endpush
</x-app-layout>
