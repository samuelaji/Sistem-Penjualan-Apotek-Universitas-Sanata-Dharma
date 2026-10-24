<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $shift = Shift::shiftAktif(Auth::id());

        $total_transaksi = $shift ? $shift->hitungTotalTransaksi() : 0;
        $saldo_sistem    = $shift ? $shift->hitungSaldo() : 0;

        $riwayat = Shift::where('id_pengguna', Auth::id())
            ->whereNotNull('waktu_selesai')
            ->latest('waktu_mulai')
            ->take(5)
            ->get();

        return view('shift.index', compact('shift', 'total_transaksi', 'saldo_sistem', 'riwayat'));
          
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
