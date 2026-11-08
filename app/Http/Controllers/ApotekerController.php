<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Obat;
use App\Models\Resep;
use Carbon\Carbon;

class ApotekerController extends Controller
{
    public function index()
    {
        // 1. Ambil antrean transaksi yang berstatus 'Pending' (Menunggu Validasi Resep dari Kasir)
        $pendingResep = Transaksi::with(['resep', 'detail_transaksi.obat', 'shift.staff'])
            ->where('status_transaksi', 'Pending')
            ->latest()
            ->get();

        // 2. Early Warning: Ambil obat yang stoknya di bawah atau sama dengan batas minimum
        $stokKritis = Obat::whereColumn('stok', '<=', 'batas_minimum')->get();

        // 3. Early Warning: Ambil obat yang kedaluwarsa dalam 12 bulan ke depan
        $mendekatiExpired = Obat::whereDate('tanggal_kadaluwarsa', '<=', Carbon::now()->addMonths(12))
            ->orderBy('tanggal_kadaluwarsa', 'asc')
            ->get();

        // 4. Total Statistik untuk KPI Card
        $totalObat = Obat::count();
        $totalPending = $pendingResep->count();
        $totalKritis = $stokKritis->count();
        $totalExpiredAlert = $mendekatiExpired->count();

        return view('apoteker.dashboard', compact(
            'pendingResep',
            'stokKritis',
            'mendekatiExpired',
            'totalObat',
            'totalPending',
            'totalKritis',
            'totalExpiredAlert'
        ));
    }

    // Aksi Setujui Resep
    public function approve($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Ubah status transaksi jadi selesai
        $transaksi->status_transaksi = 'Selesai';
        $transaksi->save();

        // Ubah status di resep
        if ($transaksi->id_resep) {
            $resep = Resep::find($transaksi->id_resep);
            $resep->status_validasi = 'Valid';
            $resep->save();
        }

        return redirect()->route('apoteker.dashboard')->with('success', 'Resep berhasil disetujui! Transaksi telah disahkan.');
    }

    // Aksi Tolak Resep
    public function reject(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Ubah status transaksi jadi dibatalkan
        $transaksi->status_transaksi = 'Dibatalkan';
        $transaksi->save();

        // Kembalikan stok obat yang sempat dipotong
        foreach ($transaksi->detail_transaksi as $detail) {
            $obat = Obat::find($detail->id_obat);
            if ($obat) {
                $obat->stok += $detail->jumlah_beli;
                $obat->save();
            }
        }

        if ($transaksi->id_resep) {
            $resep = Resep::find($transaksi->id_resep);
            $resep->status_validasi = 'Ditolak';
            $resep->save();
        }

        return redirect()->route('apoteker.dashboard')->with('error', 'Resep ditolak. Stok obat telah dikembalikan ke sistem.');
    }
}
