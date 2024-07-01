<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($countPublished, 0, ',', '.') }}</h3>

                    <p>Published</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check-square"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($countScheduled, 0, ',', '.') }}</h3>

                    <p>Scheduled</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($countDraft, 0, ',', '.') }}</h3>

                    <p>Draft</p>
                </div>
                <div class="icon">
                    <i class="fa fa-copy"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($countTrash, 0, ',', '.') }}</h3>

                    <p>Trash</p>
                </div>
                <div class="icon">
                    <i class="fa fa-trash"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        {{-- Chartjs Posts --}}
        <div class="col">
            <canvas id="chartPost"></canvas>
        </div>
        <div class="p-1 col">
            <div class="card p-3">
                <div class="card-title">
                    <h4 class="card-title mb-3 text-center">Grafik Analisis Situs</h4>
                </div>
                <div class="row">
                    <div class="col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h5>n/a</h5>
                                <p>Pengunjung Baru</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h5>{{ @number_format($analytics['total_visitors'], 0, ',', '.') }}</h5>

                                <p>Total Pengunjung</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <canvas id="chartVisitor"></canvas>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col card p-3">
            <div class="card-header">
                <h3 class="card-title"><b>Analisis Kunjungan</b></h3>
            </div>
            <div class="card-body">
                <h3>Platform</h3>
                <div class="row">
                    {{-- Popular Browser --}}
                    <div class="p-1 m-3 col shadow">
                        <h4 class="card-title mb-3 text-center">Browser Populer</h4>
                        <table class="table table-sm table-bordered table-striped table-hover">
                            <tr class="text-center">
                                <th>Browser</th>
                                <th>Views</th>
                            </tr>
                            @php
                                $n = 1;
                            @endphp
                            @foreach (array_splice($analytics['popular_browser'], 0, 10) as $os => $visit)
                                <tr>
                                    <td>{{ $os }}</td>
                                    <td class="text-center">{{ $visit }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{-- Popular Operating System --}}
                    <div class="p-1 m-3 col shadow">
                        <h4 class="card-title mb-3 text-center">Sistem Operasi Populer</h4>
                        <table class="table table-sm table-bordered table-striped table-hover">
                            <tr class="text-center">
                                <th>Os</th>
                                <th>Views</th>
                            </tr>
                            @php
                                $n = 1;
                            @endphp
                            @foreach (array_splice($analytics['popular_os'], 0, 10) as $os => $visit)
                                <tr>
                                    <td>{{ $os }}</td>
                                    <td class="text-center">{{ $visit }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{-- Popular Referer --}}
                    <div class="p-1 m-3 col shadow">
                        <h4 class="card-title mb-3 text-center">Referer Populer</h4>
                        <table class="table table-sm table-bordered table-striped table-hover">
                            <tr class="text-center">
                                <th>Host</th>
                                <th>Views</th>
                            </tr>
                            @php
                                $n = 1;
                            @endphp
                            @foreach (array_splice($analytics['popular_referer'], 0, 10) as $referer)
                                <tr>
                                    <td>{{ $referer['referer'] }}</td>
                                    <td class="text-center">{{ $referer['count'] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="p-1 col bg-white m-1 text-dark">
            <div class="card p-2">
                <h4 class="card-title mb-3 text-center">Popular article</h4>
                <table class="table table-sm table-bordered table-striped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Views</th>
                    </tr>
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($hotPost as $hp)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $hp->title }} 
                                <a href="">
                                    <i class="fa fa-external-link-alt"></i>
                                    </a>
                            </td>
                            <td class="text-center">{{ $hp->visit }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('chartPost');
            const ctxvisitor = document.getElementById('chartVisitor');

            // Mengambil data dari endpoint
            $.get('/chart-data', {}, function(data) {
                var labels = data.map(entry => entry.author_name); // Label untuk sumbu X
                var values = data.map(entry => entry.total); // Nilai untuk sumbu Y

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Post',
                            data: values,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });


            }); // Mengambil data dari endpoint
            $.get('/chart-data-visitor', {}, function(data) {
                var labels = data.map(entry => entry.month); // Label untuk sumbu X
                var values = data.map(entry => entry.total); // Nilai untuk sumbu Y

                new Chart(ctxvisitor, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Tayangan',
                            data: values,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        onClick: function(event, elements) {
                            console.log(elements[0]);
                        }
                    }
                });


            });
        </script>
    @endpush
</x-app-layout>
