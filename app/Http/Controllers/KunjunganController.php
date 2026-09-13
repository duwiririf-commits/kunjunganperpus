<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\Kunjungan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        // Ambil data kunjungan hanya untuk hari ini
        $kunjungan = Kunjungan::with('pengunjung')
            ->whereDate(
                'tanggal_kunjungan',
                Carbon::today()
            )
            ->orderBy(
                'tanggal_kunjungan',
                'desc'
            )
            ->get();

        return view(
            'pages.kunjungan.index',
            compact('kunjungan')
        );
    }


    public function create()
    {
        return view('pages.kunjungan.create');
    }


    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'nisn_nip' => 'required',
            'nama' => 'required',
            'kelas_jabatan' => 'required',
            'tanggal_kunjungan' => 'required|date',
            'keperluan' => 'required',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI PENGUNJUNG YANG SUDAH ADA
        |--------------------------------------------------------------------------
        |
        | NISN/NIP digunakan sebagai identitas pengunjung.
        |
        | Kalau NISN/NIP sudah ada:
        | -> gunakan data pengunjung yang lama
        |
        | Kalau belum ada:
        | -> buat pengunjung baru
        |
        */

        $pengunjung = Pengunjung::where(
            'nisn_nip',
            $request->nisn_nip
        )->first();


        /*
        |--------------------------------------------------------------------------
        | JIKA PENGUNJUNG BELUM ADA
        |--------------------------------------------------------------------------
        */

        if (!$pengunjung) {

            $pengunjung = Pengunjung::create([
                'nisn_nip' => $request->nisn_nip,
                'nama' => $request->nama,
                'kelas_jabatan' => $request->kelas_jabatan,
            ]);

        } else {

            /*
            |--------------------------------------------------------------------------
            | JIKA SUDAH ADA
            |--------------------------------------------------------------------------
            |
            | Data orangnya tetap menggunakan ID yang sama.
            | Nama dan kelas/jabatan bisa diperbarui jika diperlukan.
            |
            */

            $pengunjung->update([
                'nama' => $request->nama,
                'kelas_jabatan' => $request->kelas_jabatan,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA KUNJUNGAN
        |--------------------------------------------------------------------------
        |
        | Setiap kali datang tetap dibuat 1 data kunjungan baru.
        | Tetapi id_pengunjung tetap menggunakan ID orang yang sama.
        |
        */

        Kunjungan::create([
            'id_pengunjung' => $pengunjung->id_pengunjung,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'keperluan' => $request->keperluan,
        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE HOME
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Data kunjungan berhasil disimpan.'
            );
    }


    public function show($id)
    {
        $id = decrypt($id);

        $kunjungan = Kunjungan::with('pengunjung')
            ->where(
                'id_kunjungan',
                $id
            )
            ->firstOrFail();

        return view(
            'pages.kunjungan.show',
            compact('kunjungan')
        );
    }


    public function edit(string $id)
    {
        //
    }


    public function update(
        Request $request,
        string $id
    ) {
        //
    }


    public function destroy(string $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        $kunjungan->delete();

        return redirect()
            ->route('admin.kunjungan.index')
            ->with(
                'success',
                'Berhasil Menghapus data dengan ID:' . $id
            );
    }
}