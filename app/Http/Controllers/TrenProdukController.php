<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrenProdukController extends Controller
{
    /**
     * Lihat Tren Produk dan Menampilkan grafik tren produk terlaris dan pergerakan stok.
     * Periode (harian / mingguan / bulanan) menyesuaikan grafik.
     */
    public function index(Request $request)
    {
        $periode = $request->get('periode', 'bulanan');

        // Rentang waktu analisis tren
        $mulai = match ($periode) {
            'harian'   => now()->startOfDay(),
            'mingguan' => now()->subWeek(),
            default    => now()->subMonth(),
        };

        // Ambil data penjualan: produk terlaris pada periode
        $dataPenjualan = DB::table('detail_transaksi')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('obat', 'detail_transaksi.id_obat', '=', 'obat.id_obat')
            ->where('transaksi.tanggal_transaksi', '>=', $mulai)
            ->select(
                'obat.id_obat',
                'obat.nama_obat',
                DB::raw('SUM(detail_transaksi.jumlah_beli) as total_terjual'),
                DB::raw('SUM(detail_transaksi.subtotal) as total_pendapatan')
            )
            ->groupBy('obat.id_obat', 'obat.nama_obat')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();

        // Ambil data inventaris: stok terkini obat
        $dataInventaris = Obat::select('id_obat', 'nama_obat', 'stok')->get();

        // Alternate course: data tidak mencukupi untuk analisis tren
        $pesan = $dataPenjualan->isEmpty() ? 'Data belum cukup untuk ditampilkan.' : null;

        return view('tren-produk.index', compact('periode', 'dataPenjualan', 'dataInventaris', 'pesan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
