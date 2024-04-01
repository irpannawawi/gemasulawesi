<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fa fa-edit"></i>{{ __('Editorial - Draft') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary btn-xs" href="{{ route('editorial.create') }}"><i class="fa fa-edit"></i>Tambah
                data</a>
            <a class="btn border btn-xs" href="{{ route('editorial.draft') }}"><i class="fa fa-sync"></i> Refresh</a>
            <button class="btn border btn-xs float-right" id="filter-btn">Seaarch/Filter</button>
            <div class="row" id="filter-post">
                <div class="col-12 border-top border-primary mt-3 mb-0 p-0">
                </div>
                <div class="col-12 float-right mt-0 p-0">
                    <div class="row">
                        <div class="col-3">
                            <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formDate" method="GET">
                                @csrf
                                <label for="dates">Date Range</label>
                                <input type="text" name="dates" class="input-sm form-control" value=""
                                    placeholder="MM/DD/YYYY - MM/DD/YYYY" autocomplete="off">

                                <input type="hidden" name="q"
                                    value="{{ !empty(request()->get('q')) ? request()->get('q') : '' }}">
                                <input type="hidden" name="author"
                                    value="{{ !empty(request()->get('author')) ? request()->get('author') : '' }}">
                                <input type="hidden" name="rubrik"
                                    value="{{ !empty(request()->get('rubrik')) ? request()->get('rubrik') : '' }}">
                            </form>
                        </div>
                        <div class="col-9">
                            <form action="{{ $_SERVER['REQUEST_URI'] }}" id="formSearch">
                                @csrf
                                <input type="hidden" name="dates"
                                    value="{{ !empty(request()->get('dates')) ? request()->get('dates') : '' }}">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-author">Penulis</label>
                                        <div class="input-group-append">
                                            <select name="author" id="authorSelect" class="form-control">
                                                @php
                                                    $authors = \App\Models\User::whereIn('role', [
                                                        'author',
                                                        'editor',
                                                        'admin',
                                                    ])->get();
                                                    $authorId = !empty(request()->query('author'))
                                                        ? request()->query('author')
                                                        : '';
                                                @endphp
                                                <option {{ @$authorId == '' ? 'selected' : '' }} value="">All
                                                </option>
                                                @foreach ($authors as $author)
                                                    <option {{ @$authorId == $author->id ? 'selected' : '' }}
                                                        value="{{ $author->id }}">{{ $author->display_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-rubrik">Rubrik</label>
                                        <div class="input-group-append">
                                            <select name="rubrik" id="rubrikSelect" class="form-control">
                                                @php
                                                    $rubriks = \App\Models\Rubrik::all();
                                                    $rubrikId = !empty(request()->query('rubrik'))
                                                        ? request()->query('rubrik')
                                                        : '';
                                                @endphp
                                                <option {{ @$rubrikId == '' ? 'selected' : '' }} value="">All
                                                </option>
                                                @foreach ($rubriks as $rubrik)
                                                    <option {{ @$rubrikId == $rubrik->rubrik_id ? 'selected' : '' }}
                                                        value="{{ $rubrik->rubrik_id }}">{{ $rubrik->rubrik_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="q">Search</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search"
                                                name="q" aria-label="Search" aria-describedby="basic-addon1">
                                            <div class="input-group-prepend">
                                                <button class="input-group-text btn btn-default" id="basic-addon1"><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <small>
                                            @if (!empty(request()->query('q')))
                                                Search for <b>{{ request()->query('q') }}</b>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <small>Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }}
                    entries</small>
            </div>

        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    @php
                        $order = request()->has('order') ? request()->get('order') : 'asc';
                        $sort_by = request()->has('sort_by') ? request()->get('sort_by') : 'published_at';
                    @endphp
                    <tr>
                        <th>No</th>
                        <th>Title <a
                                href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort_by' => 'title', 'order' => $order == 'asc' ? 'desc' : 'asc'])) }}">
                                <i
                                    class="fa fa-sort{{ $order == 'asc' && $sort_by == 'title' ? '-alpha-up' : '' }}{{ $order == 'desc' && $sort_by == 'title' ? '-alpha-down-alt' : '' }}"></i>
                            </a></th>
                        <th>Status</th>
                        <th>Rubrik</th>
                        <th>Penulis</th>
                        <th>Editor</th>
                        <th nowrap>Date Created
                            <a
                                href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort_by' => 'created_at', 'order' => $order == 'asc' ? 'desc' : 'asc'])) }}">
                                <i
                                    class="fa fa-sort{{ $order == 'asc' && $sort_by == 'created_at' ? '-numeric-up' : '' }}{{ $order == 'desc' && $sort_by == 'created_at' ? '-numeric-down-alt' : '' }}"></i>
                            </a>
                        </th>
                        </th>
                        <th nowrap>Date Published
                            <a
                                href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort_by' => 'published_at', 'order' => $order == 'asc' ? 'desc' : 'asc'])) }}">
                                <i
                                    class="fa fa-sort{{ $order == 'asc' && $sort_by == 'published_at' ? '-numeric-up' : '' }}{{ $order == 'desc' && $sort_by == 'published_at' ? '-numeric-down-alt' : '' }}"></i>
                            </a>
                        </th>
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = !empty($_GET['page']) ? $_GET['page'] * 20 - 19 : 1;
                    @endphp
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td class="text-left">{{ $post->title }} <a target="__blank" target="__blank"
                                    rel="noreferrer"
                                    href="{{ route('singlePost', [
                                        'rubrik' => str_replace(' ', '-', Str::lower($post->rubrik->rubrik_name)),
                                        'post_id' => $post->post_id,
                                        'slug' => $post->slug,
                                    ]) }}"><i
                                        class="fa fa-external-link-alt"></i></a></td>
                            <td><span class="badge badge-warning">{{ $post->status }}</span></td>
                            <td><span class="badge badge-secondary">{{ $post->rubrik->rubrik_name }}</span></td>
                            <td>{{ $post->author->display_name }}</td>
                            <td>{{ $post->editor->display_name }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('editorial.edit', ['id' => $post->post_id]) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{ route('editorial.delete', ['id' => $post->post_id]) }}"
                                        class="btn btn-sm btn-danger">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-2">
                {{ $posts->appends($_GET)->onEachSide(0)->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
    @push('extra-css')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <style>
            .table-value {
                font-size: 13px;
                text-align: left;
            }
        </style>
    @endpush

    @push('custom-scripts')
        {{-- initialize start date and end date --}}
        @php
            $start_date = request()->get('dates') ? explode('-', request()->get('dates'))[0] : '';
            $end_date = request()->get('dates') ? explode('-', request()->get('dates'))[1] : '';
        @endphp
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                $('#rubrikSelect, #authorSelect').on('change', function() {
                    $('#formSearch').submit()
                })
            });

            $('input[name="dates"]').daterangepicker({
                @if (!empty($_GET['dates']))
                    startDate: '{{ $start_date }}',
                    endDate: '{{ $end_date }}',
                    autoUpdateInput: true
                @else
                    autoUpdateInput: false
                @endif ,
                locale: {
                    cancelLabel: 'Clear'
                },
                opens: 'left'
            })
            $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('L') + ' - ' + picker.endDate.format('L'));
                $('#formDate').submit()
            });

            $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#formDate').submit()
            });

            $('#filter-btn').on('click', function() {
                $('#filter-post').slideToggle('slow');
            })
            
        </script>
    @endpush
</x-app-layout>
