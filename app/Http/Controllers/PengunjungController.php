<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengunjung = Pengunjung::all();

        return view('pages.pengunjung.index', compact('pengunjung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengunjung.create');
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
        ]);

        Pengunjung::create([
            'nisn_nip' => $request->nisn_nip,
            'nama' => $request->nama,
            'kelas_jabatan' => $request->kelas_jabatan,
        ]);

        return redirect()->route('pengunjung.index')
            ->with('success', 'Data pengunjung berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        return view('pages.pengunjung.show', compact('pengunjung'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        return view('pages.pengunjung.edit', compact('pengunjung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nisn_nip' => 'required',
            'nama' => 'required',
            'kelas_jabatan' => 'required',
        ]);

        $pengunjung = Pengunjung::findOrFail($id);

        $pengunjung->update([
            'nisn_nip' => $request->nisn_nip,
            'nama' => $request->nama,
            'kelas_jabatan' => $request->kelas_jabatan,
        ]);

        return redirect()->route('pengunjung.index')
            ->with('success', 'Data pengunjung berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        $pengunjung->delete();

        return redirect()->route('pengunjung.index')
            ->with('success', 'Data pengunjung berhasil dihapus.');
    }
}