@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">

    <!-- Judul -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kunjungan Perpustakaan</h1>
        <span class="badge badge-primary p-2" id="tampilTanggal"></span>
    </div>

    <!-- 2 Card Statistik -->
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" onclick="detailHari()" style="cursor: pointer;">
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
            <div class="card border-left-success shadow h-100 py-2" onclick="detailBulan()" style="cursor: pointer;">
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
                    
                    <!-- Tombol Ganti Minggu -->
                    <div class="mb-3">
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(-3)">
                            3 Minggu Lalu
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(-2)">
                            2 Minggu Lalu
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(-1)">
                            Minggu Lalu
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="gantiMinggu(0)">
                            Minggu Ini
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="gantiMinggu(1)">
                            Minggu Depan
                        </button>
                        <span class="ml-2 text-muted" id="labelMinggu">Minggu Ini (23-27 Agustus 2026)</span>
                    </div>

                    <!-- Tempat Grafik -->
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

<!-- CSS Sederhana -->
<style>
    /* Efek saat kursor di atas card */
    .card {
        transition: 0.3s;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    /* Efek saat tombol diklik */
    .btn:active {
        transform: scale(0.95);
    }
</style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// ============================================
// DATA KUNJUNGAN
// ============================================

// Data untuk 5 minggu
var dataMinggu = {
    0: {
        label: 'Minggu Ini (23-27 Agustus 2026)',
        hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        jumlah: [12, 19, 15, 17, 20]
    },
    '-1': {
        label: 'Minggu Lalu (16-20 Agustus 2026)',
        hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        jumlah: [8, 14, 11, 16, 13]
    },
    '-2': {
        label: '2 Minggu Lalu (9-13 Agustus 2026)',
        hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        jumlah: [10, 7, 9, 12, 8]
    },
    '-3': {
        label: '3 Minggu Lalu (2-6 Agustus 2026)',
        hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        jumlah: [6, 11, 8, 10, 9]
    },
    '1': {
        label: 'Minggu Depan (30-3 September 2026)',
        hari: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        jumlah: [18, 22, 20, 25, 23]
    }
};

// ============================================
// VARIABEL
// ============================================

var grafik = null;
var mingguAktif = 0;

// Warna untuk grafik
var warnaGrafik = [
    'rgba(78, 115, 223, 0.7)',
    'rgba(28, 200, 138, 0.7)',
    'rgba(54, 185, 204, 0.7)',
    'rgba(246, 194, 62, 0.7)',
    'rgba(231, 74, 59, 0.7)'
];

// ============================================
// FUNGSI UTAMA
// ============================================

// Saat halaman dimuat
$(document).ready(function() {
    tampilkanTanggal();
    buatGrafik(0);
});

// ============================================
// FUNGSI TANGGAL
// ============================================

function tampilkanTanggal() {
    var sekarang = new Date();
    var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    var tanggal = namaHari[sekarang.getDay()] + ', ' + 
                  sekarang.getDate() + ' ' + 
                  namaBulan[sekarang.getMonth()] + ' ' + 
                  sekarang.getFullYear();
    
    var jam = sekarang.getHours().toString().padStart(2, '0') + ':' + 
              sekarang.getMinutes().toString().padStart(2, '0');
    
    document.getElementById('tampilTanggal').textContent = tanggal + ' | ' + jam + ' WIB';
}

// ============================================
// FUNGSI GRAFIK
// ============================================

function buatGrafik(offset) {
    mingguAktif = offset;
    var key = offset.toString();
    var data = dataMinggu[key];
    
    // Kalau data tidak ada, pakai minggu ini
    if (!data) {
        data = dataMinggu['0'];
        document.getElementById('labelMinggu').textContent = '⚠️ Data tidak tersedia';
    } else {
        document.getElementById('labelMinggu').textContent = data.label;
    }

    // Hapus grafik lama
    if (grafik) {
        grafik.destroy();
    }

    // Buat grafik baru
    var ctx = document.getElementById('chartKunjungan').getContext('2d');
    
    grafik = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.hari,
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: data.jumlah,
                backgroundColor: warnaGrafik,
                borderColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                borderWidth: 2
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
    
    // Beri tahu user
    tampilPesan('Menampilkan ' + data.label, 'info');
}

// ============================================
// FUNGSI GANTI MINGGU
// ============================================

function gantiMinggu(nilai) {
    buatGrafik(nilai);
}

// ============================================
// FUNGSI DETAIL CARD
// ============================================

function detailHari() {
    var sekarang = new Date();
    var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    alert('📋 Detail Kunjungan Hari Ini\n\n' +
          '📅 ' + namaHari[sekarang.getDay()] + ', ' + 
          sekarang.getDate() + ' ' + namaBulan[sekarang.getMonth()] + ' ' + 
          sekarang.getFullYear() + '\n' +
          '👥 Total: 20 Orang\n\n' +
          '🕐 Rincian Waktu:\n' +
          '• Pagi (08:00-12:00): 8 orang\n' +
          '• Siang (12:00-15:00): 7 orang\n' +
          '• Sore (15:00-17:00): 5 orang');
}

function detailBulan() {
    var sekarang = new Date();
    var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    alert('📋 Detail Kunjungan Bulan Ini\n\n' +
          '📅 ' + namaBulan[sekarang.getMonth()] + ' ' + sekarang.getFullYear() + '\n' +
          '👥 Total: 95 Orang\n\n' +
          '📊 Statistik:\n' +
          '• Rata-rata per hari: 19 orang\n' +
          '• Hari tersibuk: Kamis (22 orang)\n' +
          '• Hari sepi: Senin (12 orang)');
}

// ============================================
// FUNGSI MENU
// ============================================

function klikMenu(jenis) {
    if (jenis === 'arsip') {
        tampilPesan('📁 Membuka Arsip Kunjungan...', 'info');
    } else if (jenis === 'profile') {
        tampilPesan('👤 Membuka Ubah Profile...', 'info');
    } else if (jenis === 'logout') {
        if (confirm('Yakin ingin logout?')) {
            tampilPesan('🚪 Logout berhasil', 'success');
        }
    }
}

// ============================================
// FUNGSI PESAN
// ============================================

function tampilPesan(pesan, jenis) {
    // Buat elemen pesan
    var kotakPesan = document.createElement('div');
    kotakPesan.className = 'alert alert-' + jenis + ' alert-dismissible fade show';
    kotakPesan.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 250px;';
    kotakPesan.innerHTML = pesan + ' <button type="button" class="close" onclick="this.parentElement.remove()">&times;</button>';
    document.body.appendChild(kotakPesan);
    
    // Hapus setelah 2 detik
    setTimeout(function() {
        if (kotakPesan.parentNode) {
            kotakPesan.remove();
        }
    }, 2000);
}
</script>
@endpush