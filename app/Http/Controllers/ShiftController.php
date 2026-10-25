<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    /**
     * Menampilkan halaman manajemen shift kasir.
     */
    public function index()
    {
        $shift = Shift::where('id_pengguna', Auth::id())
            ->whereNull('waktu_selesai')
            ->first();

        return view('shift.index', compact('shift'));
    }

    /**
     *
     */
    public function create()
    {
       
    }

    /**
     * Mencatat waktu mulai & data awal shift.
     */
    public function store(Request $request)
    {
        $request->validate([
            'saldo_awal' => 'required|numeric|min:0',
        ]);

        Shift::create([
            'id_pengguna' => Auth::id(),
            'waktu_mulai' => now(),
            'saldo_awal'  => $request->saldo_awal,
        ]);

        return redirect()->route('shift.index')
            ->with('success', 'Shift berhasil dibuka.');
    }

    /**
     *  menampilkan ringkasan shift yang telah ditutup.
     */
    public function show(string $id)
    {
        $shift = Shift::findOrFail($id);

        $total_penjualan = Transaksi::where('id_shift', $shift->id_shift)->sum('total_harga');
        $selisih         = $shift->saldo_akhir - $total_penjualan;

        return view('shift.show', compact('shift', 'total_penjualan', 'selisih'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Aksi Tutup Shift :
     * AMBIL total penjualan sistem
     * BACA input nominal uang fisik di laci (saldo_akhir)
     * HITUNG selisih = uang fisik - penjualan sistem
     * SIMPAN laporan shift, lalu keluar (logout).
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'saldo_akhir' => 'required|numeric|min:0',
        ]);

        $shift = Shift::findOrFail($id);

        $total_penjualan = Transaksi::where('id_shift', $shift->id_shift)->sum('total_harga');
        $selisih         = $request->saldo_akhir - $total_penjualan;

        // Alternate course: ada selisih rekap transaksi
        if ($selisih != 0 && !$request->has('konfirmasi')) {
            return back()->withInput()
                ->with('warning', 'Ada Selisih Rekap, Mohon Konfirmasi Ulang');
        }

        $shift->update([
            'waktu_selesai' => now(),
            'saldo_akhir'   => $request->saldo_akhir,
        ]);

        // Sesuai algoritma laporan: otomatis keluar ke halaman login
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}