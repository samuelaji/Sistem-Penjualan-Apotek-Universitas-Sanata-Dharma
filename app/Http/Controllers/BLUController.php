<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BLUController
{
    public function index()
    {
        //Mengambil resep yang membutuhkan/menggunakan validasi BLU
        $reseps = Resep::with(['pasien'])->latest()->get();
        return view('blu.index', compact('reseps'));
    }

    public function create()
    {
        return view('blu.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'id_resep' => 'required|exists:resep,id_resep',
            'no_kartu_blu' => 'required|string',
            'status_validasi' => 'required|string',
        ]);

        return redirect()->route('blu.index')->with('success', 'Validasi BLU berhasil disimpan.');
    }

    public function show(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        return view('blu.show', compact('resep'));
    }

    public function edit(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        return view('blu.edit', compact('resep'));
    }

    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'status_validasi' => 'required|in:Pending,Disetujui,Ditolak',
        ]);

        $resep = Resep::findOrFail($id);
        // Logika memperbarui status validasi BLU di tabel resep/transaksi
        $resep->update([
            'status_validasi' => $request->status_validasi,
        ]);

        return redirect()->route('blu.index')->with('success', 'Status validasi BLU berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        // Hapus data atau batalkan klaim BLU
        $resep->delete();

        return redirect()->route('blu.index')->with('success', 'Data BLU berhasil dihapus.');
    }
}
