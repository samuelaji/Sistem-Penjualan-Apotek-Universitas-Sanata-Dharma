<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class LaporanController extends Controller
{
    public function inventaris(Request $request)
    {
        $listObat = Obat::all();
        $chartData = Obat::select('kategori', \DB::raw('SUM(stok) as total_stok'))
                        ->groupBy('kategori')
                        ->get();

        $categories = $chartData->pluck('kategori');
        $totals = $chartData->pluck('total_stok');

        return view('inventaris.inventaris', compact('listObat', 'categories', 'totals'));
    }
}
