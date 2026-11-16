@extends('layouts.app')
@section('judul', 'Shift Kasir')

@section('isi')
<h2>Informasi Shift</h2>

@if(!$shift)
    <div class="kotak">
        <h3>Buka Shift</h3>
        <form method="POST" action="{{ route('shift.store') }}">
            @csrf
            <input type="number" name="saldo_awal" placeholder="Saldo awal (Rp)" required>
            <button class="btn" type="submit">Buka Shift</button>
        </form>
    </div>
@else
    <div style="display:flex; gap:16px">
        <div class="kotak" style="flex:1">
            <h3>Info Shift</h3>
            <p>Sesi Aktif</p>
            <p>Shift ID: <strong>{{ $shift->id_shift }}</strong></p>
            <p>Mulai: {{ $shift->waktu_mulai }}</p>
        </div>
        <div class="kotak" style="flex:1">
            <h3>Saldo Per Shift</h3>
            <p>Saldo Awal: Rp {{ number_format($shift->saldo_awal, 0, ',', '.') }}</p>
            <p>Saldo Akhir: Rp -</p>
        </div>
    </div>

    <div class="kotak">
        <h3>Input Uang Fisik</h3>
        <p>Masukkan total hitungan uang fisik di laci saat tutup shift (dalam Rupiah).</p>
        <form method="POST" action="{{ route('shift.update', $shift->id_shift) }}">
            @csrf
            @method('PUT')
            <p><input type="number" name="saldo_akhir" value="{{ old('saldo_akhir') }}" placeholder="Contoh: 662750" required></p>

            @if(session('warning'))
                <p><label><input type="checkbox" name="konfirmasi" value="1"> Saya konfirmasi ada selisih</label></p>
            @endif

            <button class="btn" type="reset" style="background:#fff; color:#990000; border:1px solid #990000">Bersihkan</button>
            <button class="btn" type="submit">Tutup Shift</button>
        </form>
    </div>
@endif
@endsection