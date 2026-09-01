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
            ->whereDate('tanggal_kunjungan', Carbon::today())
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        return view('pages.kunjungan.index', compact('kunjungan'));
    }

    public function create()
    {
        return view('pages.kunjungan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn_nip' => 'required',
            'nama' => 'required',
            'kelas_jabatan' => 'required',
            'tanggal_kunjungan' => 'required|date',
            'keperluan' => 'required',
        ]);

        $pengunjung = Pengunjung::create([
            'nisn_nip' => $request->nisn_nip,
            'nama' => $request->nama,
            'kelas_jabatan' => $request->kelas_jabatan,
        ]);

        Kunjungan::create([
            'id_pengunjung' => $pengunjung->id_pengunjung,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'keperluan' => $request->keperluan,
        ]);

       return redirect()
        ->route('home')
        ->with('success', 'Data kunjungan berhasil disimpan.');
    }

    public function show($id)
    {
        $id = decrypt($id);

        $kunjungan = Kunjungan::with('pengunjung')
            ->where('id_kunjungan', $id)
            ->firstOrFail();

        return view('pages.kunjungan.show', compact('kunjungan'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        $kunjungan->delete();

        return redirect()
            ->route('admin.kunjungan.index')
            ->with('success', 'Berhasil Menghapus data dengan ID:' . $id);    

    }
}