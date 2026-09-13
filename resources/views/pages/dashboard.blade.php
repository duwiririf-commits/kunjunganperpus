@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>

    /* ==================================================
       DASHBOARD
    ================================================== */

    body {
        background: #fff7fa !important;
    }

    #content-wrapper {
        background: #fff7fa !important;
    }


    /* ==================================================
       JUDUL DASHBOARD
    ================================================== */

    .dashboard-title {
        color: #000 !important;
        font-weight: 700 !important;
    }


    /* ==================================================
       TANGGAL
    ================================================== */

    #currentDateDisplay {
        background: #d18eae !important;
        color: #000 !important;

        border: none !important;
        border-radius: 5px !important;

        font-size: 14px !important;
        font-weight: 600 !important;
    }


    /* ==================================================
       CARD STATISTIK
    ================================================== */

    .dashboard-card {
        background: #ffffff !important;

        border: none !important;
        border-left: 5px solid #d18eae !important;

        border-radius: 6px !important;

        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;

        transition: all 0.2s ease !important;
    }


    .dashboard-card:hover {
        transform: translateY(-2px);

        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.12) !important;
    }


    /* ==================================================
       JUDUL CARD
    ================================================== */

    .dashboard-card-title {
        color: #c56f95 !important;

        font-size: 12px !important;
        font-weight: 700 !important;

        text-transform: uppercase;
    }


    /* ==================================================
       ANGKA
    ================================================== */

    .dashboard-card-number {
        color: #000 !important;

        font-size: 20px !important;
        font-weight: 700 !important;
    }


    /* ==================================================
       ICON CARD
    ================================================== */

    .dashboard-card-icon {
        color: #d18eae !important;

        font-size: 30px !important;
    }


    /* ==================================================
       CARD GRAFIK
    ================================================== */

    .chart-card {
        background: #ffffff !important;

        border: none !important;

        border-radius: 6px !important;

        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
    }


    /* ==================================================
       HEADER GRAFIK
    ================================================== */

    .chart-card .card-header {
        background: #dfb4c8 !important;

        border-bottom: 1px solid rgba(255, 255, 255, 0.8) !important;

        padding: 15px 20px !important;
    }


    .chart-card .card-header h6 {
        color: #000 !important;

        font-weight: 700 !important;
    }


    .chart-card .card-header i {
        color: #000 !important;
    }


    /* ==================================================
       KETERANGAN GRAFIK
    ================================================== */

    .chart-card .text-muted {
        color: #555 !important;
    }


    /* ==================================================
       HR
    ================================================== */

    .chart-card hr {
        border-top: 1px solid #dfb4c8 !important;
    }

</style>


<div class="container-fluid">


    <!-- ==================================================
         JUDUL DASHBOARD
    ================================================== -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 dashboard-title">
            Kunjungan Perpustakaan
        </h1>


        <!-- TANGGAL -->

        <span class="badge p-2"
              id="currentDateDisplay">
        </span>

    </div>


    <!-- ==================================================
         CARD STATISTIK
    ================================================== -->

    <div class="row">


        <!-- ==================================================
             TOTAL HARI INI
        ================================================== -->

        <div class="col-xl-6 col-md-6 mb-4">

            <div class="card dashboard-card h-100 py-2"
                 onclick="alert('Total Kunjungan Hari Ini: {{ $totalHariIni }} Orang')"
                 style="cursor: pointer;">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="dashboard-card-title mb-1">
                                Total Kunjungan Hari Ini
                            </div>

                            <div class="dashboard-card-number">
                                {{ $totalHariIni }} Orang
                            </div>

                        </div>


                        <div class="col-auto">

                            <i class="fas fa-users dashboard-card-icon"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ==================================================
             TOTAL MINGGU INI
        ================================================== -->

        <div class="col-xl-6 col-md-6 mb-4">

            <div class="card dashboard-card h-100 py-2"
                 onclick="alert('Total Kunjungan Minggu Ini: {{ $totalMingguIni }} Orang')"
                 style="cursor: pointer;">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="dashboard-card-title mb-1">
                                Total Kunjungan Minggu Ini
                            </div>

                            <div class="dashboard-card-number">
                                {{ $totalMingguIni }} Orang
                            </div>

                        </div>


                        <div class="col-auto">

                            <i class="fas fa-calendar-week dashboard-card-icon"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ==================================================
         GRAFIK
    ================================================== -->

    <div class="row">

        <div class="col-lg-12 mb-4">

            <div class="card chart-card shadow mb-4">


                <!-- ==================================================
                     HEADER GRAFIK
                ================================================== -->

                <div class="card-header py-3">

                    <h6 class="m-0">

                        <i class="fas fa-chart-line mr-2"></i>

                        Grafik Kunjungan Minggu Ini

                    </h6>

                </div>


                <!-- ==================================================
                     BODY GRAFIK
                ================================================== -->

                <div class="card-body">


                    <div style="height: 280px;">

                        <canvas id="chartKunjungan"></canvas>

                    </div>


                    <hr>


                    <!-- ==================================================
                         KETERANGAN GRAFIK
                    ================================================== -->

                    <div class="row">

                        <div class="col-md-6">

                            <small class="text-muted">

                                <strong>X-axis:</strong>

                                Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu

                            </small>

                        </div>


                        <div class="col-md-6 text-md-right">

                            <small class="text-muted">

                                <strong>Y-axis:</strong>

                                Jumlah Pengunjung

                            </small>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>


    /* ==================================================
       TANGGAL
       TANPA JAM
    ================================================== */

    function tampilkanTanggal() {

        var now = new Date();


        var hari = [

            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'

        ];


        var bulan = [

            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'

        ];


        var tanggal =

            hari[now.getDay()] +

            ', ' +

            now.getDate() +

            ' ' +

            bulan[now.getMonth()] +

            ' ' +

            now.getFullYear();


        document.getElementById('currentDateDisplay').textContent = tanggal;

    }



    /* ==================================================
       GRAFIK
    ================================================== */

    $(document).ready(function () {


        /* TAMPILKAN TANGGAL */

        tampilkanTanggal();



        /* AMBIL CANVAS */

        var ctx = document

            .getElementById('chartKunjungan')

            .getContext('2d');



        /* BUAT GRAFIK */

        new Chart(ctx, {


            type: 'line',


            data: {


                labels: @json($labels),


                datasets: [{


                    label: 'Jumlah Kunjungan',


                    data: @json($dataGrafik),



                    /* ==================================================
                       WARNA GRAFIK
                    ================================================== */

                    borderColor: '#d18eae',

                    backgroundColor: 'rgba(223, 180, 200, 0.25)',

                    borderWidth: 3,

                    tension: 0.3,

                    fill: true,



                    /* ==================================================
                       TITIK GRAFIK
                    ================================================== */

                    pointBackgroundColor: '#d18eae',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2,

                    pointRadius: 7,

                    pointHoverRadius: 10,

                    pointHoverBorderWidth: 3

                }]

            },



            /* ==================================================
               OPTIONS
            ================================================== */

            options: {


                responsive: true,

                maintainAspectRatio: false,



                /* ==================================================
                   SUMBU
                ================================================== */

                scales: {


                    y: {

                        beginAtZero: true,


                        ticks: {

                            stepSize: 1

                        },


                        grid: {

                            color: 'rgba(0, 0, 0, 0.05)'

                        }

                    },


                    x: {

                        grid: {

                            display: false

                        }

                    }

                },



                /* ==================================================
                   PLUGIN
                ================================================== */

                plugins: {


                    legend: {

                        display: false

                    },


                    tooltip: {


                        backgroundColor: '#d18eae',


                        titleFont: {

                            size: 14,

                            weight: 'bold'

                        },


                        bodyFont: {

                            size: 13

                        },


                        padding: 12,


                        cornerRadius: 8,


                        displayColors: false,


                        callbacks: {


                            label: function (context) {

                                return context.parsed.y + ' Orang';

                            }

                        }

                    }

                },



                /* ==================================================
                   ANIMASI
                ================================================== */

                animation: {

                    duration: 1000,

                    easing: 'easeOutQuart'

                }

            }

        });

    });

</script>

@endpush