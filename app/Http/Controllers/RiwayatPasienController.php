<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class RiwayatPasienController extends Controller
{

    public function index()
    {
        $pasien = Pasien::all();
        return view('riwayat_pasien.index', compact('pasien'));
    }

    public function show($id)
    {
        $pasien = Pasien::with(['transaksi'])->where('id_pasien', $id)->firstOrFail();

        return view('riwayat_pasien.show', compact('pasien'));
    }
}
