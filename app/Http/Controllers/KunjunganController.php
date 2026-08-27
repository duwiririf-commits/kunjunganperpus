<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kunjungan = Kunjungan::all();
        return view('pages.kunjungan.index', compact('kunjungan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('pages.kunjungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil disimpan.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        return view('pages.kunjungan.show', compact('kunjungan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $kunjungan = Kunjungan::findOrFail($id);
    $kunjungan->delete();

    return redirect()->route('kunjungan.index')
                     ->with('success', 'Data kunjungan berhasil dihapus.');
    }
}
