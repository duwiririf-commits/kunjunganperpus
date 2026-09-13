@extends('layouts.app')

@section('title', 'Arsip Kunjungan')

@section('content')

<style>

    body,
    #content-wrapper {
        background: #f3f4f8 !important;
    }

    .arsip-page {
        padding: 25px 20px;
    }

    /* =========================
       HEADER
    ========================= */

    .arsip-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .arsip-title {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #202633;
    }

    /* =========================
       FILTER
    ========================= */

    .arsip-filter {
        display: flex;
        gap: 12px;
    }

    .filter-form {
        margin: 0;
    }

    .filter-select {
        height: 42px;
        padding: 0 15px;
        border: none;
        border-radius: 10px;
        background: #ffffff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        font-size: 15px;
        font-weight: 600;
        color: #303541;
        cursor: pointer;
    }

    /* =========================
       STATISTIC CARD
    ========================= */

    .arsip-statistic {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 18px;
    }

    .arsip-card {
        min-height: 88px;
        display: flex;
        align-items: center;
        padding: 15px 18px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow:
            0 3px 12px
            rgba(0, 0, 0, 0.08);
    }

    .arsip-card-icon {
        width: 58px;
        height: 58px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 14px;
        border-radius: 10px;
        background: #efd5df;
        color: #c67d9c;
        font-size: 28px;
    }

    .arsip-card-content {
        display: flex;
        flex-direction: column;
    }

    .arsip-card-label {
        font-size: 14px;
        color: #444;
        margin-bottom: 3px;
    }

    .arsip-card-value {
        font-size: 20px;
        font-weight: 700;
        color: #202633;
    }

    /* =========================
       TABLE
    ========================= */

    .arsip-table-card {
        overflow: hidden;
        background: #ffffff;
        border-radius: 16px;
        box-shadow:
            0 3px 12px
            rgba(0, 0, 0, 0.08);
    }

    .arsip-table {
        margin: 0;
    }

    .arsip-table thead th {
        padding: 17px 12px;
        background: #d7b0c1;
        border: none;
        color: #252525;
        font-size: 15px;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
    }

    .arsip-table tbody td {
        padding: 16px 12px;
        border-color: #eeeeee;
        color: #252b36;
        font-size: 15px;
        text-align: center;
        vertical-align: middle;
    }

    .arsip-table tbody tr:hover {
        background: #fff8fb;
    }

    /* =========================
       ACTION BUTTON
    ========================= */

    .arsip-action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-detail-arsip {
        display: inline-flex;
        justify-content: center;
        align-items: center;

        width: 38px;
        height: 38px;

        border: none;
        border-radius: 8px;

        background: transparent;
        color: #666;

        font-size: 20px;
        text-decoration: none;

        transition: 0.2s;
    }

    .btn-detail-arsip:hover {
        color: #c7809b;
        background: #fff0f5;
        transform: scale(1.1);
        text-decoration: none;
    }

    /* =========================
       BOTTOM TABLE
    ========================= */

    .arsip-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;

        padding: 20px;

        font-size: 15px;
        font-weight: 600;

        color: #202633;
    }

    .arsip-pagination {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pagination-number {
        min-width: 28px;
        height: 28px;

        display: flex;
        justify-content: center;
        align-items: center;

        border: 1px solid #ddd;

        background: #ffffff;
        color: #333;

        text-decoration: none;
    }

    .pagination-number.active {
        background: #d7b0c1;
        border-color: #d7b0c1;
    }

    /* =========================
       EMPTY DATA
    ========================= */

    .empty-data {
        padding: 35px !important;
        color: #777 !important;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .arsip-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .arsip-filter {
            width: 100%;
            flex-direction: column;
        }

        .filter-form,
        .filter-select {
            width: 100%;
        }

        .arsip-statistic {
            grid-template-columns: 1fr;
        }

        .arsip-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

    }

</style>


<div class="arsip-page">

    {{-- =========================
       HEADER
    ========================= --}}

    <div class="arsip-header">

        <h1 class="arsip-title">
            Arsip Kunjungan
        </h1>

        <div class="arsip-filter">

            {{-- FILTER TAHUN --}}

            <form
                action="{{ route('admin.arsip.index') }}"
                method="GET"
                class="filter-form"
            >

                <select
                    name="tahun"
                    class="filter-select"
                    onchange="this.form.submit()"
                >

                    @foreach ($tahunTersedia as $itemTahun)

                        <option
                            value="{{ $itemTahun }}"
                            {{ $tahun == $itemTahun ? 'selected' : '' }}
                        >
                            📅 {{ $itemTahun }}
                        </option>

                    @endforeach

                </select>

            </form>

        </div>

    </div>


    {{-- =========================
       STATISTIK
    ========================= --}}

    <div class="arsip-statistic">

        {{-- TAHUN --}}

        <div class="arsip-card">

            <div class="arsip-card-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>

            <div class="arsip-card-content">

                <div class="arsip-card-label">
                    Tahun
                </div>

                <div class="arsip-card-value">
                    {{ $tahun }}
                </div>

            </div>

        </div>


        {{-- TOTAL KUNJUNGAN --}}

        <div class="arsip-card">

            <div class="arsip-card-icon">
                <i class="fas fa-users"></i>
            </div>

            <div class="arsip-card-content">

                <div class="arsip-card-label">
                    Total Kunjungan
                </div>

                <div class="arsip-card-value">
                    {{ $totalKunjungan }}
                </div>

            </div>

        </div>


        {{-- BULAN TERTINGGI --}}

        <div class="arsip-card">

            <div class="arsip-card-icon">
                <i class="fas fa-chart-bar"></i>
            </div>

            <div class="arsip-card-content">

                <div class="arsip-card-label">
                    Bulan Tertinggi
                </div>

                <div class="arsip-card-value">
                    {{ $bulanTerakhir }}
                </div>

            </div>

        </div>

    </div>


    {{-- =========================
       TABEL ARSIP
    ========================= --}}

    <div class="arsip-table-card">

        <div class="table-responsive">

            <table class="table arsip-table">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Total Pengunjung</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse ($arsips as $index => $arsip)

                        <tr>

                            {{-- NOMOR --}}

                            <td>
                                {{ $index + 1 }}
                            </td>


                            {{-- BULAN --}}

                            <td>
                                {{ $namaBulan[$arsip->bulan] ?? '-' }}
                            </td>


                            {{-- TAHUN --}}

                            <td>
                                {{ $arsip->tahun }}
                            </td>


                            {{-- TOTAL PENGUNJUNG --}}

                            <td>
                                {{ $arsip->total_pengunjung }}
                            </td>


                            {{-- AKSI --}}

                            <td>

                                <div class="arsip-action-buttons">

                                    {{-- DETAIL ARSIP --}}

                                    <a
                                        href="{{ route('admin.arsip.show', [
                                            'tahun' => $arsip->tahun,
                                            'bulan' => $arsip->bulan
                                        ]) }}"
                                        class="btn-detail-arsip"
                                        title="Detail Arsip"
                                    >

                                        <i class="fas fa-file-alt"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="empty-data text-center"
                            >
                                Belum ada arsip kunjungan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================
       FOOTER TABEL
    ========================= --}}

    <div class="arsip-footer">

        <div>

            Showing

            @if ($arsips->count() > 0)

                1 to {{ $arsips->count() }}

            @else

                0

            @endif

            of {{ $arsips->count() }} entries

        </div>


        <div class="arsip-pagination">

            <span>&lt;</span>

            <span class="pagination-number active">
                1
            </span>

            <span>&gt;</span>

        </div>

    </div>


</div>

@endsection