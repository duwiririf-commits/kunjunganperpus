<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ==============================
        // TANGGAL HARI INI
        // ==============================

        $hariIni = Carbon::today();


        // ==============================
        // TOTAL KUNJUNGAN HARI INI
        // ==============================

        $totalHariIni = Kunjungan::whereDate(
            'tanggal_kunjungan',
            $hariIni
        )->count();


        // ==============================
        // AWAL DAN AKHIR MINGGU
        // SENIN - MINGGU
        // ==============================

        $awalMinggu = $hariIni->copy()
            ->startOfWeek(Carbon::MONDAY);

        $akhirMinggu = $hariIni->copy()
            ->endOfWeek(Carbon::SUNDAY);


        // ==============================
        // TOTAL KUNJUNGAN MINGGU INI
        // ==============================

        $totalMingguIni = Kunjungan::whereBetween(
            'tanggal_kunjungan',
            [
                $awalMinggu->toDateString(),
                $akhirMinggu->toDateString()
            ]
        )->count();


        // ==============================
        // GRAFIK MINGGU INI
        // SENIN - MINGGU
        // ==============================

        $labels = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        ];


        $dataGrafik = [];


        // ==============================
        // MENGAMBIL DATA SETIAP HARI
        // ==============================

        for ($i = 0; $i < 7; $i++) {

            $tanggal = $awalMinggu->copy()
                ->addDays($i);

            $jumlah = Kunjungan::whereDate(
                'tanggal_kunjungan',
                $tanggal
            )->count();

            $dataGrafik[] = $jumlah;
        }


        // ==============================
        // KIRIM DATA KE DASHBOARD
        // ==============================

        return view('pages.dashboard', compact(
            'totalHariIni',
            'totalMingguIni',
            'labels',
            'dataGrafik'
        ));
    }
}
