@extends('layouts.app')
@section('judul', 'Validasi BLU')

@section('isi')
<h2>Verifikasi Anggota BLU</h2>
<p style="text-align:center">Pilih jenis pasien dan verifikasi NIM/NIP sebelum menjual layanan BLU.</p>

<form method="POST" action="{{ route('blu.store') }}" class="kotak">
    @csrf
    <p>
        <label>Tipe Pasien<br>
            <select name="tipe_pasien">
                <option value="Umum">Umum</option>
                <option value="BLU" selected>BLU</option>
            </select>
        </label>
    </p>
    <p>
        <label>NIM / NIP<br>
            <input type="text" name="no_identitas" placeholder="Masukkan NIM/NIP" value="{{ old('no_identitas') }}">
        </label>
    </p>
    <button class="btn" type="submit">Verifikasi</button>
</form>

@isset($pasien)
    <div class="kotak">
        <p>Pasien aktif: <strong>{{ $pasien['nama_pasien'] ?? '-' }}</strong> ({{ $pasien['tipe_pasien'] ?? '-' }})</p>
    </div>
@endisset
@endsection