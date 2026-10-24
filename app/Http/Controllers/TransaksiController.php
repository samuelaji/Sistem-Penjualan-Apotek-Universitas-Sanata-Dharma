<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Shift;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController
{
    /**
     * Riwayat transaksi
     */
    public function index()
    {
        $transaksi = Transaksi::latest('tanggal_transaksi')->get();

        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Halaman transaksi baru: tampilkan daftar obat
     */
    public function create()
    {
        $obat = Obat::all();

        return view('transaksi.create', compact('obat'));
    }

    /**
     * Proses pembayaran + catat transaksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'items'               => 'required|array',
            'items.*.id_obat'     => 'required',
            'items.*.jumlah_beli' => 'required|integer|min:1',
            'nominal_bayar'       => 'required|numeric',
        ]);

        // Transaksi harus di dalam shift yang aktif
        $shift = Shift::where('id_pengguna', auth()->id())
            ->whereNull('waktu_selesai')
            ->first();

        if (!$shift) {
            return back()->with('error', 'Buka shift terlebih dahulu.');

            // Hitung total + cek stok
        $total = 0;
        foreach ($request->items as $item) {
            $obat = Obat::findOrFail($item['id_obat']);

            if ($obat->stok < $item['jumlah_beli']) {
                return back()->with('error', 'Stok ' . $obat->nama_obat . ' tidak cukup.');
            }

            $total += $obat->harga * $item['jumlah_beli'];
        }

        if ($request->nominal_bayar < $total) {
            return back()->with('error', 'Pembayaran Kurang');
        }

        // Catat transaksi
        $transaksi = Transaksi::create([
            'id_shift'          => $shift->id_shift,
            'id_pasien'         => $request->id_pasien,
            'id_resep'          => $request->id_resep,
            'tanggal_transaksi' => now(),
            'total_harga'       => $total,
            'nominal_bayar'     => $request->nominal_bayar,
        ]);

        // Catat detail + kurangi stok
        foreach ($request->items as $item) {
            $obat = Obat::find($item['id_obat']);

            $transaksi->detail_transaksi()->create([
                'id_obat'     => $obat->id_obat,
                'jumlah_beli' => $item['jumlah_beli'],
                'subtotal'    => $obat->harga * $item['jumlah_beli'],
            ]);

            $obat->decrement('stok', $item['jumlah_beli']);
        }

        return redirect()->route('transaksi.show', $transaksi->id_transaksi)
            ->with('success', 'Transaksi berhasil dicatat.');
    }

    /**
     * Struk transaksi
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with('detail_transaksi')->findOrFail($id);
        $kembalian = $transaksi->nominal_bayar - $transaksi->total_harga;

        return view('transaksi.show', compact('transaksi', 'kembalian'));
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
        //
    }
}
