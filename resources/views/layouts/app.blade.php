<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/plugins/fontawesome-free/css/all.min.css"> --}}
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ url('assets/AdminLTE') }}/dist/css/adminlte.min.css"> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('extra-css')
    <style>
        .btn-primary {
            background-color: #007BFF;
        }

        .btn-secondary {
            background-color: #6C757d;
        }


        .btn-warning {
            background-color: #ffc107;
        }

        .btn-success {
            background-color: #28A745;
        }

        .select2-selection__choice {
            background-color: #28A745;
            text: white;
        }

        .nav-sidebar .nav-item>.nav-link {
            padding: 7px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .nav-sidebar .nav-treeview {
            margin-left: 10px;
        }

        .nav-sidebar .nav-item>.nav-link {
            font-size: 15px;
            padding: 5px 5px 5px 5px;
        }

        table tr td {
            font-size: 14px;
        }

        table {
            padding: 0px;
            margin: 0px;
        }

        .img-circle {
            width: 50px;
            height: 50px;
        }

        /* Ganti warna border pada input select2 menjadi hitam */
        .select2-search--inline{
            border: 0px !important;
        }
        .select2-search-search_field{
            border: 0px !important;
        }
        [type='search']:focus{
            --tw-ring-color: #b9b9b934;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('layouts.navbar')

        @include('layouts.navigation')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if (isset($header))
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>{{ $header }}</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Blank Page</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
            @endif




            <!-- Main content -->
            <section class="content">

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2013-{{ now()->year }} <a href="https://gemasulawesi.com">Gema
                    Sulawesi</a>.</strong>
            All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    {{-- @vite('resources/js/footer.js') --}}
    <!-- jQuery -->
    {{-- <script src="{{ url('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script> --}}
    <!-- Bootstrap 4 -->
    <script defer src="{{ url('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script defer src="{{ url('assets/AdminLTE') }}/dist/js/adminlte.min.js"></script>
    {{-- Alerts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($message = Session::get('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ $message }}',
                })
            });
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ $message }}',
            })
        </script>
    @endif
    {{-- endAlerts --}}

    {{-- confirm delete --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: "Apakah anda yakin?",
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, hapus!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to delete route if user confirms
                            window.location.href = button.getAttribute('href');
                        }
                    });
                });
            });
        });
    </script>

    @stack('custom-scripts')
</body>

</html>
