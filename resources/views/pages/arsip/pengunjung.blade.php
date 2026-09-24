@extends('layouts.app')

@section('title', 'Daftar Pengunjung')

@section('content')

<style>

    /* =========================
       DAFTAR PENGUNJUNG
    ========================= */

    .pengunjung-card {
        border-left: 4px solid #d18eae;
        border-radius: 12px;
        overflow: hidden;
    }


    .pengunjung-card .card-header {
        background: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }


    .text-pink {
        color: #d18eae !important;
    }


    /* =========================
       ICON HEADER
    ========================= */

    .header-icon {
        width: 45px;
        height: 45px;
        background-color: #d18eae;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 14px;
        font-size: 18px;
    }


    /* =========================
       BADGE BULAN
    ========================= */

    .badge-pink {
        background: #d18eae;
        color: white;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 13px;
        white-space: nowrap;
    }


    /* =========================
       SEARCH
    ========================= */

    .search-wrapper {
        position: relative;
        width: 260px;
    }


    .search-wrapper i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #858796;
        font-size: 14px;
    }


    .search-wrapper input {
        width: 100%;
        height: 38px;
        border: 1px solid #d9dce3;
        border-radius: 8px;
        padding: 8px 12px 8px 36px;
        font-size: 13px;
        outline: none;
        transition: 0.2s;
    }


    .search-wrapper input:focus {
        border-color: #d18eae;
        box-shadow: 0 0 0 2px rgba(209, 142, 174, 0.15);
    }


    /* =========================
       TABEL
    ========================= */

    .table {
        margin-bottom: 0;
    }


    .table thead th {
        background-color: #dfb4c8;
        color: #5a5c69;
        border-color: #d18eae;
        font-size: 13px;
        font-weight: 600;
        vertical-align: middle;
        padding: 13px 12px;
    }


    .table tbody td {
        font-size: 13px;
        color: #5a5c69;
        vertical-align: middle;
        padding: 13px 12px;
        border-color: #e3e6f0;
    }


    .table tbody tr:hover {
        background-color: #f9edf2;
    }


    /* =========================
       NOMOR
    ========================= */

    .nomor {
        font-weight: 600;
        color: #858796;
    }


    /* =========================
       JUMLAH KUNJUNGAN
       TANPA LINGKARAN
    ========================= */

    .jumlah-badge {
        display: inline;
        padding: 0;
        background-color: transparent;
        color: #000;
        border-radius: 0;
        font-weight: 600;
    }


    /* =========================
       TOMBOL KEMBALI
    ========================= */

    .btn-kembali {
        background: #d18eae;
        color: white !important;
        border: none;
        border-radius: 8px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s;
    }


    .btn-kembali:hover {
        background: #c77fa2;
        color: white !important;
        transform: translateY(-1px);
    }


    /* =========================
       HASIL PENCARIAN KOSONG
    ========================= */

    #noSearchResult {
        display: none;
        text-align: center;
        padding: 25px;
        color: #858796;
        font-size: 13px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .pengunjung-card .card-header {
            flex-wrap: wrap;
        }


        .header-title {
            margin-bottom: 12px;
        }


        .header-right {
            width: 100%;
            margin-left: 0 !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .search-wrapper {
            width: 60%;
        }


        .table {
            min-width: 700px;
        }

    }


    @media (max-width: 480px) {

        .header-right {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }


        .search-wrapper {
            width: 100%;
        }


        .badge-pink {
            width: fit-content;
        }

    }

</style>


<div class="container-fluid">


    {{-- Breadcrumb --}}

    <div class="mb-4">

        <small class="font-weight-bold text-secondary">

            <i class="fas fa-chevron-right text-pink mr-1"></i>

            Arsip Kunjungan

            <span class="mx-1">></span>

            Detail Arsip Kunjungan

            <span class="mx-1">></span>

            Daftar Pengunjung

        </small>

    </div>


    {{-- Card --}}

    <div class="card shadow mb-4 pengunjung-card">


        {{-- Header --}}

        <div class="card-header py-3 d-flex align-items-center">


            <div class="header-icon">

                <i class="fas fa-users"></i>

            </div>


            <div class="header-title">

                <h5 class="m-0 font-weight-bold text-pink">

                    Daftar Pengunjung

                </h5>


                <small class="text-muted">

                    Daftar pengunjung perpustakaan

                </small>

            </div>


            <div class="header-right ml-auto d-flex align-items-center">


                {{-- Search --}}

                <div class="search-wrapper mr-3">

                    <i class="fas fa-search"></i>

                    <input
                        type="text"
                        id="searchPengunjung"
                        placeholder="Cari NIP/NISN, Nama..."
                    >

                </div>


                {{-- Bulan dan Tahun --}}

                <span class="badge-pink">

                    @php

                        $bulanIndonesia = [

                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember'

                        ];


                        $bulanAngka = (int) $bulan;

                        $namaBulan =
                            $bulanIndonesia[$bulanAngka] ?? $bulan;

                    @endphp

                    {{ $namaBulan }} {{ $tahun }}

                </span>

            </div>

        </div>


        {{-- Body --}}

        <div class="card-body">


            {{-- Informasi --}}

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>

                    <span
                        class="text-muted"
                        style="font-size: 13px;"
                    >

                        Data pengunjung pada

                        <strong class="text-pink">

                            {{ $namaBulan }} {{ $tahun }}

                        </strong>

                    </span>

                </div>


                <div>

                    <span
                        id="totalPengunjung"
                        class="text-muted"
                        style="font-size: 13px;"
                    >

                        Total:

                        <strong class="text-pink">

                            {{ count($dataPengunjung) }}

                        </strong>

                        pengunjung

                    </span>

                </div>

            </div>


            {{-- Tabel --}}

            <div class="table-responsive">

                <table
                    class="table table-bordered"
                    id="pengunjungTable"
                >

                    <thead>

                        <tr>

                            <th
                                width="60"
                                class="text-center"
                            >

                                No

                            </th>


                            <th>

                                Nama Pengunjung

                            </th>


                            <th
                                width="150"
                                class="text-center"
                            >

                                Jumlah Kunjungan

                            </th>


                            <th width="170">

                                NISN / NIP

                            </th>


                            <th>

                                Kelas / Jabatan

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($dataPengunjung as $index => $pengunjung)

                            <tr>


                                <td class="text-center nomor">

                                    {{ $index + 1 }}

                                </td>


                                <td>

                                    <strong>

                                        {{ $pengunjung['nama'] ?? '-' }}

                                    </strong>

                                </td>


                                <td class="text-center">

                                    <span class="jumlah-badge">

                                        {{ $pengunjung['jumlah_kunjungan'] ?? 0 }}

                                    </span>

                                </td>


                                <td>

                                    {{ $pengunjung['nisn_nip'] ?? '-' }}

                                </td>


                                <td>

                                    {{ $pengunjung['kelas_jabatan'] ?? '-' }}

                                </td>


                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center text-muted py-4"
                                >

                                    <i
                                        class="fas fa-users-slash mb-2"
                                        style="font-size: 25px;"
                                    ></i>

                                    <br>

                                    Belum ada data pengunjung.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>


                {{-- Jika pencarian tidak menemukan data --}}

                <div id="noSearchResult">

                    <i
                        class="fas fa-search mb-2"
                        style="font-size: 22px;"
                    ></i>

                    <br>

                    Data pengunjung tidak ditemukan.

                </div>

            </div>


            {{-- Tombol Kembali --}}

            <div class="d-flex justify-content-end mt-4">

                <a
                    href="{{ route('admin.arsip.show', ['tahun' => $tahun, 'bulan' => $bulan]) }}"
                    class="btn btn-kembali"
                >

                    <i class="fas fa-arrow-left mr-2"></i>

                    Kembali ke Detail Arsip

                </a>

            </div>

        </div>

    </div>

</div>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const searchInput =
            document.getElementById('searchPengunjung');


        const table =
            document.getElementById('pengunjungTable');


        const rows =
            table.querySelectorAll('tbody tr');


        const totalPengunjung =
            document.getElementById('totalPengunjung');


        const noSearchResult =
            document.getElementById('noSearchResult');


        searchInput.addEventListener('keyup', function () {

            const keyword =
                this.value.toLowerCase().trim();


            let jumlahTampil = 0;


            rows.forEach(function (row) {

                const text =
                    row.innerText.toLowerCase();


                if (text.includes(keyword)) {

                    row.style.display = '';

                    jumlahTampil++;

                } else {

                    row.style.display = 'none';

                }

            });


            totalPengunjung.innerHTML =
                'Total: <strong class="text-pink">'
                + jumlahTampil +
                '</strong> pengunjung';


            if (
                jumlahTampil === 0 &&
                keyword !== ''
            ) {

                noSearchResult.style.display = 'block';

            } else {

                noSearchResult.style.display = 'none';

            }

        });

    });

</script>


@endsection