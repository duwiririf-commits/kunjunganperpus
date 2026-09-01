<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $bulan = $request->get('bulan', now()->month);

        $namaBulan = [
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
            12 => 'Desember',
        ];

        $arsips = Kunjungan::selectRaw('
                MONTH(tanggal_kunjungan) as bulan,
                YEAR(tanggal_kunjungan) as tahun,
                COUNT(*) as total_pengunjung
            ')
            ->whereYear('tanggal_kunjungan', $tahun)
            ->groupByRaw('MONTH(tanggal_kunjungan), YEAR(tanggal_kunjungan)')
            ->orderBy('bulan')
            ->get();

        $totalKunjungan = Kunjungan::whereYear(
            'tanggal_kunjungan',
            $tahun
        )->count();

        $totalBulan = Kunjungan::whereYear(
            'tanggal_kunjungan',
            $tahun
        )
        ->whereMonth(
            'tanggal_kunjungan',
            $bulan
        )
        ->count();

        $bulanTerakhir = $namaBulan[$bulan];

        $tahunTersedia = Kunjungan::selectRaw(
            'YEAR(tanggal_kunjungan) as tahun'
        )
        ->distinct()
        ->orderByDesc('tahun')
        ->pluck('tahun');

        if ($tahunTersedia->isEmpty()) {
            $tahunTersedia = collect([
                now()->year
            ]);
        }

        return view(
            'pages.arsip.index',
            compact(
                'arsips',
                'tahun',
                'bulan',
                'namaBulan',
                'totalKunjungan',
                'totalBulan',
                'bulanTerakhir',
                'tahunTersedia'
            )
        );
    }
}