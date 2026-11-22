<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Obat - Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/system-popups.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-workspace: #f1f5f9;
            --surface: #ffffff;
            --border-soft: #e2e8f0;
            --maroon: #8B0000;
            --maroon-dark: #6e0000;
            --maroon-soft: rgba(139, 0, 0, 0.08);
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-workspace);
            color: var(--text-dark);
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin: 0;
            font-size: 16px;
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }

        /* ---------- Animasi ---------- */
        @keyframes pageEntrance {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideForward {
            from { opacity: 0; transform: translateX(28px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideBack {
            from { opacity: 0; transform: translateX(-28px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        @keyframes popIn {
            0%   { transform: scale(0.6); opacity: 0; }
            70%  { transform: scale(1.08); opacity: 1; }
            100% { transform: scale(1); }
        }
        @keyframes swapIn {
            from { opacity: 0; transform: translateY(-4px); }
            to   { opacity: 1; transform: none; }
        }

        /* ---------- Header ---------- */
        .pos-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0.85rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 20;
        }
        .user-identity { display: flex; flex-direction: column; gap: 2px; }
        .user-name {
            font-weight: 700;
            font-size: 1.25rem;
            line-height: 1.25;
            text-transform: capitalize;
        }
        .user-id {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 600;
            line-height: 1.25;
            text-transform: capitalize;
        }

        .nav-segmented {
            display: flex;
            background: #e2e8f0;
            border-radius: 10px;
            padding: 4px;
            gap: 4px;
        }
        .nav-segmented a {
            text-decoration: none;
            padding: 6px 15px;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 8px;
            transition: all 0.2s var(--ease-out);
        }
        .nav-segmented a:hover { color: var(--text-dark); }
        .nav-segmented a.active {
            background: var(--maroon);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(139, 0, 0, 0.2);
        }

        .header-clock {
            font-size: 0.95rem;
            color: var(--text-muted);
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        /* ---------- Area Kerja Utama ---------- */
        .main-workspace {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 0.85rem 1.15rem;
            gap: 0.75rem;
            animation: pageEntrance 0.35s var(--ease-out) forwards;
        }

        .toolbar-card {
            background: var(--surface);
            border-radius: 14px;
            padding: 0.8rem 1.2rem;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .search-field { position: relative; flex: 1; max-width: 440px; }
        .search-field > i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.98rem;
            pointer-events: none;
        }
        .search-field input {
            width: 100%;
            padding: 0.6rem 2.3rem 0.6rem 2.55rem;
            border-radius: 10px;
            border: 1.5px solid var(--border-soft);
            outline: none;
            font-size: 0.94rem;
            transition: all 0.2s;
            background: #f8fafc;
        }
        .search-field input:focus {
            background: #ffffff;
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }

        .btn-clear-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--text-muted);
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .btn-clear-search:hover {
            background: #e2e8f0;
            color: var(--text-dark);
        }

        .category-filter { flex-shrink: 0; }
        .category-trigger {
            min-width: 205px;
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.45rem 0.7rem;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            color: var(--text-dark);
            background: #ffffff;
            font-size: 0.92rem;
            font-weight: 600;
            text-align: left;
            transition: border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        }
        .category-trigger:hover,
        .category-trigger:focus,
        .category-filter.show .category-trigger {
            border-color: var(--maroon);
            color: var(--text-dark);
            background: #fffafa;
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }
        .category-trigger.dropdown-toggle::after { margin-left: auto; }
        .category-trigger-icon,
        .category-option-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            color: var(--maroon);
            background: var(--maroon-soft);
            font-size: 0.95rem;
        }
        .category-filter .dropdown-menu {
            min-width: 100%;
            padding: 0.35rem;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
        }
        .category-option {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.4rem 0.5rem;
            border-radius: 8px;
            color: var(--text-dark);
            font-size: 0.9rem;
            font-weight: 500;
        }
        .category-option:hover,
        .category-option:focus,
        .category-option.active {
            color: var(--maroon);
            background: #fff1f1;
        }
        .category-option.active { font-weight: 700; }

        .btn-maroon {
            background: var(--maroon);
            color: #ffffff;
            border: none;
            padding: 0.6rem 1.25rem;
            font-size: 0.94rem;
            font-weight: 600;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.15);
            white-space: nowrap;
        }
        .btn-maroon:hover {
            background: var(--maroon-dark);
            color: #ffffff;
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.22);
        }
        .btn-maroon:active { transform: scale(0.98); }
        .btn-maroon:disabled { opacity: 0.75; cursor: wait; }

        .btn-soft {
            background: #ffffff;
            color: var(--text-dark);
            border: 1.5px solid var(--border-soft);
            padding: 0.6rem 1.15rem;
            font-size: 0.94rem;
            font-weight: 600;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-soft:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: var(--text-dark);
        }
        .btn-soft:active { transform: scale(0.98); }

        /* ---------- Tabel ---------- */
        .table-card {
            flex: 1;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: opacity 0.15s ease;
        }
        .table-card.is-loading tbody {
            opacity: 0.55;
            pointer-events: none;
        }
        .table-wrapper { flex: 1; overflow: auto; }
        .table-custom { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; min-width: 1120px; }

        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.86rem;
            font-weight: 700;
            padding: 0.85rem 1.2rem;
            border-bottom: 1.5px solid var(--border-soft);
            position: sticky;
            top: 0;
            z-index: 5;
            white-space: nowrap;
        }
        .table-custom tbody td {
            padding: 0.9rem 1.2rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.96rem;
            transition: background-color 0.15s ease;
        }
        .table-custom tbody tr:hover td { background-color: #fafbfc; }

        .sku-code {
            font-size: 0.88rem;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
        }
        .sub-note {
            display: block;
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: 2px;
        }
        .unit-label {
            font-size: 0.84rem;
            font-weight: 500;
        }
        .packaging-text {
            font-size: 0.92rem;
            color: var(--text-muted);
            text-transform: capitalize;
        }

        /* Status (Teks datar tanpa kotak & ikon) */
        .status-text {
            font-size: 0.88rem;
            white-space: nowrap;
        }
        .status-active  { color: #047857; font-weight: 600; }
        .status-warning { color: #b45309; font-weight: 700; }
        .status-expired { color: #991b1b; font-weight: 700; }

        .expiry-note { display: block; font-size: 0.82rem; color: var(--text-muted); margin-top: 2px; }
        .expiry-note.is-expired { color: #991b1b; font-weight: 600; }

        .btn-action-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid var(--border-soft);
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 0.95rem;
            transition: all 0.15s ease;
        }
        .btn-action-icon:hover { background: #f1f5f9; border-color: #cbd5e1; color: var(--text-dark); }
        .btn-action-icon.delete:hover { background: #fef2f2; color: #dc2626; border-color: #fecaca; }

        .table-footer {
            padding: 0.8rem 1.2rem;
            border-top: 1px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            font-size: 0.88rem;
        }

        .form-label { font-size: 0.88rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.4rem; }
        .form-control, .form-select {
            border-radius: 9px;
            border-color: var(--border-soft);
            font-size: 0.95rem;
            padding: 0.55rem 0.85rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }
        .input-group-text { background: #f8fafc; border-color: var(--border-soft); color: var(--text-muted); font-size: 0.92rem; }
        .field.shake { animation: shake 0.4s ease; }

        /* Indikator Langkah Wizard */
        .wizard-steps { position: relative; display: flex; margin-bottom: 1.4rem; }
        .wizard-progress {
            position: absolute;
            top: 17px;
            left: 16.66%;
            right: 16.66%;
            height: 2px;
            background: var(--border-soft);
        }
        .wizard-progress span {
            display: block;
            height: 100%;
            width: 0;
            background: var(--maroon);
            transition: width 0.45s var(--ease-out);
        }
        .wizard-step { position: relative; z-index: 1; flex: 1; text-align: center; }
        .wizard-dot {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid var(--border-soft);
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s var(--ease-out);
        }
        .wizard-label { display: block; margin-top: 6px; font-size: 0.84rem; font-weight: 600; color: var(--text-muted); transition: color 0.3s; }
        .wizard-step.active .wizard-dot { border-color: var(--maroon); color: var(--maroon); box-shadow: 0 0 0 4px var(--maroon-soft); }
        .wizard-step.active .wizard-label { color: var(--text-dark); }
        .wizard-step.done .wizard-dot { background: var(--maroon); border-color: var(--maroon); color: #ffffff; animation: popIn 0.35s ease; }
        .wizard-step.done .wizard-label { color: var(--text-dark); }

        .wizard-panel { display: none; }
        .wizard-panel.active { display: block; }
        .wizard-panel.active[data-dir="forward"] { animation: slideForward 0.35s var(--ease-out); }
        .wizard-panel.active[data-dir="back"]    { animation: slideBack 0.35s var(--ease-out); }

        /* Pemilih Kategori */
        .cp-new { display: none; }
        .cp-new.open { display: flex; animation: swapIn 0.25s var(--ease-out); }
        .category-picker.is-new .cp-select { display: none; }

        /* Input Number Stepper */
        .js-integer, .js-rupiah { font-variant-numeric: tabular-nums; }
        .stepper .btn { border-color: var(--border-soft); color: var(--text-muted); padding: 0.55rem 0.85rem; }
        .stepper .btn:hover { background: var(--maroon-soft); color: var(--maroon); border-color: var(--maroon); }

        /* Ringkasan Konfirmasi */
        .review-list { margin: 0; border: 1px solid var(--border-soft); border-radius: 12px; overflow: hidden; }
        .review-row { display: flex; justify-content: space-between; gap: 1rem; padding: 0.75rem 1.05rem; font-size: 0.93rem; border-bottom: 1px solid #f1f5f9; }
        .review-row:last-child { border-bottom: none; }
        .review-row dt { font-weight: 500; color: var(--text-muted); }
        .review-row dd { margin: 0; font-weight: 600; text-align: right; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-4">
        <div class="user-identity">
            <span class="user-name">{{ Auth::user()->nama_pengguna ?? 'Apoteker' }}</span>
            <span class="user-id">{{ Auth::user()->role_akses ?? 'Apoteker Pelayanan' }}</span>
        </div>

        <nav class="nav-segmented ms-2">
            <a href="{{ route('apoteker.dashboard') }}">Dashboard Validasi</a>
            <a href="{{ route('apoteker.obat.index') }}" class="active">Katalog Obat</a>
        </nav>
    </div>

    <div class="d-flex align-items-center gap-3">
        <span class="header-clock" id="headerLiveClock">--:-- WIB</span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger border-0 rounded-circle" title="Keluar" aria-label="Keluar">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </button>
        </form>
    </div>
</header>

<main class="main-workspace">

    {{-- Bilah Pencarian dan Filter --}}
    <div class="toolbar-card">
        <form method="GET" action="{{ route('apoteker.obat.index') }}" id="filterForm" class="d-flex align-items-center gap-2 flex-grow-1">
            <div class="search-field">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari nama obat, SKU, atau kategori..." autocomplete="off">
                <button type="button" id="btnClearSearch" class="btn-clear-search {{ request('search') ? '' : 'd-none' }}" title="Hapus pencarian" aria-label="Hapus pencarian">
                    <i class="bi bi-x-lg" style="font-size: 0.78rem;"></i>
                </button>
            </div>

            <button type="submit" class="btn-maroon" id="btnSearch">Cari</button>

            <div class="category-filter dropdown">
                <select name="kategori" id="kategoriSelect" class="category-select visually-hidden" aria-label="Filter Kategori" aria-hidden="true" tabindex="-1">
                    <option value="Semua">Semua Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ ucfirst($kat) }}</option>
                    @endforeach
                </select>
                <button type="button" class="category-trigger dropdown-toggle" id="kategoriDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="listbox">
                    <span class="category-trigger-icon"><i id="kategoriTriggerIcon" class="bi bi-grid" aria-hidden="true"></i></span>
                    <span id="kategoriTriggerLabel">Semua Kategori</span>
                </button>
                <div class="dropdown-menu category-menu" id="kategoriOptions" role="listbox" aria-label="Kategori obat" aria-labelledby="kategoriDropdown"></div>
            </div>
        </form>

        <button type="button" class="btn-maroon" data-bs-toggle="modal" data-bs-target="#modalTambahObat">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Obat</span>
        </button>
    </div>

    {{-- Tabel Data Obat --}}
    <div class="table-card" id="obatTableCard">
        <div class="table-wrapper">
            <table class="table-custom">
                <thead>
                <tr>
                    <th style="width: 4%;">No.</th>
                    <th style="width: 10%;">Kode SKU</th>
                    <th style="width: 20%;">Nama Obat</th>
                    <th style="width: 10%;">Kategori</th>
                    <th style="width: 11%;">Kemasan</th>
                    <th style="width: 7%; text-align: center;">Stok</th>
                    <th style="width: 11%;">Harga Satuan</th>
                    <th style="width: 10%;">Kedaluwarsa</th>
                    <th style="width: 11%;">Status</th>
                    <th style="width: 6%; text-align: center;">Aksi</th>
                </tr>
                </thead>
                <tbody id="obatTableBody">
                @forelse($obatList as $index => $obat)
                    @php
                        $kedaluwarsa  = \Carbon\Carbon::parse($obat->tanggal_kadaluwarsa)->startOfDay();
                        $hariTersisa  = (int) now()->startOfDay()->diffInDays($kedaluwarsa, false);
                        $sudahExpired = $hariTersisa < 0;
                        $segera       = !$sudahExpired && $hariTersisa <= 90;

                        $payloadEdit = [
                            'sku'                 => $obat->sku,
                            'kategori'            => $obat->kategori,
                            'nama_obat'           => $obat->nama_obat,
                            'jenis_obat'          => $obat->jenis_obat,
                            'stok'                => $obat->stok,
                            'batas_minimum'       => $obat->batas_minimum,
                            'harga_obat'          => (int) $obat->harga_obat,
                            'tanggal_kadaluwarsa' => $kedaluwarsa->format('Y-m-d'),
                        ];
                    @endphp
                    <tr>
                        <td class="text-muted fw-bold">{{ $obatList->firstItem() + $index }}</td>
                        <td><span class="font-monospace sku-code">{{ $obat->sku }}</span></td>
                        <td>
                            <span class="fw-bold text-dark d-block">{{ $obat->nama_obat }}</span>
                            <span class="sub-note">Stok min. {{ $obat->batas_minimum }} unit</span>
                        </td>
                        <td><span class="text-dark fw-medium text-capitalize">{{ $obat->kategori }}</span></td>
                        <td><span class="packaging-text">{{ $obat->jenis_obat }}</span></td>
                        <td class="text-center" style="font-variant-numeric: tabular-nums;">
                            @if($obat->stok <= $obat->batas_minimum)
                                <span class="fw-bold text-danger">{{ $obat->stok }}</span>
                                <span class="text-danger unit-label">unit</span>
                            @else
                                <span class="fw-bold text-dark">{{ $obat->stok }}</span>
                                <span class="text-muted unit-label">unit</span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark" style="font-variant-numeric: tabular-nums;">Rp {{ number_format($obat->harga_obat, 0, ',', '.') }}</td>
                        <td>
                            <span class="text-dark d-block">{{ $kedaluwarsa->format('d M Y') }}</span>
                            @if($sudahExpired)
                                <span class="expiry-note is-expired">Lewat {{ abs($hariTersisa) }} hari</span>
                            @else
                                <span class="expiry-note">{{ $hariTersisa === 0 ? 'Kedaluwarsa hari ini' : $hariTersisa . ' hari lagi' }}</span>
                            @endif
                        </td>
                        <td>
                            @if($sudahExpired)
                                <span class="status-text status-expired">Kedaluwarsa</span>
                            @elseif($segera)
                                <span class="status-text status-warning">Hampir Kedaluwarsa</span>
                            @else
                                <span class="status-text status-active">Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex gap-2">
                                <button type="button" class="btn-action-icon" title="Ubah Data" aria-label="Ubah Data"
                                        data-bs-toggle="modal" data-bs-target="#modalEditObat"
                                        data-obat="{{ json_encode($payloadEdit) }}"
                                        data-update-url="{{ url('apoteker/obat/' . $obat->id_obat) }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon delete" title="Hapus Data" aria-label="Hapus Data"
                                        data-bs-toggle="modal" data-bs-target="#modalHapusObat"
                                        data-nama="{{ $obat->nama_obat }}"
                                        data-delete-url="{{ route('apoteker.obat.destroy', $obat->id_obat) }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block opacity-25 mb-2"></i>
                            <span class="fw-medium">Data obat tidak ditemukan.</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer" id="obatTableFooter">
            <span class="text-muted">Menampilkan {{ $obatList->firstItem() ?? 0 }}–{{ $obatList->lastItem() ?? 0 }} dari {{ $obatList->total() }} data</span>
            <div>{{ $obatList->withQueryString()->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>

</main>

{{-- ============ MODAL TAMBAH DATA OBAT (3 LANGKAH) ============ --}}
<div class="modal fade app-popup-modal" id="modalTambahObat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header app-popup-form-header">
                <span class="app-popup-form-icon" aria-hidden="true"><i class="bi bi-capsule"></i></span>
                <h5 class="modal-title fw-bold text-dark mb-0">Tambah Data Obat</h5>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

            <form action="{{ route('apoteker.obat.store') }}" method="POST" id="formTambahObat" novalidate>
                @csrf
                <input type="hidden" name="_form" value="tambah">

                <div class="modal-body">
                    <div class="wizard-steps" id="wizardSteps">
                        <div class="wizard-progress"><span id="wizardProgressFill"></span></div>
                        <div class="wizard-step active" data-step="1"><span class="wizard-dot">1</span><span class="wizard-label">Identitas Obat</span></div>
                        <div class="wizard-step" data-step="2"><span class="wizard-dot">2</span><span class="wizard-label">Stok &amp; Harga</span></div>
                        <div class="wizard-step" data-step="3"><span class="wizard-dot">3</span><span class="wizard-label">Konfirmasi</span></div>
                    </div>

                    {{-- Langkah 1: Identitas Obat --}}
                    <div class="wizard-panel active" data-step="1" data-dir="forward">
                        <div class="row g-3">
                            <div class="col-12 col-sm-5 field">
                                <label class="form-label" for="add_sku">Kode SKU</label>
                                <input type="text" class="form-control text-uppercase" id="add_sku" name="sku"
                                       value="{{ old('sku') }}" placeholder="Contoh: AMO-500" autocomplete="off" required>
                            </div>
                            <div class="col-12 col-sm-7 field">
                                <label class="form-label" for="add_kategori_select">Kategori</label>
                                <div class="category-picker" data-initial="{{ old('kategori') }}">
                                    <select class="form-select cp-select" id="add_kategori_select" required>
                                        <option value="" disabled selected>Pilih kategori</option>
                                        @foreach($kategoriList as $kat)
                                            <option value="{{ $kat }}">{{ ucfirst($kat) }}</option>
                                        @endforeach
                                        <option value="__new__">+ Tambah kategori baru</option>
                                    </select>
                                    <div class="cp-new">
                                        <div class="input-group">
                                            <input type="text" class="form-control cp-new-input text-capitalize" placeholder="Masukkan nama kategori" maxlength="50" autocomplete="off">
                                            <button type="button" class="btn btn-outline-secondary cp-cancel">Daftar</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="kategori" class="cp-value">
                                </div>
                            </div>
                            <div class="col-12 field">
                                <label class="form-label" for="add_nama">Nama Obat</label>
                                <input type="text" class="form-control text-capitalize" id="add_nama" name="nama_obat"
                                       value="{{ old('nama_obat') }}" placeholder="Contoh: Amoxicillin 500 mg" autocomplete="off" required>
                            </div>
                            <div class="col-12 field">
                                <label class="form-label" for="add_jenis">Kemasan / Sediaan</label>
                                <input type="text" class="form-control text-capitalize" id="add_jenis" name="jenis_obat"
                                       value="{{ old('jenis_obat') }}" placeholder="Contoh: Strip (10 Tablet)" autocomplete="off" required>
                            </div>
                        </div>
                    </div>

                    {{-- Langkah 2: Stok & Harga --}}
                    <div class="wizard-panel" data-step="2">
                        <div class="row g-3">
                            <div class="col-6 field">
                                <label class="form-label" for="add_stok">Stok Awal</label>
                                <div class="input-group stepper">
                                    <button class="btn btn-outline-secondary" type="button" data-stepper="-1" aria-label="Kurangi jumlah">-</button>
                                    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control text-center js-integer" id="add_stok" name="stok" value="{{ old('stok', 0) }}" data-default="0" autocomplete="off" required>
                                    <button class="btn btn-outline-secondary" type="button" data-stepper="1" aria-label="Tambah jumlah">+</button>
                                </div>
                            </div>
                            <div class="col-6 field">
                                <label class="form-label" for="add_min">Stok Minimum</label>
                                <div class="input-group stepper">
                                    <button class="btn btn-outline-secondary" type="button" data-stepper="-1" aria-label="Kurangi jumlah">-</button>
                                    <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control text-center js-integer" id="add_min" name="batas_minimum" value="{{ old('batas_minimum', 10) }}" data-default="10" autocomplete="off" required>
                                    <button class="btn btn-outline-secondary" type="button" data-stepper="1" aria-label="Tambah jumlah">+</button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 field">
                                <label class="form-label" for="add_harga">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" inputmode="numeric" class="form-control js-rupiah" id="add_harga" maxlength="13" placeholder="0" autocomplete="off" required>
                                </div>
                                <input type="hidden" name="harga_obat" value="{{ old('harga_obat') }}">
                            </div>
                            <div class="col-12 col-sm-6 field">
                                <label class="form-label" for="add_exp">Tanggal Kedaluwarsa</label>
                                <input type="date" class="form-control" id="add_exp" name="tanggal_kadaluwarsa"
                                       value="{{ old('tanggal_kadaluwarsa') }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- Langkah 3: Konfirmasi --}}
                    <div class="wizard-panel" data-step="3">
                        <p class="text-muted mb-3" style="font-size: 0.92rem;">Periksa kembali data berikut sebelum disimpan.</p>
                        <dl class="review-list" id="reviewList"></dl>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <div>
                        <button type="button" class="btn-soft" id="btnCancel" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn-soft d-none" id="btnBack">Sebelumnya</button>
                    </div>
                    <div>
                        <button type="button" class="btn-maroon" id="btnNext">Berikutnya</button>
                        <button type="submit" class="btn-maroon d-none" id="btnSubmit" data-loading-text="Menyimpan...">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============ MODAL UBAH DATA OBAT ============ --}}
<div class="modal fade app-popup-modal" id="modalEditObat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header app-popup-form-header">
                <span class="app-popup-form-icon" aria-hidden="true"><i class="bi bi-pencil"></i></span>
                <h5 class="modal-title fw-bold text-dark mb-0">Ubah Data Obat</h5>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            <form id="formEditObat" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-5 field">
                            <label class="form-label" for="edit_sku">Kode SKU</label>
                            <input type="text" class="form-control text-uppercase" id="edit_sku" name="sku" autocomplete="off" required>
                        </div>
                        <div class="col-12 col-sm-7 field">
                            <label class="form-label" for="edit_kategori_select">Kategori</label>
                            <div class="category-picker">
                                <select class="form-select cp-select" id="edit_kategori_select" required>
                                    <option value="" disabled selected>Pilih kategori</option>
                                    @foreach($kategoriList as $kat)
                                        <option value="{{ $kat }}">{{ ucfirst($kat) }}</option>
                                    @endforeach
                                    <option value="__new__">+ Tambah kategori baru</option>
                                </select>
                                <div class="cp-new">
                                    <div class="input-group">
                                        <input type="text" class="form-control cp-new-input text-capitalize" placeholder="Masukkan nama kategori" maxlength="50" autocomplete="off">
                                        <button type="button" class="btn btn-outline-secondary cp-cancel">Daftar</button>
                                    </div>
                                </div>
                                <input type="hidden" name="kategori" class="cp-value">
                            </div>
                        </div>
                        <div class="col-12 field">
                            <label class="form-label" for="edit_nama">Nama Obat</label>
                            <input type="text" class="form-control text-capitalize" id="edit_nama" name="nama_obat" autocomplete="off" required>
                        </div>
                        <div class="col-12 field">
                            <label class="form-label" for="edit_jenis">Kemasan / Sediaan</label>
                            <input type="text" class="form-control text-capitalize" id="edit_jenis" name="jenis_obat" autocomplete="off" required>
                        </div>
                        <div class="col-6 field">
                            <label class="form-label" for="edit_stok">Stok Tersedia</label>
                            <div class="input-group stepper">
                                <button class="btn btn-outline-secondary" type="button" data-stepper="-1" aria-label="Kurangi jumlah">-</button>
                                <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control text-center js-integer" id="edit_stok" name="stok" autocomplete="off" required>
                                <button class="btn btn-outline-secondary" type="button" data-stepper="1" aria-label="Tambah jumlah">+</button>
                            </div>
                        </div>
                        <div class="col-6 field">
                            <label class="form-label" for="edit_min">Stok Minimum</label>
                            <div class="input-group stepper">
                                <button class="btn btn-outline-secondary" type="button" data-stepper="-1" aria-label="Kurangi jumlah">-</button>
                                <input type="text" inputmode="numeric" pattern="[0-9]*" class="form-control text-center js-integer" id="edit_min" name="batas_minimum" autocomplete="off" required>
                                <button class="btn btn-outline-secondary" type="button" data-stepper="1" aria-label="Tambah jumlah">+</button>
                            </div>
                        </div>
                        <div class="col-6 field">
                            <label class="form-label" for="edit_harga">Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" inputmode="numeric" class="form-control js-rupiah" id="edit_harga" maxlength="13" placeholder="0" autocomplete="off" required>
                            </div>
                            <input type="hidden" name="harga_obat">
                        </div>
                        <div class="col-6 field">
                            <label class="form-label" for="edit_exp">Tanggal Kedaluwarsa</label>
                            <input type="date" class="form-control" id="edit_exp" name="tanggal_kadaluwarsa" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-soft" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-maroon js-loading-submit" data-loading-text="Menyimpan...">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============ MODAL KONFIRMASI HAPUS ============ --}}
<div class="modal fade app-popup-modal" id="modalHapusObat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="max-width: 380px; margin: auto;">
            <form id="formHapusObat" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header app-popup-form-header">
                    <span class="app-popup-form-icon" aria-hidden="true"><i class="bi bi-trash"></i></span>
                    <h5 class="modal-title mb-0">Hapus data obat?</h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-0">Data obat <strong id="hapusNamaObat"></strong> akan dihapus secara permanen.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-soft" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-maroon js-loading-submit" data-loading-text="Menghapus...">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/system-popups.js') }}"></script>
@if(session('success'))
<script>
    AppPopup.alert(@json(session('success')), { title: 'Berhasil', icon: 'bi-check-circle' });
</script>
@endif
@if($errors->any())
<script>
    AppPopup.alert(@json($errors->first()), { title: 'Terjadi kesalahan', icon: 'bi-exclamation-circle' });
</script>
@endif
<script>
    (function () {
        'use strict';

        /* ---------- Jam Header (WIB) ---------- */
        const clockEl = document.getElementById('headerLiveClock');
        function updateClock() {
            clockEl.textContent = new Date().toLocaleTimeString('en-GB', {
                timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', hour12: false
            }) + ' WIB';
        }
        updateClock();
        setInterval(updateClock, 1000);

        /* ---------- Pencarian & Filter Realtime ---------- */
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const btnClearSearch = document.getElementById('btnClearSearch');
        const kategoriSelect = document.getElementById('kategoriSelect');
        const kategoriTriggerLabel = document.getElementById('kategoriTriggerLabel');
        const kategoriTriggerIcon = document.getElementById('kategoriTriggerIcon');
        const kategoriOptions = document.getElementById('kategoriOptions');
        const tableCard = document.getElementById('obatTableCard');
        const tableBody = document.getElementById('obatTableBody');
        const tableFooter = document.getElementById('obatTableFooter');

        let searchTimer = null;
        let activeController = null;

        function getCategoryIcon(category) {
            const name = category.toLowerCase();
            if (name === 'semua') return 'bi-grid';
            if (name.includes('antibiotik')) return 'bi-capsule';
            if (name.includes('analgesik')) return 'bi-bandaid';
            if (name.includes('antihistamin')) return 'bi-droplet';
            if (name.includes('suplemen')) return 'bi-heart-pulse';
            return 'bi-tags';
        }

        function updateCategoryDropdown() {
            const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
            if (!selectedOption) return;

            kategoriTriggerLabel.textContent = selectedOption.textContent.trim();
            kategoriTriggerIcon.className = 'bi ' + getCategoryIcon(selectedOption.value);
            kategoriOptions.querySelectorAll('.category-option').forEach(option => {
                const isSelected = option.dataset.value === kategoriSelect.value;
                option.classList.toggle('active', isSelected);
                option.setAttribute('aria-selected', String(isSelected));
            });
        }

        Array.from(kategoriSelect.options).forEach(option => {
            const iconName = getCategoryIcon(option.value);
            const item = document.createElement('button');
            item.type = 'button';
            item.className = 'dropdown-item category-option';
            item.dataset.value = option.value;
            item.setAttribute('role', 'option');
            item.setAttribute('aria-selected', 'false');

            const iconContainer = document.createElement('span');
            iconContainer.className = 'category-option-icon';
            const icon = document.createElement('i');
            icon.className = 'bi ' + iconName;
            icon.setAttribute('aria-hidden', 'true');
            iconContainer.appendChild(icon);

            const label = document.createElement('span');
            label.textContent = option.textContent.trim();
            item.append(iconContainer, label);
            item.addEventListener('click', () => {
                kategoriSelect.value = option.value;
                kategoriSelect.dispatchEvent(new Event('change', { bubbles: true }));
            });
            kategoriOptions.appendChild(item);
        });
        updateCategoryDropdown();

        function toggleClearButton() {
            btnClearSearch.classList.toggle('d-none', searchInput.value.trim() === '');
        }

        async function fetchFilteredObat() {
            if (activeController) activeController.abort();
            activeController = new AbortController();

            const url = new URL(filterForm.action, window.location.origin);
            const keyword = searchInput.value.trim();
            const kategori = kategoriSelect.value;

            if (keyword !== '') url.searchParams.set('search', keyword);
            if (kategori && kategori !== 'Semua') url.searchParams.set('kategori', kategori);

            tableCard.classList.add('is-loading');

            try {
                const response = await fetch(url.toString(), {
                    signal: activeController.signal,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) throw new Error('Network response was not ok');

                const html = await response.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const newBody = doc.getElementById('obatTableBody');
                const newFooter = doc.getElementById('obatTableFooter');

                if (newBody && newFooter) {
                    tableBody.innerHTML = newBody.innerHTML;
                    tableFooter.innerHTML = newFooter.innerHTML;
                    window.history.replaceState(null, '', url.toString());
                } else {
                    filterForm.submit();
                    return;
                }
            } catch (err) {
                if (err.name === 'AbortError') return;
                filterForm.submit();
            } finally {
                tableCard.classList.remove('is-loading');
            }
        }

        searchInput.addEventListener('input', () => {
            toggleClearButton();
            clearTimeout(searchTimer);
            searchTimer = setTimeout(fetchFilteredObat, 300);
        });

        btnClearSearch.addEventListener('click', () => {
            searchInput.value = '';
            toggleClearButton();
            clearTimeout(searchTimer);
            searchInput.focus();
            fetchFilteredObat();
        });

        kategoriSelect.addEventListener('change', () => {
            updateCategoryDropdown();
            clearTimeout(searchTimer);
            fetchFilteredObat();
        });

        filterForm.addEventListener('submit', e => {
            e.preventDefault();
            clearTimeout(searchTimer);
            fetchFilteredObat();
        });

        /* ---------- Fungsi Utilitas ---------- */
        const rupiah = new Intl.NumberFormat('id-ID');

        function toInputDate(d) {
            const pad = n => String(n).padStart(2, '0');
            return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
        }

        function shake(el) {
            const box = el.closest('.field') || el.parentElement;
            box.classList.remove('shake');
            void box.offsetWidth;
            box.classList.add('shake');
            box.addEventListener('animationend', () => box.classList.remove('shake'), { once: true });
        }

        function validateScope(scope) {
            let firstInvalid = null;
            scope.querySelectorAll('input[required], select[required]').forEach(el => {
                if (el.disabled || el.type === 'hidden') return;
                const isValid = el.checkValidity() && (el.type === 'text' ? el.value.trim() !== '' : true);
                el.classList.toggle('is-invalid', !isValid);
                if (!isValid && !firstInvalid) firstInvalid = el;
            });
            if (firstInvalid) {
                shake(firstInvalid);
                firstInvalid.focus();
            }
            return !firstInvalid;
        }

        document.addEventListener('input', e => e.target.classList.remove('is-invalid'));
        document.addEventListener('change', e => e.target.classList.remove('is-invalid'));

        function setLoading(btn) {
            if (!btn) return;
            const loadingText = btn.dataset.loadingText || 'Memproses...';
            btn.disabled = true;
            btn.dataset.label = btn.innerHTML;
            btn.innerHTML = `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>${loadingText}`;
        }

        function resetLoading(btn) {
            if (!btn) return;
            btn.disabled = false;
            if (btn.dataset.label) btn.innerHTML = btn.dataset.label;
        }

        /* ---------- Pemilih Kategori ---------- */
        const NEW_VALUE = '__new__';

        function initCategoryPicker(root) {
            const select = root.querySelector('.cp-select');
            const box = root.querySelector('.cp-new');
            const input = root.querySelector('.cp-new-input');
            const hidden = root.querySelector('.cp-value');
            const cancel = root.querySelector('.cp-cancel');

            function sync() {
                hidden.value = select.value === NEW_VALUE ? input.value.trim() : select.value;
            }

            function toggleNew(on) {
                root.classList.toggle('is-new', on);
                box.classList.toggle('open', on);
                input.required = on;
                input.classList.remove('is-invalid');
                if (on) setTimeout(() => input.focus(), 50);
                else input.value = '';
                sync();
            }

            select.addEventListener('change', () => toggleNew(select.value === NEW_VALUE));
            input.addEventListener('input', sync);
            cancel.addEventListener('click', () => { select.value = ''; toggleNew(false); });

            const api = {
                set(value) {
                    const v = (value ?? '').trim();
                    if (!v) { select.value = ''; toggleNew(false); return; }
                    const match = Array.from(select.options).find(o =>
                        o.value && o.value !== NEW_VALUE && o.value.toLowerCase() === v.toLowerCase());
                    if (match) {
                        select.value = match.value;
                        toggleNew(false);
                    } else {
                        select.value = NEW_VALUE;
                        root.classList.add('is-new');
                        box.classList.add('open');
                        input.required = true;
                        input.value = v;
                    }
                    sync();
                },
                isNew() { return select.value === NEW_VALUE; },
                reset() { select.value = ''; toggleNew(false); }
            };

            root._picker = api;
            if (root.dataset.initial) api.set(root.dataset.initial);
            return api;
        }

        document.querySelectorAll('.category-picker').forEach(initCategoryPicker);

        /* ---------- Sanitasi Input Bilangan Bulat & Stepper (+/-) ---------- */
        function formatInteger(el) {
            const digitsBefore = el.value.slice(0, el.selectionStart).replace(/\D/g, '').length;
            const digits = el.value.replace(/\D/g, '').replace(/^0+(?=\d)/, '');
            el.value = digits;

            const pos = Math.min(digitsBefore, el.value.length);
            el.setSelectionRange(pos, pos);
        }

        document.addEventListener('click', e => {
            const btn = e.target.closest('[data-stepper]');
            if (!btn) return;
            const input = btn.parentElement.querySelector('.js-integer');
            if (!input) return;
            const currentVal = parseInt(input.value, 10) || 0;
            const step = parseInt(btn.dataset.stepper, 10);
            input.value = String(Math.max(0, currentVal + step));
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });

        /* ---------- Format Ribuan Input Harga ---------- */
        function rupiahHidden(el) { return el.closest('.input-group').nextElementSibling; }

        function setRupiah(el, value) {
            const digits = String(value ?? '').replace(/\D/g, '');
            el.value = digits ? rupiah.format(digits) : '';
            rupiahHidden(el).value = digits;
        }

        function formatRupiah(el) {
            const digitsBefore = el.value.slice(0, el.selectionStart).replace(/\D/g, '').length;
            const digits = el.value.replace(/\D/g, '').replace(/^0+(?=\d)/, '');
            el.value = digits ? rupiah.format(digits) : '';
            rupiahHidden(el).value = digits;

            let seen = 0, pos = 0;
            while (pos < el.value.length && seen < digitsBefore) {
                if (/\d/.test(el.value[pos])) seen++;
                pos++;
            }
            el.setSelectionRange(pos, pos);
        }

        document.addEventListener('input', e => {
            if (e.target.classList.contains('js-integer')) formatInteger(e.target);
            if (e.target.classList.contains('js-rupiah')) formatRupiah(e.target);
        });
        document.querySelectorAll('.js-integer').forEach(el => formatInteger(el));
        document.querySelectorAll('.js-rupiah').forEach(el => setRupiah(el, rupiahHidden(el).value));

        /* ---------- Wizard Tambah Data Obat ---------- */
        const modalTambah = document.getElementById('modalTambahObat');
        const formTambah = document.getElementById('formTambahObat');
        const panels = Array.from(formTambah.querySelectorAll('.wizard-panel'));
        const stepDots = Array.from(modalTambah.querySelectorAll('.wizard-step'));
        const progressFill = document.getElementById('wizardProgressFill');
        const btnCancel = document.getElementById('btnCancel');
        const btnBack = document.getElementById('btnBack');
        const btnNext = document.getElementById('btnNext');
        const btnSubmit = document.getElementById('btnSubmit');
        const expInput = document.getElementById('add_exp');
        const TOTAL_STEPS = panels.length;
        let current = 1;

        expInput.min = toInputDate(new Date());

        function showStep(n) {
            const direction = n >= current ? 'forward' : 'back';
            current = n;
            panels.forEach(p => {
                const active = parseInt(p.dataset.step, 10) === n;
                p.classList.toggle('active', active);
                if (active) p.dataset.dir = direction;
            });
            stepDots.forEach(s => {
                const idx = parseInt(s.dataset.step, 10);
                s.classList.toggle('active', idx === n);
                s.classList.toggle('done', idx < n);
                s.querySelector('.wizard-dot').textContent = idx;
            });
            progressFill.style.width = ((n - 1) / (TOTAL_STEPS - 1) * 100) + '%';
            btnCancel.classList.toggle('d-none', n !== 1);
            btnBack.classList.toggle('d-none', n === 1);
            btnNext.classList.toggle('d-none', n === TOTAL_STEPS);
            btnSubmit.classList.toggle('d-none', n !== TOTAL_STEPS);
            if (n === TOTAL_STEPS) buildReview();
        }

        function panelOf(n) { return panels.find(p => parseInt(p.dataset.step, 10) === n); }

        function goNext() {
            if (!validateScope(panelOf(current))) return;
            showStep(Math.min(current + 1, TOTAL_STEPS));
        }

        function buildReview() {
            const f = formTambah.elements;
            const picker = formTambah.querySelector('.category-picker')._picker;
            let expFormatted = '-';
            if (f['tanggal_kadaluwarsa'].value) {
                const expDate = new Date(f['tanggal_kadaluwarsa'].value + 'T00:00:00');
                if (!isNaN(expDate.getTime())) {
                    expFormatted = expDate.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
                }
            }

            const rows = [
                ['Kode SKU', f['sku'].value.trim().toUpperCase()],
                ['Nama Obat', f['nama_obat'].value.trim()],
                ['Kategori', f['kategori'].value + (picker.isNew() ? ' (Kategori Baru)' : '')],
                ['Kemasan / Sediaan', f['jenis_obat'].value.trim()],
                ['Stok Awal', f['stok'].value + ' unit'],
                ['Stok Minimum', f['batas_minimum'].value + ' unit'],
                ['Harga Satuan', 'Rp ' + rupiah.format(f['harga_obat'].value || 0)],
                ['Tanggal Kedaluwarsa', expFormatted]
            ];

            const list = document.getElementById('reviewList');
            list.replaceChildren();
            rows.forEach(([label, value]) => {
                const row = document.createElement('div');
                row.className = 'review-row';
                const dt = document.createElement('dt'); dt.textContent = label;
                const dd = document.createElement('dd'); dd.textContent = value;
                row.append(dt, dd);
                list.appendChild(row);
            });
        }

        btnNext.addEventListener('click', goNext);
        btnBack.addEventListener('click', () => showStep(Math.max(current - 1, 1)));

        formTambah.addEventListener('submit', e => {
            if (current < TOTAL_STEPS) {
                e.preventDefault();
                goNext();
                return;
            }
            for (let i = 1; i <= TOTAL_STEPS - 1; i++) {
                if (!validateScope(panelOf(i))) {
                    e.preventDefault();
                    showStep(i);
                    return;
                }
            }
            setLoading(btnSubmit);
        });

        modalTambah.addEventListener('hidden.bs.modal', () => {
            formTambah.querySelectorAll('input:not([type="hidden"])').forEach(el => {
                el.value = el.dataset.default !== undefined ? el.dataset.default : '';
                el.classList.remove('is-invalid');
            });
            formTambah.querySelector('.category-picker')._picker.reset();
            formTambah.querySelector('.category-picker select').classList.remove('is-invalid');
            formTambah.elements['harga_obat'].value = '';
            resetLoading(btnSubmit);
            current = 1;
            showStep(1);
        });
        modalTambah.addEventListener('shown.bs.modal', () => document.getElementById('add_sku').focus());
        showStep(1);

        @if($errors->any() && old('_form') === 'tambah')
        bootstrap.Modal.getOrCreateInstance(modalTambah).show();
        @endif

        /* ---------- Modal Ubah Data Obat ---------- */
        const modalEdit = document.getElementById('modalEditObat');
        const formEdit = document.getElementById('formEditObat');

        modalEdit.addEventListener('show.bs.modal', e => {
            const trigger = e.relatedTarget;
            if (!trigger || !trigger.dataset.obat) return;

            formEdit.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            resetLoading(formEdit.querySelector('.js-loading-submit'));

            const obat = JSON.parse(trigger.dataset.obat);
            const f = formEdit.elements;
            ['sku', 'nama_obat', 'jenis_obat', 'stok', 'batas_minimum', 'harga_obat', 'tanggal_kadaluwarsa']
                .forEach(name => { f[name].value = obat[name]; });
            formatInteger(f['stok']);
            formatInteger(f['batas_minimum']);
            setRupiah(formEdit.querySelector('.js-rupiah'), obat.harga_obat);
            formEdit.querySelector('.category-picker')._picker.set(obat.kategori);
            formEdit.action = trigger.dataset.updateUrl;
        });

        formEdit.addEventListener('submit', e => {
            if (!validateScope(formEdit)) {
                e.preventDefault();
                return;
            }
            setLoading(formEdit.querySelector('.js-loading-submit'));
        });

        /* ---------- Modal Konfirmasi Hapus ---------- */
        const modalHapus = document.getElementById('modalHapusObat');
        const formHapus = document.getElementById('formHapusObat');

        modalHapus.addEventListener('show.bs.modal', e => {
            const trigger = e.relatedTarget;
            if (!trigger) return;
            resetLoading(formHapus.querySelector('.js-loading-submit'));
            document.getElementById('hapusNamaObat').textContent = trigger.dataset.nama;
            formHapus.action = trigger.dataset.deleteUrl;
        });

        formHapus.addEventListener('submit', () => {
            setLoading(formHapus.querySelector('.js-loading-submit'));
        });
    })();
</script>
</body>
</html>
