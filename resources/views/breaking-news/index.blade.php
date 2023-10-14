<x-app-layout>
    @push('extra-css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Breaking News') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary btn-xs" href="{{route('breakingNews.add')}}"><i
                    class="fa fa-plus"></i>Tambah data</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm datatable">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($breakingNews as $news)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td class="text-left">{{ $news->title }}</td>
                            <td>
                                <div class="btn-group">

                                    <a href="{{route('breakingNews.edit', ['id'=>$news->breaking_news_id])}}" class="btn btn-info btn-sm" >Edit</a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Hapus berita?')"
                                    href="{{ route('breakingNews.delete', ['id' => $news->breaking_news_id]) }}">Hapus</a>
                                </div>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


 
    @push('custom-scripts')
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let table = new DataTable('.datatable')
        function fill_form(post_id, title)
        {
            $('#post_id').val(post_id)
            $('#title').val(title)

        }
    </script>
    @endpush
</x-app-layout>
