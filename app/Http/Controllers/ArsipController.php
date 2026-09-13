<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN ARSIP
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $tahun = $request->get(
            'tahun',
            Carbon::now()->year
        );

        $bulan = $request->get(
            'bulan',
            Carbon::now()->month
        );

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

        /*
        |--------------------------------------------------------------------------
        | TAHUN YANG TERSEDIA
        |--------------------------------------------------------------------------
        */

        $tahunTersedia = Kunjungan::selectRaw(
            'YEAR(tanggal_kunjungan) as tahun'
        )
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        if ($tahunTersedia->isEmpty()) {
            $tahunTersedia = collect([
                Carbon::now()->year
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | DATA ARSIP PER BULAN
        |--------------------------------------------------------------------------
        */

        $arsips = Kunjungan::selectRaw('
                YEAR(tanggal_kunjungan) as tahun,
                MONTH(tanggal_kunjungan) as bulan,
                COUNT(*) as total_pengunjung
            ')
            ->whereYear(
                'tanggal_kunjungan',
                $tahun
            )
            ->groupBy(
                'tahun',
                'bulan'
            )
            ->orderBy(
                'bulan',
                'asc'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TOTAL KUNJUNGAN DALAM 1 TAHUN
        |--------------------------------------------------------------------------
        */

        $totalKunjungan = Kunjungan::whereYear(
            'tanggal_kunjungan',
            $tahun
        )->count();

        /*
        |--------------------------------------------------------------------------
        | BULAN DENGAN KUNJUNGAN TERTINGGI
        |--------------------------------------------------------------------------
        */

        $bulanTertinggiData = Kunjungan::selectRaw('
                MONTH(tanggal_kunjungan) as bulan,
                COUNT(*) as total
            ')
            ->whereYear(
                'tanggal_kunjungan',
                $tahun
            )
            ->groupBy('bulan')
            ->orderByDesc('total')
            ->first();

        if ($bulanTertinggiData) {
            $bulanTerakhir =
                $namaBulan[$bulanTertinggiData->bulan];
        } else {
            $bulanTerakhir = '-';
        }

        return view(
            'pages.arsip.index',
            compact(
                'arsips',
                'tahun',
                'bulan',
                'tahunTersedia',
                'namaBulan',
                'totalKunjungan',
                'bulanTerakhir'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL ARSIP
    |--------------------------------------------------------------------------
    */

    public function show($tahun, $bulan)
    {
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

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA KUNJUNGAN BULAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $kunjungans = Kunjungan::with('pengunjung')
            ->whereYear(
                'tanggal_kunjungan',
                $tahun
            )
            ->whereMonth(
                'tanggal_kunjungan',
                $bulan
            )
            ->orderBy(
                'tanggal_kunjungan',
                'desc'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | KELOMPOKKAN BERDASARKAN NISN / NIP
        |--------------------------------------------------------------------------
        |
        | Jika orang yang sama memiliki beberapa data id_pengunjung,
        | tetap dihitung sebagai 1 orang berdasarkan NISN/NIP.
        |
        */

        $dataPengunjung = $kunjungans
            ->filter(function ($kunjungan) {
                return $kunjungan->pengunjung !== null;
            })
            ->groupBy(function ($kunjungan) {
                return trim(
                    $kunjungan->pengunjung->nisn_nip ?? ''
                );
            })
            ->map(function ($data) {

                $pengunjung =
                    $data->first()->pengunjung;

                return [
                    'id_pengunjung' =>
                        $pengunjung->id_pengunjung,

                    'nisn_nip' =>
                        $pengunjung->nisn_nip ?? '-',

                    'nama' =>
                        $pengunjung->nama ?? '-',

                    'kelas_jabatan' =>
                        $pengunjung->kelas_jabatan ?? '-',

                    'jumlah_kunjungan' =>
                        $data->count(),
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | TOTAL PENGUNJUNG
        |--------------------------------------------------------------------------
        */

        $totalPengunjung =
            $dataPengunjung->count();

        /*
        |--------------------------------------------------------------------------
        | PENGUNJUNG TERBANYAK
        |--------------------------------------------------------------------------
        */

        $pengunjungTerbanyakData =
            $dataPengunjung
                ->sortByDesc('jumlah_kunjungan')
                ->first();

        if ($pengunjungTerbanyakData) {

            $pengunjungTerbanyak =
                $pengunjungTerbanyakData['nama'];

            $jumlahKunjunganTerbanyak =
                $pengunjungTerbanyakData['jumlah_kunjungan'];

        } else {

            $pengunjungTerbanyak = '-';

            $jumlahKunjunganTerbanyak = 0;
        }

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE HALAMAN DETAIL
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.arsip.show',
            compact(
                'kunjungans',
                'dataPengunjung',
                'tahun',
                'bulan',
                'namaBulan',
                'totalPengunjung',
                'pengunjungTerbanyak',
                'jumlahKunjunganTerbanyak'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DAFTAR PENGUNJUNG
    |--------------------------------------------------------------------------
    */

    public function pengunjung($tahun, $bulan)
    {
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

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA KUNJUNGAN BULAN TERPILIH
        |--------------------------------------------------------------------------
        */

        $kunjungans = Kunjungan::with('pengunjung')
            ->whereYear(
                'tanggal_kunjungan',
                $tahun
            )
            ->whereMonth(
                'tanggal_kunjungan',
                $bulan
            )
            ->orderBy(
                'tanggal_kunjungan',
                'desc'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | KELOMPOKKAN PENGUNJUNG BERDASARKAN NISN / NIP
        |--------------------------------------------------------------------------
        */

        $dataPengunjung = $kunjungans
            ->filter(function ($kunjungan) {
                return $kunjungan->pengunjung !== null;
            })
            ->groupBy(function ($kunjungan) {
                return trim(
                    $kunjungan->pengunjung->nisn_nip ?? ''
                );
            })
            ->map(function ($data) {

                $pengunjung =
                    $data->first()->pengunjung;

                return [
                    'id_pengunjung' =>
                        $pengunjung->id_pengunjung,

                    'nisn_nip' =>
                        $pengunjung->nisn_nip ?? '-',

                    'nama' =>
                        $pengunjung->nama ?? '-',

                    'kelas_jabatan' =>
                        $pengunjung->kelas_jabatan ?? '-',

                    'jumlah_kunjungan' =>
                        $data->count(),
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | KIRIM KE HALAMAN DAFTAR PENGUNJUNG
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.arsip.pengunjung',
            compact(
                'tahun',
                'bulan',
                'namaBulan',
                'dataPengunjung'
            )
        );
    }
}