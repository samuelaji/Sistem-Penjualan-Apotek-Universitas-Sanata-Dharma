<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShiftController extends Controller
{
    // 1. Menampilkan Halaman Dashboard Kasir
    public function index()
    {
        $user = Auth::user();

        // Cek apakah kasir ini sudah punya shift yang 'Buka' hari ini
        $shiftAktif = Shift::where('id_pengguna', $user->id_pengguna)
            ->where('status', 'Buka')
            ->first();

        // Ambil 5 transaksi terakhir untuk ditampilkan (jika ada shift)
        $transaksiTerakhir = collect();
        if ($shiftAktif) {
            $transaksiTerakhir = Transaksi::with('detail_transaksi.obat')
                ->where('id_shift', $shiftAktif->id_shift)
                ->latest()
                ->take(5)
                ->get();
        }

        return view('kasir.dashboard', compact('shiftAktif', 'transaksiTerakhir'));
    }

    // 2. Logika Membuka Shift Pagi
    public function bukaShift(Request $request)
    {
        $request->validate([
            'saldo_awal' => 'required|numeric|min:0'
        ]);

        Shift::create([
            'id_pengguna' => Auth::id(),
            'waktu_mulai' => Carbon::now(),
            'saldo_awal'  => $request->saldo_awal,
            'status'      => 'Buka',
        ]);

        return redirect()->route('kasir.dashboard')->with('success', 'Shift berhasil dibuka! Selamat melayani pelanggan.');
    }

    // 3. Logika Menutup Shift & Hitung Selisih
    public function tutupShift(Request $request)
    {
        $request->validate([
            'uang_fisik' => 'required|numeric|min:0'
        ]);

        $shiftAktif = Shift::where('id_pengguna', Auth::id())
            ->where('status', 'Buka')
            ->first();

        if (!$shiftAktif) {
            return redirect()->back()->with('error', 'Tidak ada shift aktif.');
        }

        // Ambil total penjualan HANYA YANG CASH (karena QRIS/Transfer tidak masuk laci)
        $totalPenjualanTunai = Transaksi::where('id_shift', $shiftAktif->id_shift)
            ->where('metode_pembayaran', 'cash')
            ->sum('nominal_bayar');

        // Kurangi dengan kembalian tunai
        $totalKembalian = Transaksi::where('id_shift', $shiftAktif->id_shift)
            ->where('metode_pembayaran', 'cash')
            ->sum('nominal_kembalian');

        $uangMasukBersih = $totalPenjualanTunai - $totalKembalian;

        // Uang Seharusnya di Laci = Modal Awal + Pemasukan Tunai Bersih
        $saldoSeharusnya = $shiftAktif->saldo_awal + $uangMasukBersih;

        // Selisih = Uang yang dihitung kasir - Uang seharusnya di sistem
        $selisih = $request->uang_fisik - $saldoSeharusnya;

        $shiftAktif->update([
            'waktu_selesai'   => Carbon::now(),
            'saldo_akhir'     => $request->uang_fisik,
            'total_penjualan' => $uangMasukBersih,
            'selisih'         => $selisih,
            'status'          => 'Tutup'
        ]);

        // Sesuai Algoritma (Hal 75): Tutup Shift = Otomatis Logout!
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $pesan = 'Shift ditutup! Selisih kas: Rp ' . number_format($selisih, 0, ',', '.');
        return redirect('/login')->with('success', $pesan);
    }
}
