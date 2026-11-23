<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Kontrol Apoteker - Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            --text-body: #334155;
            --text-muted: #64748b;
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
        }

        *, *::before, *::after { box-sizing: border-box; }

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
            font-variant-numeric: tabular-nums;
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
            min-width: 0;
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

        .table-wrapper {
            flex: 1;
            overflow: auto;
            display: flex;
            flex-direction: column;
        }
        .table-custom {
            width: 100%;
            min-width: 960px;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.15px;
            padding: 0.85rem 0.65rem;
            border-bottom: 1.5px solid var(--border-soft);
            position: sticky;
            top: 0;
            z-index: 5;
            white-space: nowrap;
            text-align: center;
            vertical-align: middle;
        }

        .table-custom tbody.trx-group td {
            padding: 0.85rem 0.65rem;
            vertical-align: middle;
            text-align: center;
            font-size: 0.98rem;
            line-height: 1.45;
            color: var(--text-body);
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.15s ease;
        }
        .table-custom tbody.trx-group tr:last-child td,
        .table-custom tbody.trx-group td[rowspan] {
            border-bottom: 1px solid #e2e8f0;
        }

        .table-custom tbody.trx-group:hover td {
            background-color: #fafbfc;
        }

        /* Tipografi Kolom Selaras dengan Katalog Obat */
        .col-no {
            font-weight: 500;
            color: var(--text-muted) !important;
            font-variant-numeric: tabular-nums;
        }
        .col-resep {
            font-weight: 600;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.25px;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }
        .col-date-main {
            display: block;
            font-weight: 500;
            color: var(--text-dark);
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }
        .col-sub-note {
            display: block;
            font-size: 0.85rem;
            font-weight: 400;
            color: var(--text-muted);
            margin-top: 2px;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }
        .col-dokter {
            font-weight: 600;
            color: var(--text-dark);
        }
        .col-faskes {
            font-weight: 400;
            color: #475569 !important;
        }
        .col-obat {
            font-weight: 600;
            color: var(--text-dark);
        }
        .col-jumlah {
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }
        .qty-val {
            font-weight: 600;
            color: var(--text-dark);
        }
        .qty-unit {
            font-weight: 400;
            color: var(--text-muted);
        }
        .col-total {
            font-weight: 600;
            color: var(--maroon) !important;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        /* ---------- Tombol Tindakan Simetris ---------- */
        .action-btn-group {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            height: 33px;
            padding: 0 0.7rem;
            font-size: 0.84rem;
            font-weight: 600;
            line-height: 1;
            border-radius: 8px;
            transition: all 0.2s ease;
            white-space: nowrap;
            cursor: pointer;
        }
        .btn-action-approve {
            background: var(--maroon);
            color: #ffffff;
            border: 1px solid var(--maroon);
        }
        .btn-action-approve:hover {
            background: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }
        .btn-action-reject {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .btn-action-reject:hover {
            background: #fef2f2;
            border-color: #fca5a5;
            color: #b91c1c;
            transform: translateY(-1px);
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

        .side-empty-state {
            flex: 1;
            min-height: 168px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem 0.5rem;
            gap: 0.45rem;
        }
        .side-empty-icon {
            color: #cbd5e1;
            font-size: 1.55rem;
            line-height: 1;
        }
        .side-empty-text {
            color: var(--text-muted);
            font-size: 0.88rem;
            font-weight: 500;
            line-height: 1.35;
        }

        /* ---------- Panel Kanan ---------- */
        .panel-right {
            width: 395px;
            min-width: 395px;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .panel-section-distinct {
            padding: 0.85rem 1.2rem;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            flex-direction: column;
        }
        .panel-section-distinct:last-child {
            border-bottom: none;
        }

        .section-heading {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: #334155;
            display: block;
            margin-bottom: 0.5rem;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .kpi-box {
            padding: 0.85rem 0.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .kpi-box:nth-child(odd) {
            border-right: 1px solid #cbd5e1;
        }
        .kpi-box:nth-child(1),
        .kpi-box:nth-child(2) {
            border-bottom: 1px solid #cbd5e1;
        }
        .kpi-box:nth-child(3),
        .kpi-box:nth-child(4) {
            padding-bottom: 0.1rem;
        }
        .kpi-label {
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: var(--text-muted);
            display: block;
            margin-bottom: 0.3rem;
        }
        .kpi-value {
            font-size: 1.55rem;
            font-weight: 800;
            line-height: 1.1;
            color: var(--text-dark);
            font-variant-numeric: tabular-nums;
        }

        .side-list-table {
            font-size: 0.92rem;
        }
        .side-item-title {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--text-dark);
            max-width: 195px;
        }
        .side-item-sub {
            font-size: 0.8rem;
            font-weight: 400;
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }
        .side-item-sku {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.25px;
            font-variant-numeric: tabular-nums;
        }
        .stock-current {
            font-size: 0.9rem;
            font-weight: 600;
            color: #b91c1c;
            font-variant-numeric: tabular-nums;
        }
        .stock-min-limit {
            font-size: 0.8rem;
            font-weight: 400;
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }

        .expiry-status-urgent {
            font-size: 0.88rem;
            font-weight: 600;
            color: #b91c1c;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
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
            <a href="{{ route('apoteker.dashboard') }}" class="active">Dashboard</a>
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

@php
    $todayStart = now()->startOfDay();
    $peringatanSatuBulan = collect($mendekatiExpired ?? [])->filter(function ($obat) use ($todayStart) {
        $tglExp = \Carbon\Carbon::parse($obat->tanggal_kadaluwarsa)->startOfDay();
        $sisaHari = (int) $todayStart->diffInDays($tglExp, false);
        return $sisaHari <= 30;
    });
@endphp

<main class="pos-container">

    <section class="workspace-left">
        <div class="table-card">

            <div class="table-card-header">
                <div>
                    <span class="card-title-main">Antrean Validasi Resep Dokter</span>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table-custom">
                    <thead>
                    <tr>
                        <th style="width: 4%;">No.</th>
                        <th style="width: 11%;">No. Resep</th>
                        <th style="width: 11%;">Waktu</th>
                        <th style="width: 13%;">Dokter</th>
                        <th style="width: 11%;">Faskes</th>
                        <th style="width: 19%;">Obat</th>
                        <th style="width: 10%;">Jumlah</th>
                        <th style="width: 10%;">Total</th>
                        <th style="width: 11%;">Tindakan</th>
                    </tr>
                    </thead>

                    @forelse($pendingResep as $index => $trx)
                        @php
                            $namaDokter = $trx->resep?->nama_dokter;
                            $kodeResep  = ($namaDokter && $namaDokter !== 'Tidak Diketahui')
                                ? 'RSP-00' . $trx->id_resep
                                : 'RSP-AUTO-' . $trx->id_transaksi;
                            $waktuTrx   = \Carbon\Carbon::parse($trx->tanggal_transaksi);
                            $details    = $trx->detail_transaksi;
                            $rowCount   = max($details->count(), 1);
                        @endphp
                        <tbody class="trx-group">
                        @forelse($details as $dIndex => $detail)
                            <tr>
                                @if($dIndex === 0)
                                    <td rowspan="{{ $rowCount }}" class="col-no">{{ $index + 1 }}</td>
                                    <td rowspan="{{ $rowCount }}" class="col-resep">{{ $kodeResep }}</td>
                                    <td rowspan="{{ $rowCount }}">
                                        <span class="col-date-main">{{ $waktuTrx->format('d M Y') }}</span>
                                        <span class="col-sub-note">{{ $waktuTrx->format('H:i') }} WIB</span>
                                    </td>
                                    <td rowspan="{{ $rowCount }}" class="col-dokter">{{ $namaDokter ?? '-' }}</td>
                                    <td rowspan="{{ $rowCount }}" class="col-faskes">{{ $trx->resep?->nama_klinik ?? '-' }}</td>
                                @endif

                                <td class="col-obat">{{ $detail->obat->nama_obat ?? 'Obat' }}</td>
                                <td class="col-jumlah">
                                    <span class="qty-val">{{ $detail->jumlah_beli }}</span>
                                    <span class="qty-unit">{{ $detail->obat->jenis_obat ?? 'Unit' }}</span>
                                </td>

                                @if($dIndex === 0)
                                    <td rowspan="{{ $rowCount }}" class="col-total">
                                        Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td rowspan="{{ $rowCount }}">
                                        <div class="action-btn-group">
                                            <form action="{{ route('apoteker.resep.approve', $trx->id_transaksi) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn-action btn-action-approve">Setujui</button>
                                            </form>

                                            <form action="{{ route('apoteker.resep.reject', $trx->id_transaksi) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn-action btn-action-reject" onclick="return confirm('Apakah Anda yakin ingin menolak resep ini?')">Tolak</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td class="col-no">{{ $index + 1 }}</td>
                                <td class="col-resep">{{ $kodeResep }}</td>
                                <td>
                                    <span class="col-date-main">{{ $waktuTrx->format('d M Y') }}</span>
                                    <span class="col-sub-note">{{ $waktuTrx->format('H:i') }} WIB</span>
                                </td>
                                <td class="col-dokter">{{ $namaDokter ?? '-' }}</td>
                                <td class="col-faskes">{{ $trx->resep?->nama_klinik ?? '-' }}</td>
                                <td class="col-obat text-muted">-</td>
                                <td class="col-jumlah text-muted">-</td>
                                <td class="col-total">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="action-btn-group">
                                        <form action="{{ route('apoteker.resep.approve', $trx->id_transaksi) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn-action btn-action-approve">Setujui</button>
                                        </form>

                                        <form action="{{ route('apoteker.resep.reject', $trx->id_transaksi) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn-action btn-action-reject" onclick="return confirm('Apakah Anda yakin ingin menolak resep ini?')">Tolak</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    @empty
                        <tbody>
                        <tr>
                            <td colspan="9" class="empty-center-cell">
                                <div class="empty-icon-box">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <div class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Tidak Ada Antrean Resep</div>
                                <p class="text-muted mb-0" style="font-size: 0.92rem;">Resep baru dari kasir akan tampil secara otomatis pada tabel ini.</p>
                            </td>
                        </tr>
                        </tbody>
                    @endforelse
                </table>
            </div>
        </div>
    </section>

    <aside class="panel-right">

        <!-- Bagian 1: Ringkasan KPI -->
        <div class="panel-section-distinct">
            <span class="section-heading">Ringkasan</span>
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
                    <span class="kpi-label">Mendekati ED</span>
                    <div class="kpi-value">{{ $peringatanSatuBulan->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Stok Menipis (Default tampil 3 item penuh) -->
        <div class="panel-section-distinct">
            <span class="section-heading">Stok Menipis</span>

            @if(collect($stokKritis ?? [])->isNotEmpty())
                <div class="table-responsive pe-1" style="max-height: 168px; overflow-y: auto;">
                    <table class="table table-sm table-borderless align-middle mb-0 side-list-table">
                        <tbody>
                        @foreach($stokKritis as $obat)
                            <tr class="border-bottom border-light">
                                <td class="ps-0 py-2">
                                    <div class="side-item-title text-truncate">{{ $obat->nama_obat }}</div>
                                    <span class="side-item-sku d-block">{{ $obat->sku }}</span>
                                </td>
                                <td class="text-end pe-0 py-2" style="white-space: nowrap;">
                                    <span class="stock-current">{{ $obat->stok }}</span>
                                    <span class="stock-min-limit">/ {{ $obat->batas_minimum }} unit</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="side-empty-state">
                    <i class="bi bi-inbox side-empty-icon"></i>
                    <span class="side-empty-text">Belum ada stok obat yang menipis.</span>
                </div>
            @endif
        </div>

        <!-- Bagian 3: Peringatan Kedaluwarsa (<= 1 Bulan) -->
        <div class="panel-section-distinct flex-grow-1">
            <span class="section-heading">Peringatan Kadaluwarsa</span>

            @if($peringatanSatuBulan->isNotEmpty())
                <div class="table-responsive pe-1" style="max-height: 230px; overflow-y: auto;">
                    <table class="table table-sm table-borderless align-middle mb-0 side-list-table">
                        <tbody>
                        @foreach($peringatanSatuBulan as $obat)
                            @php
                                $tglExp   = \Carbon\Carbon::parse($obat->tanggal_kadaluwarsa)->startOfDay();
                                $sisaHari = (int) $todayStart->diffInDays($tglExp, false);
                            @endphp
                            <tr class="border-bottom border-light">
                                <td class="ps-0 py-2">
                                    <div class="side-item-title text-truncate">{{ $obat->nama_obat }}</div>
                                    <span class="side-item-sub d-block">{{ $tglExp->format('d M Y') }}</span>
                                </td>
                                <td class="text-end pe-0 py-2">
                                    @if($sisaHari < 0)
                                        <span class="expiry-status-urgent">Kedaluwarsa</span>
                                    @elseif($sisaHari === 0)
                                        <span class="expiry-status-urgent">Hari ini</span>
                                    @else
                                        <span class="expiry-status-urgent">{{ $sisaHari }} Hari</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="side-empty-state">
                    <i class="bi bi-inbox side-empty-icon"></i>
                    <span class="side-empty-text">Belum ada obat yang mendekati kadaluarsa.</span>
                </div>
            @endif
        </div>

    </aside>

</main>

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
