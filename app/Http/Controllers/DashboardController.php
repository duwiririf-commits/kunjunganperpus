<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // tanggal hari ini
        $hariIni = Carbon::today();

        // total kunjungan hari ini
        $totalHariIni = Kunjungan::whereDate('tanggal_kunjungan', $hariIni)->count();

        // awal & akhir minggu (Senin - Minggu)
        $awalMinggu = $hariIni->copy()->startOfWeek(Carbon::MONDAY);
        $akhirMinggu = $hariIni->copy()->endOfWeek(Carbon::SUNDAY);

        // total kunjungan minggu ini
        $totalMingguIni = Kunjungan::whereBetween('tanggal_kunjungan', [
            $awalMinggu->toDateString(),
            $akhirMinggu->toDateString()
        ])->count();

        // label grafik (Senin - Minggu)
        $labels = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        ];

        // ambil jumlah kunjungan tiap hari dalam seminggu
        $dataGrafik = [];

        for ($i = 0; $i < 7; $i++) {
            $tanggal = $awalMinggu->copy()->addDays($i);

            $jumlah = Kunjungan::whereDate('tanggal_kunjungan', $tanggal)->count();

            $dataGrafik[] = $jumlah;
        }

        return view('pages.dashboard', compact(
            'totalHariIni',
            'totalMingguIni',
            'labels',
            'dataGrafik'
        ));
    }
}