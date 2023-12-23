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
        <div class="col-lg-8 col-md-8">
            <canvas id="chartPost"></canvas>
        </div>
    </div>
    @push('custom-scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('chartPost');

            // Mengambil data dari endpoint
            $.get('/chart-data', {}, function(data) {
                var labels = data.map(entry => entry.month); // Label untuk sumbu X
                var values = data.map(entry => entry.total); // Nilai untuk sumbu Y

                new Chart(ctx, {
                    type: 'line',
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


            });
        </script>
    @endpush
</x-app-layout>
