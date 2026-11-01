<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat; // Panggil model Obat

class LaporanController extends Controller
{
    public function inventaris(Request $request)
    {
        // Mengambil seluruh data obat dari database
        $listObat = Obat::all(); 

        // Data untuk grafik mengelompokkan stok berdasarkan kategori
        $chartData = Obat::select('kategori', \DB::raw('SUM(stok) as total_stok'))
                        ->groupBy('kategori')
                        ->get();

        $categories = $chartData->pluck('kategori');
        $totals = $chartData->pluck('total_stok');

        return view('inventaris.inventaris', compact('listObat', 'categories', 'totals'));
    }
}