<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Kontrol Apoteker - Apotek USD</title>
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

        @keyframes pageEntrance {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .text-maroon { color: var(--maroon) !important; }

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
        .user-identity {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .user-name {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-dark);
            line-height: 1.25;
            text-transform: capitalize;
        }
        .user-id {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 600;
            line-height: 1.25;
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
        }

        /* ---------- Tata Letak Utama ---------- */
        .pos-container {
            flex: 1;
            display: flex;
            overflow: hidden;
            padding: 0.85rem 1.15rem;
            gap: 0.85rem;
            animation: pageEntrance 0.35s var(--ease-out) forwards;
        }

        .workspace-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            overflow: hidden;
        }

        .table-card {
            flex: 1;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .table-card-header {
            padding: 0.95rem 1.25rem;
            border-bottom: 1.5px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            background: #ffffff;
        }
        .card-title-main {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-dark);
            display: block;
        }
        .card-title-sub {
            font-size: 0.84rem;
            color: var(--text-muted);
            display: block;
            margin-top: 2px;
        }

        .badge-queue-pending {
            background: #f8fafc;
            color: var(--maroon);
            border: 1px solid var(--border-soft);
            font-size: 0.82rem;
            font-weight: 700;
            padding: 4px 11px;
            border-radius: 999px;
            white-space: nowrap;
        }
        .badge-queue-clear {
            background: #f8fafc;
            color: var(--text-muted);
            border: 1px solid var(--border-soft);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 4px 11px;
            border-radius: 999px;
            white-space: nowrap;
        }

        .table-wrapper {
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .table-custom {
            width: 100%;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
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
            font-size: 0.98rem;
            transition: background-color 0.15s ease;
        }
        .table-custom tbody tr:hover td {
            background-color: #fafbfc;
        }

        .sub-note {
            display: block;
            font-size: 0.84rem;
            color: var(--text-muted);
            margin-top: 2px;
        }
        .med-item-name {
            font-size: 0.94rem;
            font-weight: 600;
            color: var(--text-dark);
        }
        .med-qty-badge {
            background: #f8fafc;
            color: #475569;
            border: 1px solid var(--border-soft);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 6px;
            white-space: nowrap;
        }

        .empty-center-cell {
            height: calc(100vh - 245px);
            vertical-align: middle !important;
            text-align: center;
            border-bottom: none !important;
        }
        .empty-icon-box {
            width: 58px;
            height: 58px;
            background: #f1f5f9;
            color: #94a3b8;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 0.8rem;
        }

        /* ---------- Panel Kanan ---------- */
        .panel-right {
            width: 395px;
            min-width: 395px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            overflow-y: auto;
        }

        .panel-section-distinct {
            padding: 1rem 1.2rem;
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
        }

        .section-heading {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: #334155;
            margin: 0;
        }
        .section-heading-row {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        /* ---------- Ringkasan ---------- */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.55rem;
        }
        .kpi-box {
            --kpi-accent: var(--maroon);
            --kpi-soft: #fff5f5;
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            grid-template-areas: "label" "value";
            align-items: center;
            gap: 0.3rem;
            min-height: 82px;
            padding: 0.7rem 0.75rem;
            border: 1px solid #f0dada;
            border-left: 3px solid var(--kpi-accent);
            border-radius: 11px;
            background: var(--kpi-soft);
        }
        .kpi-label {
            grid-area: label;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            line-height: 1.3;
            color: #586579;
        }
        .kpi-value {
            grid-area: value;
            font-size: 1.65rem;
            font-weight: 800;
            line-height: 1.1;
            color: var(--kpi-accent);
            font-variant-numeric: tabular-nums;
        }
        /* ---------- Tombol Tindakan ---------- */
        .btn-maroon-sm {
            background: var(--maroon);
            color: #ffffff;
            border: none;
            padding: 0.42rem 0.9rem;
            font-size: 0.86rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-maroon-sm:hover {
            background: var(--maroon-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-outline-sm {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid var(--border-soft);
            padding: 0.42rem 0.9rem;
            font-size: 0.86rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .btn-outline-sm:hover {
            background: #fef2f2;
            border-color: #fecaca;
        }

        /* ---------- Daftar Stok & Kedaluwarsa ---------- */
        .side-list {
            max-height: 205px;
            overflow-y: auto;
        }
        .side-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.65rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .side-list-item:first-child { padding-top: 0.1rem; }
        .side-list-item:last-child {
            padding-bottom: 0.1rem;
            border-bottom: 0;
        }
        .side-item-main {
            min-width: 0;
        }
        .side-item-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        .side-item-sub {
            font-size: 0.76rem;
            color: var(--text-muted);
        }
        .side-item-badge {
            flex-shrink: 0;
            padding: 0.2rem 0.45rem;
            border-radius: 7px;
            background: #fce8e8;
            color: #8b0000;
            font-size: 0.76rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .side-item-badge small {
            font-size: 0.7rem;
            font-weight: 500;
            color: #7f1d1d;
        }
        .side-item-badge.expiry-urgent,
        .side-item-badge.expiry-normal,
        .side-item-badge.expiry-warm {
            background: #fce8e8;
            color: #8b0000;
        }
        .empty-side-list {
            padding: 0.65rem 0;
            color: var(--text-muted);
            font-size: 0.82rem;
            text-align: center;
        }

        .header-clock {
            font-size: 0.95rem;
            color: var(--text-muted);
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        @media (max-width: 900px) {
            body {
                height: auto;
                min-height: 100vh;
                overflow: auto;
            }
            .pos-header {
                flex-wrap: wrap;
                gap: 0.75rem;
                padding: 0.75rem 1rem;
            }
            .pos-header > .d-flex:first-child {
                flex-wrap: wrap;
                gap: 0.75rem !important;
            }
            .pos-header > .d-flex:last-child {
                margin-left: auto;
            }
            .nav-segmented {
                margin-left: 0 !important;
            }
            .pos-container {
                flex: none;
                flex-direction: column;
                overflow: visible;
                padding: 0.75rem;
                gap: 0.75rem;
            }
            .workspace-left {
                flex: none;
                min-width: 0;
                overflow: visible;
            }
            .table-card {
                flex: none;
                min-height: 440px;
            }
            .table-wrapper {
                min-height: 0;
                overflow: auto;
            }
            .table-custom-scrollable {
                min-width: 1050px;
            }
            .table-custom-empty {
                width: 100%;
                table-layout: fixed;
            }
            .table-custom-empty thead {
                display: none;
            }
            .panel-right {
                width: 100%;
                min-width: 0;
                overflow: visible;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                align-items: start;
            }
            .panel-section-distinct:first-child {
                grid-column: 1 / -1;
            }
            .panel-section-distinct.flex-grow-1 {
                flex-grow: 0 !important;
            }
        }

        @media (max-width: 600px) {
            .pos-header {
                flex-direction: column;
                align-items: stretch;
            }
            .pos-header > .d-flex:first-child {
                width: 100%;
            }
            .pos-header > .d-flex:last-child {
                width: 100%;
                justify-content: flex-end;
                margin-left: 0;
            }
            .nav-segmented {
                width: 100%;
            }
            .nav-segmented a {
                flex: 1;
                padding: 0.5rem 0.35rem;
                font-size: 0.78rem;
                text-align: center;
                white-space: nowrap;
            }
            .pos-container {
                padding: 0.65rem;
            }
            .table-card {
                min-height: 390px;
            }
            .empty-center-cell {
                height: 260px;
            }
            .table-card-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 0.65rem;
                padding: 0.85rem 1rem;
            }
            .card-title-main {
                font-size: 0.98rem;
            }
            .card-title-sub {
                font-size: 0.78rem;
            }
            .panel-right {
                grid-template-columns: minmax(0, 1fr);
            }
            .panel-section-distinct:first-child {
                grid-column: auto;
            }
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-4">
        <div class="user-identity">
            <span class="user-name">{{ Auth::user()->nama_pengguna ?? 'Apoteker' }}</span>
            <span class="user-id">{{ Auth::user()->username ?? 'apoteker' }}</span>
        </div>

        <nav class="nav-segmented ms-2">
            <a href="{{ route('apoteker.dashboard') }}" class="active">Dashboard Validasi</a>
            <a href="{{ route('apoteker.obat.index') }}">Katalog Obat</a>
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

<main class="pos-container">

    <section class="workspace-left">
        <div class="table-card">

            <div class="table-card-header">
                <div>
                    <span class="card-title-main">Antrean Validasi Resep Dokter</span>
                    <span class="card-title-sub">Daftar resep dari kasir yang memerlukan verifikasi apoteker</span>
                </div>
                @if($totalPending > 0)
                    <span class="badge-queue-pending">
                        {{ $totalPending }} Resep Menunggu
                    </span>
                @else
                    <span class="badge-queue-clear">
                        Semua Terverifikasi
                    </span>
                @endif
            </div>

            <div class="table-wrapper">
                <table class="table-custom {{ $totalPending > 0 ? 'table-custom-scrollable' : 'table-custom-empty' }}">
                    <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 15%;">No. Resep / Tgl</th>
                        <th style="width: 24%;">Dokter &amp; Faskes</th>
                        <th style="width: 29%;">Item Obat Diresepkan</th>
                        <th style="width: 13%;">Total Tagihan</th>
                        <th style="width: 14%; text-align: center;">Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pendingResep as $index => $trx)
                        @php
                            $namaDokter = $trx->resep?->nama_dokter;
                            $kodeResep  = ($namaDokter && $namaDokter !== 'Tidak Diketahui')
                                ? 'RSP-00' . $trx->id_resep
                                : 'RSP-AUTO-' . $trx->id_transaksi;
                        @endphp
                        <tr>
                            <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                            <td>
                                <span class="fw-bold text-dark font-monospace d-block">{{ $kodeResep }}</span>
                                <span class="sub-note">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y, H:i') }}</span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $namaDokter ?? 'Dokter' }}</div>
                                <span class="sub-note">{{ $trx->resep?->nama_klinik ?? 'Fasilitas Kesehatan' }}</span>
                            </td>
                            <td>
                                @foreach($trx->detail_transaksi as $detail)
                                    <div class="d-flex justify-content-between align-items-center gap-2 mb-1">
                                        <span class="med-item-name">• {{ $detail->obat->nama_obat ?? 'Obat' }}</span>
                                        <span class="med-qty-badge">{{ $detail->jumlah_beli }} {{ $detail->obat->jenis_obat ?? 'Unit' }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td class="fw-bold text-maroon" style="font-variant-numeric: tabular-nums;">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <form action="{{ route('apoteker.resep.approve', $trx->id_transaksi) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn-maroon-sm">Setujui</button>
                                    </form>

                                    <form action="{{ route('apoteker.resep.reject', $trx->id_transaksi) }}" method="POST" class="m-0"
                                          data-confirm="Apakah Anda yakin ingin menolak resep ini?"
                                          data-confirm-title="Tolak resep?"
                                          data-confirm-accept="Tolak resep">
                                        @csrf
                                        <button type="submit" class="btn-outline-sm">Tolak</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-center-cell">
                                <div class="empty-icon-box">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Tidak Ada Antrean Resep</div>
                                <p class="text-muted mb-0" style="font-size: 0.92rem;">Resep baru dari kasir akan tampil secara otomatis pada tabel ini.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <aside class="panel-right">

        <div class="panel-section-distinct">
            <div class="section-heading-row">
                <h2 class="section-heading">Ringkasan</h2>
            </div>
            <div class="kpi-grid">
                <div class="kpi-box">
                    <span class="kpi-label">Antrean Resep</span>
                    <div class="kpi-value">{{ $totalPending }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Katalog Obat</span>
                    <div class="kpi-value">{{ $totalObat }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Stok Menipis</span>
                    <div class="kpi-value">{{ $totalKritis }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Hampir Kedaluwarsa</span>
                    <div class="kpi-value">{{ $totalExpiredAlert }}</div>
                </div>
            </div>
        </div>

        <div class="panel-section-distinct">
            <div class="section-heading-row">
                <h2 class="section-heading">Stok Menipis</h2>
            </div>
            <div class="side-list">
                @forelse($stokKritis as $obat)
                    <div class="side-list-item">
                        <div class="side-item-main">
                            <div class="side-item-title text-truncate">{{ $obat->nama_obat }}</div>
                            <span class="side-item-sub font-monospace">{{ $obat->sku }}</span>
                        </div>
                        <span class="side-item-badge">
                            {{ $obat->stok }} <small>/ {{ $obat->batas_minimum }} unit</small>
                        </span>
                    </div>
                @empty
                    <div class="empty-side-list">Semua stok obat aman.</div>
                @endforelse
            </div>
        </div>

        <div class="panel-section-distinct flex-grow-1">
            <div class="section-heading-row">
                <h2 class="section-heading">Hampir Kedaluwarsa</h2>
            </div>
            <div class="side-list">
                @forelse($mendekatiExpired as $obat)
                    @php
                        $tglExp       = \Carbon\Carbon::parse($obat->tanggal_kadaluwarsa)->startOfDay();
                        $diffInDays   = (int) now()->startOfDay()->diffInDays($tglExp, false);
                        $diffInMonths = (int) round($diffInDays / 30);
                    @endphp
                    <div class="side-list-item">
                        <div class="side-item-main">
                            <div class="side-item-title text-truncate">{{ $obat->nama_obat }}</div>
                            <span class="side-item-sub">{{ $tglExp->format('d M Y') }}</span>
                        </div>
                        @if($diffInDays <= 0)
                            <span class="side-item-badge expiry-urgent">Kedaluwarsa</span>
                        @elseif($diffInMonths <= 3)
                            <span class="side-item-badge expiry-urgent">{{ max(1, $diffInMonths) }} Bulan</span>
                        @elseif($diffInMonths <= 6)
                            <span class="side-item-badge expiry-warm">{{ $diffInMonths }} Bulan</span>
                        @else
                            <span class="side-item-badge expiry-normal">{{ $diffInMonths }} Bulan</span>
                        @endif
                    </div>
                @empty
                    <div class="empty-side-list">Tidak ada obat mendekati kedaluwarsa.</div>
                @endforelse
            </div>
        </div>

    </aside>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/system-popups.js') }}"></script>
<script>
    (function () {
        'use strict';

        const clockEl = document.getElementById('headerLiveClock');
        function updateHeaderClock() {
            clockEl.textContent = new Date().toLocaleTimeString('en-GB', {
                timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', hour12: false
            }) + ' WIB';
        }
        updateHeaderClock();
        setInterval(updateHeaderClock, 1000);
    })();
</script>

</body>
</html>
