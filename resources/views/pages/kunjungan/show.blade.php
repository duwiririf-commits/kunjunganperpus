@extends('layouts.app')

@section('title', 'Detail Kunjungan')

@section('content')

<div class="container-fluid">

    {{-- Breadcrumb --}}
    <div class="mb-4">
        <small class="font-weight-bold text-secondary">
            <i class="fas fa-chevron-right text-pink" style="font-size: 10px;"></i>
            Data Kunjungan &gt; Detail Kunjungan
        </small>
    </div>

    {{-- Card Utama --}}
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex align-items-center">

            <div class="bg-pink text-white rounded-circle p-2 mr-3"
                style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">

                <i class="fas fa-book-reader"></i>

            </div>

            <div>

                <h5 class="m-0 font-weight-bold text-pink">
                    Detail Kunjungan
                </h5>

                <small class="text-muted">
                    Informasi lengkap data kunjungan perpustakaan
                </small>

            </div>

            <div class="ml-auto">

                <span class="badge badge-pill bg-pink text-white px-3 py-2">

                    <i class="far fa-calendar-alt mr-1"></i>

                    {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d M Y') }}

                </span>

            </div>

        </div>


        <div class="card-body">

            {{-- Detail Data --}}
            <div class="detail-kunjungan">

                <div class="detail-row">

                    <div class="detail-label">
                        NIP/NISN
                    </div>

                    <div class="detail-titik">
                        :
                    </div>

                    <div class="detail-value">

                        <span class="font-weight-bold text-dark">

                            {{ $kunjungan->pengunjung->nisn_nip ?? '-' }}

                        </span>

                    </div>

                </div>


                <div class="detail-row">

                    <div class="detail-label">
                        Nama
                    </div>

                    <div class="detail-titik">
                        :
                    </div>

                    <div class="detail-value">

                        <span class="font-weight-bold text-dark">

                            {{ $kunjungan->pengunjung->nama ?? '-' }}

                        </span>

                    </div>

                </div>


                <div class="detail-row">

                    <div class="detail-label">
                        Kelas/Jabatan
                    </div>

                    <div class="detail-titik">
                        :
                    </div>

                    <div class="detail-value">

                        <span class="font-weight-bold text-dark">

                            {{ $kunjungan->pengunjung->kelas_jabatan ?? '-' }}

                        </span>

                    </div>

                </div>


                <div class="detail-row">

                    <div class="detail-label">
                        Tanggal
                    </div>

                    <div class="detail-titik">
                        :
                    </div>

                    <div class="detail-value">

                        <span class="font-weight-bold text-dark">

                            {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('M d, Y') }}

                        </span>

                    </div>

                </div>


                <div class="detail-row">

                    <div class="detail-label">
                        Keperluan
                    </div>

                    <div class="detail-titik">
                        :
                    </div>

                    <div class="detail-value">

                        <span class="font-weight-bold text-dark">

                            {{ $kunjungan->keperluan ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Tombol Kembali --}}
    <div class="mt-4 text-right">

        <a href="{{ route('admin.kunjungan.index') }}"
           class="btn btn-pink font-weight-bold">

            <i class="fas fa-arrow-left mr-2"></i>

            Kembali ke Data Kunjungan

        </a>

    </div>

</div>


@push('styles')

<style>

    /* Warna Pink */

    .text-pink {
        color: #d18eae !important;
    }


    .bg-pink {
        background-color: #d18eae !important;
    }


    .btn-pink {
        background: #d18eae;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 30px;
        transition: all 0.3s ease;
    }


    .btn-pink:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(209, 142, 174, 0.35);
        background: #c77fa2;
        color: #fff;
    }


    .detail-kunjungan {
        max-width: 100%;
        padding: 5px 0;
    }


    .detail-row {
        display: flex;
        align-items: center;
        min-height: 50px;
        padding: 10px 15px;
        border-bottom: 2px solid #e3e6f0;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
    }


    .detail-row:last-child {
        border-bottom: none;
    }


    .detail-row:hover {
        background-color: #fff;
        border-radius: 8px;
        margin: 0 -5px;
        padding-left: 20px;
        padding-right: 20px;
    }


    .detail-label {
        width: 130px;
        color: #5a5c69;
        font-weight: 600;
        letter-spacing: 0.3px;
    }


    .detail-titik {
        width: 30px;
        text-align: center;
        color: #858796;
        font-weight: 300;
    }


    .detail-value {
        flex: 1;
        color: #2d3748;
        font-weight: 500;
    }


    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        border-left: 4px solid #d18eae !important;
    }


    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
        border-radius: 12px 12px 0 0 !important;
    }


    .card-body {
        padding: 20px 25px;
    }


    .badge-pink {
        background: #d18eae;
        font-weight: 600;
        color: #fff;
        padding: 8px 18px;
        border-radius: 20px;
    }


    /* Responsive */

    @media (max-width: 576px) {

        .detail-row {
            flex-wrap: wrap;
            min-height: auto;
            padding: 10px 10px;
        }


        .detail-label {
            width: 100%;
            font-size: 12px;
            color: #858796;
            margin-bottom: 2px;
        }


        .detail-titik {
            display: none;
        }


        .detail-value {
            width: 100%;
            font-size: 14px;
            padding-left: 0;
        }


        .detail-row:hover {
            margin: 0;
            padding-left: 10px;
            padding-right: 10px;
        }


        .card-body {
            padding: 15px;
        }


        .btn-pink {
            width: 100%;
            text-align: center;
        }


        .card-header {
            flex-wrap: wrap;
        }


        .card-header .ml-auto {
            margin-left: 0 !important;
            margin-top: 10px;
            width: 100%;
        }


        .badge-pink {
            width: 100%;
            text-align: center;
        }

    }

</style>

@endpush

@endsection