<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
    @if (!isset($_GET['rubrik']) && empty($_GET['rubrik']))
            
        #filter-post {
            display: none;
        }
        @endif
        #filter-btn {
            background-color: #0010bc;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="card" data-widget="iframe">
        <div class="card-header">
            <a class="btn border btn-xs" href="{{ $_SERVER['REQUEST_URI'] }}"><i class="fa fa-sync"></i> Refresh</a>

            <a href="#" class="btn border btn-xs float-right" id="filter-btn">Seaarch/Filter</a>
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
        <div class="card-body">
            <div class="card-body no-padding">
                <div class="table-responsive no-margin">
                    <table class="table table-striped table-sm table-bordered" style="font-size: 14px;">
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
                        <tbody>
                            @php
                                $n = !empty(request()->get('page')) ? (request()->get('page') - 1) * $posts->perPage() + 1 : 1;
                            @endphp
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>{{ $post->rubrik->rubrik_name }}</td>
                                    <td>{{ $post->author->display_name }}</td>
                                    <td>{{ $post->editor->display_name }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <button class="btn btn-default btn-sm"
                                            onclick="sendBacaJuga('{{ $post->title }}', 'https:\/\/{{ $_SERVER['SERVER_NAME'] }}/id/{{ str_replace(' ', '-', $post->rubrik->rubrik_name) }}/{{ $post->post_id }}/{{ $post->slug }}')">Choose</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
    @php
        $modalTitle = 'Upload photo';
    @endphp
    <x-bs-modal id="uploadModal" :title="$modalTitle">
        <form method="post" enctype="multipart/form-data" action="{{ route('assets.photo.upload') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group p-0 mb-1">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" name="photo" id="photo">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="caption">Caption</label>
                    <input type="text" class="form-control" name="caption" id="caption">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="credit">Credit</label>
                    <input type="text" class="form-control" name="credit" id="credit">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" id="author">
                </div>
                <div class="form-group p-0 mb-1">
                    <label for="source">Source</label>
                    <input type="text" class="form-control" name="source" id="source">
                </div>


                <div class="form-group p-0 mt-3">
                    <button class="btn btn-sm m-1 bg-primary float-right" type="submit">Upload</button>
                    <button class="btn btn-sm m-1 bg-danger float-right" data-dismiss="modal"
                        type="button">Batal</button>
                </div>
            </div>
        </form>
    </x-bs-modal>
    <!-- jQuery -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assets/AdminLTE') }}/dist/js/adminlte.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

    <script>
        $('#rubrikSelect').on('change', function() {
            $('#formSearch').submit()
        })
        // insert image 
        function sendBacaJuga(title, url) {
            window.parent.postMessage({
                mceAction: 'insertHTML',
                data: {
                    title: title,
                    url: url
                }
            }, "*")
        }
    </script>


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

        });
    </script>
</body>

</html>
