<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $resep = Resep::all();
        return view('resep.index', compact('resep'));
    }

    public function create()
    {
        return view('resep.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dokter' => 'required|string|max:100',
            'nama_klinik' => 'required|string|max:100',
            'tgl_resep'   => 'required|date',
        ]);

        Resep::create($validated);
        return redirect()->route('resep.index')->with('success', 'Data resep berhasil ditambahkan.');
    }

    public function show(Resep $resep)
    {
        return view('resep.show', compact('resep'));
    }

    public function edit(Resep $resep)
    {
        return view('resep.edit', compact('resep'));
    }

    public function update(Request $request, Resep $resep)
    {
        $validated = $request->validate([
            'nama_dokter' => 'required|string|max:100',
            'nama_klinik' => 'required|string|max:100',
            'tgl_resep'   => 'required|date',
        ]);

        $resep->update($validated);
        return redirect()->route('resep.index')->with('success', 'Data resep berhasil diperbarui.');
    }

    public function destroy(Resep $resep)
    {
        $resep->delete();
        return redirect()->route('resep.index')->with('success', 'Data resep berhasil dihapus.');
    }
}
