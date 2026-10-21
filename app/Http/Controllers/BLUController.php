<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BLUController
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar transaksi/resep yang menggunakan jaminan BLU.
     */
    public function index()
    {
        //Mengambil resep yang membutuhkan/menggunakan validasi BLU
        $reseps = Resep::with(['pasien'])->latest()->get();
        return view('blu.index', compact('reseps'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form pengajuan atau verifikasi BLU baru.
     */
    public function create()
    {
        return view('blu.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data validasi BLU baru.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_resep' => 'required|exists:resep,id_resep',
            'no_kartu_blu' => 'required|string',
            'status_validasi' => 'required|string',
        ]);

        // Proses verifikasi data BLU

        return redirect()->route('blu.index')->with('success', 'Validasi BLU berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail informasi jaminan BLU pasien.
     */
    public function show(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        return view('blu.show', compact('resep'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk merubah status validasi BLU.
     */
    public function edit(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        return view('blu.edit', compact('resep'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui status validasi BLU (misal: Disetujui / Ditolak).
     */
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

    /**
     * Remove the specified resource from storage.
     * Menghapus data/pengajuan validasi BLU.
     */
    public function destroy(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        // Hapus data atau batalkan klaim BLU
        $resep->delete();

        return redirect()->route('blu.index')->with('success', 'Data BLU berhasil dihapus.');
    }
}
