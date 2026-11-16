<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') - Apotek Sanata Dharma</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #fafafa; color: #222; }
        nav { background: #990000; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; }
        nav a { color: #fff; text-decoration: none; margin-left: 16px; }
        .isi { max-width: 900px; margin: 24px auto; padding: 0 16px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { border-bottom: 1px solid #ddd; padding: 8px; text-align: left; }
        .btn { background: #990000; color: #fff; border: 0; padding: 8px 16px; border-radius: 6px; cursor: pointer; text-decoration: none; }
        input, select { padding: 8px; border: 1px solid #bbb; border-radius: 6px; }
        .pesan { padding: 10px; border-radius: 6px; margin-bottom: 12px; }
        .sukses { background: #d4edda; }
        .peringatan { background: #fff3cd; }
        .galat { background: #f8d7da; }
        .kotak { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <nav>
        <strong>@yield('judul')</strong>
        <div>
            @if(Route::has('shift.index')) <a href="{{ route('shift.index') }}">Shift</a> @endif
            @if(Route::has('blu.index')) <a href="{{ route('blu.index') }}">Validasi BLU</a> @endif
            @if(Route::has('riwayat-pasien.index')) <a href="{{ route('riwayat-pasien.index') }}">Riwayat Pasien</a> @endif
            @if(Route::has('transaksi.create')) <a href="{{ route('transaksi.create') }}">Transaksi</a> @endif
        </div>
    </nav>

    <div class="isi">
        @if(session('success')) <div class="pesan sukses">{{ session('success') }}</div> @endif
        @if(session('warning')) <div class="pesan peringatan">{{ session('warning') }}</div> @endif
        @if(session('error'))   <div class="pesan galat">{{ session('error') }}</div> @endif
        @if($errors->any())     <div class="pesan galat">{{ $errors->first() }}</div> @endif

        @yield('isi')
    </div>
</body>
</html>