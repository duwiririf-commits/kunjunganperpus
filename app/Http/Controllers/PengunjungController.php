<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    // tampilkan daftar pengunjung
    public function index()
    {
        $pengunjung = Pengunjung::all();

        return view('pages.pengunjung.index', compact('pengunjung'));
    }

    // form tambah pengunjung
    public function create()
    {
        return view('pages.pengunjung.create');
    }

    // simpan pengunjung baru
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

    // tampilkan detail pengunjung
    public function show(string $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        return view('pages.pengunjung.show', compact('pengunjung'));
    }

    // form edit pengunjung
    public function edit(string $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        return view('pages.pengunjung.edit', compact('pengunjung'));
    }

    // update data pengunjung
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

    // hapus pengunjung
    public function destroy(string $id)
    {
        $pengunjung = Pengunjung::findOrFail($id);

        $pengunjung->delete();

        return redirect()->route('pengunjung.index')
            ->with('success', 'Data pengunjung berhasil dihapus.');
    }
}