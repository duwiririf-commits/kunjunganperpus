@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">

    <!-- Judul -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kunjungan Perpustakaan</h1>
        <span class="badge badge-primary p-2" id="currentDateDisplay"></span>
    </div>

    <!-- 2 Card Statistik -->
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" onclick="alert('Total Kunjungan Hari Ini: 20 Orang')" style="cursor: pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Kunjungan Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                20 Orang
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" onclick="alert('Total Kunjungan Bulan Ini: 95 Orang')" style="cursor: pointer;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Kunjungan Bulan Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                95 Orang
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Data Kunjungan -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kunjungan</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar mr-2"></i> Grafik Kunjungan
                    </h6>
                </div>
                <div class="card-body">
                    
                    <!-- Tombol Ganti Minggu (Lebih Banyak Pilihan) -->
                    <div class="mb-3">
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(-3)">
                            <i class="fas fa-chevron-left"></i> 3 Minggu Lalu
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(-2)">
                            2 Minggu Lalu
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(-1)">
                            Minggu Lalu
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="gantiMinggu(0)">
                            <i class="fas fa-calendar-week"></i> Minggu Ini
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(1)">
                            Minggu Depan
                        </button>
                        <span class="ml-2 text-muted" id="labelMinggu">Minggu Ini (23-27 Agustus 2026)</span>
                    </div>

                    <!-- Canvas Chart -->
                    <div style="height: 280px;">
                        <canvas id="chartKunjungan"></canvas>
                    </div>

                    <!-- Keterangan -->
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <strong>X-axis:</strong> Senin, Selasa, Rabu, Kamis, Jumat
                            </small>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <small class="text-muted">
                                <strong>Y-axis:</strong> 0, 5, 10, 15, 20
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
    // =============================================
    // DATA KUNJUNGAN (5 MINGGU)
    // =============================================
    
    var dataKunjungan = {
        // Minggu Ini (Agustus 2026)
        0: {
            label: 'Minggu Ini (23-27 Agustus 2026)',
            hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            jumlah: [12, 19, 15, 17, 20]
        },
        // 1 Minggu Lalu
        '-1': {
            label: 'Minggu Lalu (16-20 Agustus 2026)',
            hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            jumlah: [8, 14, 11, 16, 13]
        },
        // 2 Minggu Lalu
        '-2': {
            label: '2 Minggu Lalu (9-13 Agustus 2026)',
            hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            jumlah: [10, 7, 9, 12, 8]
        },
        // 3 Minggu Lalu
        '-3': {
            label: '3 Minggu Lalu (2-6 Agustus 2026)',
            hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            jumlah: [6, 11, 8, 10, 9]
        },
        // Minggu Depan
        '1': {
            label: 'Minggu Depan (30-3 September 2026)',
            hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            jumlah: [18, 22, 20, 25, 23]
        }
    };

    // =============================================
    // VARIABEL GLOBAL
    // =============================================
    
    var chart = null;
    var mingguSekarang = 0;

    // Warna untuk setiap hari
    var warna = [
        'rgba(78, 115, 223, 0.7)',  // Senin - Biru
        'rgba(28, 200, 138, 0.7)',  // Selasa - Hijau
        'rgba(54, 185, 204, 0.7)',  // Rabu - Cyan
        'rgba(246, 194, 62, 0.7)',  // Kamis - Kuning
        'rgba(231, 74, 59, 0.7)'    // Jumat - Merah
    ];

    var borderWarna = [
        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'
    ];

    // =============================================
    // FUNGSI UTAMA
    // =============================================
    
    $(document).ready(function() {
        tampilkanTanggal();
        buatChart(0);
    });

    // =============================================
    // FUNGSI TANGGAL
    // =============================================
    
    function tampilkanTanggal() {
        var now = new Date();
        var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        var tanggal = hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulan[now.getMonth()] + ' ' + now.getFullYear();
        var jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
        
        document.getElementById('currentDateDisplay').textContent = tanggal + ' | ' + jam + ' WIB';
    }

    // =============================================
    // FUNGSI CHART
    // =============================================
    
    function buatChart(offset) {
        mingguSekarang = offset;
        var key = offset.toString();
        var data = dataKunjungan[key];
        
        // Kalau data tidak ada, pakai minggu ini
        if (!data) {
            data = dataKunjungan['0'];
            document.getElementById('labelMinggu').textContent = '⚠️ Data tidak tersedia, menampilkan minggu ini';
        } else {
            document.getElementById('labelMinggu').textContent = data.label;
        }

        // Hapus chart lama
        if (chart) {
            chart.destroy();
        }

        // Buat chart baru
        var ctx = document.getElementById('chartKunjungan').getContext('2d');
        
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.hari,
                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: data.jumlah,
                    backgroundColor: warna,
                    borderColor: borderWarna,
                    borderWidth: 2,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 25,
                        ticks: {
                            stepSize: 5
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // =============================================
    // FUNGSI GANTI MINGGU
    // =============================================
    
    function gantiMinggu(nilai) {
        buatChart(nilai);
        
        // Kasih tahu user minggu apa yang ditampilkan
        var pesan = '';
        if (nilai === -3) pesan = 'Menampilkan 3 minggu lalu';
        else if (nilai === -2) pesan = 'Menampilkan 2 minggu lalu';
        else if (nilai === -1) pesan = 'Menampilkan minggu lalu';
        else if (nilai === 0) pesan = 'Menampilkan minggu ini';
        else if (nilai === 1) pesan = 'Menampilkan minggu depan';
        
        // Notifikasi sederhana
        var notif = document.createElement('div');
        notif.className = 'alert alert-info alert-dismissible fade show position-fixed';
        notif.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
        notif.innerHTML = pesan + ' <button type="button" class="close" data-dismiss="alert">&times;</button>';
        document.body.appendChild(notif);
        
        setTimeout(function() {
            if (notif.parentNode) notif.remove();
        }, 2000);
    }
</script>
@endpush