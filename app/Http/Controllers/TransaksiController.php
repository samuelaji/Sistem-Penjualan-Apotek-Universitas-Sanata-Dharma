<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Obat;
use App\Models\Shift;
use App\Models\Resep;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $obatList = Obat::all();
        return view('transaksi.index', compact('obatList'));
    }

    public function store(Request $request)
    {

        $shiftAktif = Shift::where('id_pengguna', Auth::id())
            ->where('status', 'Buka')
            ->first();

        if (!$shiftAktif) {
            return response()->json(['success' => false, 'message' => 'Anda belum membuka shift kasir!'], 400);
        }

        try {
            DB::beginTransaction();

            $id_resep = null;
            $id_pasien = null;

            if ($request->recipe_type === 'Resep') {
                $resep = Resep::create([
                    'nama_dokter' => $request->doctor_name ?? 'Tidak Diketahui',
                    'nama_klinik' => $request->clinic_name ?? 'Tidak Diketahui',
                    'tanggal_resep' => $request->recipe_date ?? date('Y-m-d'),
                    'status_validasi' => 'Menunggu Validasi',
                ]);
                $id_resep = $resep->id_resep;
            }

            $transaksi = Transaksi::create([
                'id_shift' => $shiftAktif->id_shift,
                'id_pasien' => $id_pasien,
                'id_resep' => $id_resep,
                'tanggal_transaksi' => now(),
                'total_harga' => $request->grand_total,
                'nominal_bayar' => $request->cash_received,
                'kembalian' => $request->change_amount,
                'metode_pembayaran' => strtolower($request->payment_method),
                'status_transaksi' => ($request->recipe_type === 'Resep') ? 'Pending' : 'Selesai',
            ]);

            foreach ($request->cart as $item) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_obat' => $item['id_obat'],
                    'jumlah_beli' => $item['qty'],
                    'subtotal' => $item['harga'] * $item['qty'],
                ]);

                $obat = Obat::find($item['id_obat']);
                $obat->stok = $obat->stok - $item['qty'];
                $obat->save();
            }

            $shiftAktif->total_penjualan += $request->grand_total;
            $shiftAktif->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'status_transaksi' => $transaksi->status_transaksi
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }
}
