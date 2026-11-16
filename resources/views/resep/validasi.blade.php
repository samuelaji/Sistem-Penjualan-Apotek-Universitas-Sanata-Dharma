@extends('layouts.app')
@section('judul', 'Validasi Resep')

@section('isi')
<h2>Validasi Resep</h2>

<div class="kotak">
    <p>Nomor resep: <strong>{{ $resep->id_resep }}</strong></p>
    <p>Nama dokter: {{ $resep->nama_dokter }}</p>
    <p>Tanggal resep: {{ $resep->tgl_resep }}</p>
</div>

<div class="kotak">
    <h3>Daftar Periksa Obat vs Stok</h3>
    <table>
        <thead><tr><th>Obat</th><th>Jumlah</th><th>Stok</th><th>Status</th></tr></thead>
        <tbody>
            @foreach($daftarObat as $o)
            <tr>
                <td>{{ $o->nama_obat }}</td>
                <td>{{ $o->jumlah }}</td>
                <td>{{ $o->stok }}</td>
                <td>{{ $o->stok >= $o->jumlah ? 'Tersedia' : 'Stok kurang' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($valid)
    <form method="POST" action="{{ route('resep.update', $resep->id_resep) }}">
        @csrf
        @method('PUT')
        <button class="btn" type="submit">Konfirmasi Validasi</button>
    </form>
@else
    <div class="pesan galat">Resep Tidak Valid, Mohon Hubungi Apoteker</div>
@endif
@endsection