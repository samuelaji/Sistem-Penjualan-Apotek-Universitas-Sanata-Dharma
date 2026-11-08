<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $query = Obat::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_obat', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        $obatList = $query->latest()->paginate(10)->withQueryString();
        $kategoriList = Obat::select('kategori')->distinct()->pluck('kategori');

        return view('apoteker.obat', compact('obatList', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku'                 => 'required|string|max:50|unique:obat,sku',
            'nama_obat'           => 'required|string|max:100',
            'kategori'            => 'required|string|max:50',
            'jenis_obat'          => 'required|string|max:100',
            'stok'                => 'required|integer|min:0',
            'batas_minimum'       => 'required|integer|min:1',
            'harga_obat'          => 'required|numeric|min:0',
            'tanggal_kadaluwarsa' => 'required|date',
        ]);

        $validated['id_pengguna'] = Auth::id() ?? 1;

        Obat::create($validated);

        return redirect()->route('apoteker.obat.index')->with('success', 'Obat baru berhasil ditambahkan ke katalog.');
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate([
            'sku'                 => 'required|string|max:50|unique:obat,sku,' . $obat->id_obat . ',id_obat',
            'nama_obat'           => 'required|string|max:100',
            'kategori'            => 'required|string|max:50',
            'jenis_obat'          => 'required|string|max:100',
            'stok'                => 'required|integer|min:0',
            'batas_minimum'       => 'required|integer|min:1',
            'harga_obat'          => 'required|numeric|min:0',
            'tanggal_kadaluwarsa' => 'required|date',
        ]);

        $obat->update($validated);

        return redirect()->route('apoteker.obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('apoteker.obat.index')->with('success', 'Obat berhasil dihapus dari katalog.');
    }
}
