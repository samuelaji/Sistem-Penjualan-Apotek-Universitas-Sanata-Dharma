<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat; // Panggil model Obat

class LaporanController extends Controller
{
    public function inventaris()
    {
        // Mengambil seluruh data obat dari database
        $listObat = Obat::all(); 

        // Mengirim data ke view laporan.inventaris menggunakan compact()
        return view('laporan.inventaris', compact('listObat'));
    }
}