@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <!-- Statistic cards -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            {{ auth()->user()->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-map"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Wisata</h4>
                        </div>
                        <div class="card-body">
                            {{ $destinasi->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Blog</h4>
                        </div>
                        <div class="card-body">
                            {{ $blog->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kritik Saran</h4>
                        </div>
                        <div class="card-body">
                            {{ $feedback->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pengunjung</h4>
                    </div>
                    <div class="w-full">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>Top 5 Wisata</h4>
                    </div>
                    <div class="card-body" id="top-5-scroll">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($top as $wisata)
                                <li class="media">
                                    <img class="mr-3 rounded" width="75" height="90" style="object-fit: cover"
                                        src="{{ asset('storage/' . $wisata->gambar) }}" alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">
                                                {{ number_format($wisata->avg_rating, 1) }} ⭐</div>
                                        </div>
                                        <div class="media-title">{{ $wisata->nama }}</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                @switch($wisata->kategori->nama)
                                                    @case('Wisata Alam')
                                                        <div class="budget-price-square bg-success"></div>
                                                        <div class="budget-price-label">{{ $wisata->kategori->nama }}</div>
                                                    @break

                                                    @case('Wisata Sejarah')
                                                        <div class="budget-price-square bg-warning"></div>
                                                        <div class="budget-price-label">{{ $wisata->kategori->nama }}</div>
                                                    @break

                                                    @case('Wisata Buatan')
                                                        <div class="budget-price-square bg-info"></div>
                                                        <div class="budget-price-label">{{ $wisata->kategori->nama }}</div>
                                                    @break

                                                    @case('Wisata Religi')
                                                        <div class="budget-price-square bg-primary"></div>
                                                        <div class="budget-price-label">{{ $wisata->kategori->nama }}</div>
                                                    @break

                                                    @default
                                                        <div class="budget-price-square bg-danger"></div>
                                                        <div class="budget-price-label">{{ $wisata->kategori->nama }}
                                                        </div>
                                                @endswitch
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer pt-2 d-flex justify-content-center">
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-label">Wisata Karawang</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Kategori Wisata</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart4"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Wisata Kecamatan</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart5"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var labels = {!! json_encode($labels) !!};
        var data = {!! json_encode($data) !!};
        var regionLabels = {!! json_encode($regionLabels) !!};
        var regionData = {!! json_encode($regionData) !!};

        document.addEventListener('DOMContentLoaded', function() {
            var visits = @json($visits);
            var categories = visits.map(function(item) {
                return item.month;
            });
            var seriesData = visits.map(function(item) {
                return item.total_hits;
            });

            var options = {
                series: [{
                    name: "Total",
                    data: seriesData
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 0
                },
                grid: {
                    row: {
                        colors: ['#fff', '#f2f2f2']
                    }
                },
                xaxis: {
                    labels: {
                        rotate: -45
                    },
                    categories: categories,
                    tickPlacement: 'on'
                },
                fill: {
                    type: 'solid',
                    colors: ['#00A3E0']
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        });
    </script>
    <script src="{{ asset('js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/page/index.js') }}"></script>
@endsection
