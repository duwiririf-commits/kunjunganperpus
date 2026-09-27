<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    // halaman arsip
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', Carbon::now()->year);
        $bulan = $request->get('bulan', Carbon::now()->month);

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

        // tahun yang tersedia di database
        $tahunTersedia = Kunjungan::selectRaw('YEAR(tanggal_kunjungan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        if ($tahunTersedia->isEmpty()) {
            $tahunTersedia = collect([Carbon::now()->year]);
        }

        // data arsip per bulan
        $arsips = Kunjungan::selectRaw('
                YEAR(tanggal_kunjungan) as tahun,
                MONTH(tanggal_kunjungan) as bulan,
                COUNT(*) as total_pengunjung
            ')
            ->whereYear('tanggal_kunjungan', $tahun)
            ->groupBy('tahun', 'bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        // total kunjungan dalam 1 tahun
        $totalKunjungan = Kunjungan::whereYear('tanggal_kunjungan', $tahun)->count();

        // bulan dengan kunjungan tertinggi
        $bulanTertinggiData = Kunjungan::selectRaw('
                MONTH(tanggal_kunjungan) as bulan,
                COUNT(*) as total
            ')
            ->whereYear('tanggal_kunjungan', $tahun)
            ->groupBy('bulan')
            ->orderByDesc('total')
            ->first();

        if ($bulanTertinggiData) {
            $bulanTerakhir = $namaBulan[$bulanTertinggiData->bulan];
        } else {
            $bulanTerakhir = '-';
        }

        return view('pages.arsip.index', compact(
            'arsips',
            'tahun',
            'bulan',
            'tahunTersedia',
            'namaBulan',
            'totalKunjungan',
            'bulanTerakhir'
        ));
    }


    // detail arsip per bulan
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

        // ambil data kunjungan bulan terpilih
        $kunjungans = Kunjungan::with('pengunjung')
            ->whereYear('tanggal_kunjungan', $tahun)
            ->whereMonth('tanggal_kunjungan', $bulan)
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        // kelompokkan berdasarkan NISN/NIP
        // kalau orang yang sama punya beberapa id_pengunjung,
        // tetap dihitung 1 orang
        $dataPengunjung = $kunjungans
            ->filter(function ($kunjungan) {
                return $kunjungan->pengunjung !== null;
            })
            ->groupBy(function ($kunjungan) {
                return trim($kunjungan->pengunjung->nisn_nip ?? '');
            })
            ->map(function ($data) {
                $pengunjung = $data->first()->pengunjung;

                return [
                    'id_pengunjung' => $pengunjung->id_pengunjung,
                    'nisn_nip' => $pengunjung->nisn_nip ?? '-',
                    'nama' => $pengunjung->nama ?? '-',
                    'kelas_jabatan' => $pengunjung->kelas_jabatan ?? '-',
                    'jumlah_kunjungan' => $data->count(),
                ];
            })
            ->values();

        // total pengunjung unik
        $totalPengunjung = $dataPengunjung->count();

        // pengunjung paling sering datang
        $pengunjungTerbanyakData = $dataPengunjung
            ->sortByDesc('jumlah_kunjungan')
            ->first();

        if ($pengunjungTerbanyakData) {
            $pengunjungTerbanyak = $pengunjungTerbanyakData['nama'];
            $jumlahKunjunganTerbanyak = $pengunjungTerbanyakData['jumlah_kunjungan'];
        } else {
            $pengunjungTerbanyak = '-';
            $jumlahKunjunganTerbanyak = 0;
        }

        return view('pages.arsip.show', compact(
            'kunjungans',
            'dataPengunjung',
            'tahun',
            'bulan',
            'namaBulan',
            'totalPengunjung',
            'pengunjungTerbanyak',
            'jumlahKunjunganTerbanyak'
        ));
    }


    // daftar pengunjung
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

        // ambil data kunjungan bulan terpilih
        $kunjungans = Kunjungan::with('pengunjung')
            ->whereYear('tanggal_kunjungan', $tahun)
            ->whereMonth('tanggal_kunjungan', $bulan)
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        // kelompokkan pengunjung berdasarkan NISN/NIP
        $dataPengunjung = $kunjungans
            ->filter(function ($kunjungan) {
                return $kunjungan->pengunjung !== null;
            })
            ->groupBy(function ($kunjungan) {
                return trim($kunjungan->pengunjung->nisn_nip ?? '');
            })
            ->map(function ($data) {
                $pengunjung = $data->first()->pengunjung;

                return [
                    'id_pengunjung' => $pengunjung->id_pengunjung,
                    'nisn_nip' => $pengunjung->nisn_nip ?? '-',
                    'nama' => $pengunjung->nama ?? '-',
                    'kelas_jabatan' => $pengunjung->kelas_jabatan ?? '-',
                    'jumlah_kunjungan' => $data->count(),
                ];
            })
            ->values();

        return view('pages.arsip.pengunjung', compact(
            'tahun',
            'bulan',
            'namaBulan',
            'dataPengunjung'
        ));
    }
}