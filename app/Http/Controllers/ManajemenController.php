<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManajemenController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $omsetHariIni = Transaksi::whereDate('tanggal_transaksi', $hariIni)
            ->where('status_transaksi', 'Selesai')
            ->sum('total_harga');

        $transaksiHariIni = Transaksi::whereDate('tanggal_transaksi', $hariIni)
            ->where('status_transaksi', 'Selesai')
            ->count();

        $nilaiAset = Obat::select(DB::raw('SUM(stok * harga_obat) as total_aset'))->first()->total_aset;

        $produkTerlaris = DB::table('detail_transaksi')
            ->join('obat', 'detail_transaksi.id_obat', '=', 'obat.id_obat')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->where('transaksi.status_transaksi', 'Selesai')
            ->select('obat.nama_obat', 'obat.kategori', DB::raw('SUM(detail_transaksi.jumlah_beli) as total_terjual'), DB::raw('SUM(detail_transaksi.subtotal) as total_rupiah'))
            ->groupBy('obat.id_obat', 'obat.nama_obat', 'obat.kategori')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $grafikTanggal = [];
        $grafikOmset = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);
            $grafikTanggal[] = $tanggal->format('d M');

            $omset = Transaksi::whereDate('tanggal_transaksi', $tanggal)
                ->where('status_transaksi', 'Selesai')
                ->sum('total_harga');
            $grafikOmset[] = (int) $omset;
        }

        return view('manajemen.dashboard', compact(
            'omsetHariIni',
            'transaksiHariIni',
            'nilaiAset',
            'produkTerlaris',
            'grafikTanggal',
            'grafikOmset'
        ));
    }

    public function inventaris(Request $request)
    {
        $query = Obat::query()
            ->withSum(['detailTransaksi as total_terjual' => function ($q) {
                $q->whereHas('transaksi', function ($t) {
                    $t->where('status_transaksi', 'Selesai');
                });
            }], 'jumlah_beli');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_obat', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->get('export') === 'csv') {
            $allObat = (clone $query)->orderByDesc('total_terjual')->get();
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="laporan-produk-inventaris-' . date('Y-m-d') . '.csv"',
            ];

            return response()->stream(function () use ($allObat) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['SKU', 'Nama Obat', 'Kategori', 'Terjual (Unit)', 'Sisa Stok', 'Harga Satuan', 'Total Nilai Aset']);
                foreach ($allObat as $o) {
                    fputcsv($file, [
                        $o->sku,
                        $o->nama_obat,
                        $o->kategori,
                        $o->total_terjual ?? 0,
                        $o->stok,
                        $o->harga_obat,
                        $o->stok * $o->harga_obat,
                    ]);
                }
                fclose($file);
            }, 200, $headers);
        }

        $obatList = $query->orderByDesc('total_terjual')->orderBy('nama_obat', 'asc')->paginate(10)->withQueryString();
        $kategoriList = Obat::select('kategori')->distinct()->pluck('kategori');

        $produkTerjualData = DB::table('detail_transaksi')
            ->join('obat', 'detail_transaksi.id_obat', '=', 'obat.id_obat')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->where('transaksi.status_transaksi', 'Selesai')
            ->select(
                'obat.nama_obat',
                DB::raw('SUM(detail_transaksi.jumlah_beli) as total_unit'),
                DB::raw('SUM(detail_transaksi.subtotal) as total_rupiah')
            )
            ->groupBy('obat.id_obat', 'obat.nama_obat')
            ->orderByDesc('total_unit')
            ->limit(6)
            ->get();

        $chartLabels = $produkTerjualData->pluck('nama_obat');
        $chartUnitValues = $produkTerjualData->pluck('total_unit')->map(fn ($v) => (int) $v);
        $chartRupiahValues = $produkTerjualData->pluck('total_rupiah')->map(fn ($v) => (int) $v);

        return view('manajemen.inventaris', compact(
            'obatList',
            'kategoriList',
            'chartLabels',
            'chartUnitValues',
            'chartRupiahValues'
        ));
    }
}
