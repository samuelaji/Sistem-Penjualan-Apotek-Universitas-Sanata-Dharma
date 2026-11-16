@extends('layouts.app')
@section('judul', 'Riwayat Pasien')

@section('isi')
<h2>Akses Riwayat Pasien</h2>

<form method="GET" class="kotak">
    <label>ID Pasien / Nama / NIM<br>
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Masukkan identitas atau nama pasien">
    </label>
    <button class="btn" type="submit">Cari</button>
</form>

@if(request('cari'))
    @if(!$pasien)
        <div class="pesan galat">Data Pasien Tidak Ditemukan</div>
    @else
        <div class="kotak">
            <p>Nama: <strong>{{ $pasien->nama_pasien }}</strong></p>
            <p>Tipe: {{ $pasien->tipe_pasien }} | No. identitas: {{ $pasien->no_identitas ?? '-' }}</p>
        </div>

        <h3>Tabel Riwayat Transaksi</h3>
        <table>
            <thead><tr><th>ID Transaksi</th><th>Tanggal</th><th>Total Belanja</th><th></th></tr></thead>
            <tbody>
                @forelse($riwayat as $t)
                <tr>
                    <td>TRX-{{ $t->id_transaksi }}</td>
                    <td>{{ $t->tanggal_transaksi }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td><a class="btn" href="{{ route('transaksi.show', $t->id_transaksi) }}">Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="4">Belum ada riwayat transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    @endif
@endif
@endsection