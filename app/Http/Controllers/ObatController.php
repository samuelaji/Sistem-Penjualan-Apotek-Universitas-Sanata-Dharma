<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pengguna'        => 'required|integer', // Asumsi didapat dari sesi login (Auth::id())
            'nama_obat'          => 'required|string|max:100',
            'kategori'           => 'required|string|max:50',
            'stok'               => 'required|integer|min:0',
            'harga'              => 'required|numeric|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        Obat::create($validated);
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function show(Obat $obat)
    {
        return view('obat.show', compact('obat'));
    }

    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'id_pengguna'        => 'required|integer',
            'nama_obat'          => 'required|string|max:100',
            'kategori'           => 'required|string|max:50',
            'stok'               => 'required|integer|min:0',
            'harga'              => 'required|numeric|min:0',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        $obat->update($validated);
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus.');
    }
}
