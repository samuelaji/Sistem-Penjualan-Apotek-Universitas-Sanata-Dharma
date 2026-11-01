<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep; 

class BLUController extends Controller
{
    public function index()
    {
        //Mengambil resep yang membutuhkan/menggunakan validasi BLU
        $reseps = Resep::with(['pasien'])->latest()->get();
        return view('blu.index', compact('reseps'));
    }

        //Menampilkan form untuk membuat/menambahkan data validasi BLU baru.

    public function create()
    {
        return view('blu.create');
    }
   
       //Menyimpan data validasi BLU baru ke database.

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

        //Menampilkan detail spesifik data validasi BLU.

    public function show(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        return view('blu.show', compact('resep'));
    }

        //Menampilkan form untuk mengedit status validasi BLU.

    public function edit(string $id)
    {
        //
        $resep = Resep::findOrFail($id);
        return view('blu.edit', compact('resep'));
    }

        //Memperbarui status validasi pasien BLU di database.
     
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_validasi' => 'required|in:Pending,Disetujui,Ditolak',
        ]);

        $resep = Resep::findOrFail($id);
        
        // Memperbarui status validasi BLU pada data resep/pasien
        $resep->update([
            'status_validasi' => $request->status_validasi,
        ]);

        return redirect()->route('blu.index')->with('success', 'Status validasi BLU berhasil diperbarui.');
    }
}