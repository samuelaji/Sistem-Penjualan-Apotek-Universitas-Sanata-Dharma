<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - Apotek USD</title>
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
        }

        .btn-maroon-hero {
            background: var(--maroon);
            color: #ffffff;
            border: none;
            padding: 0.85rem 1.65rem;
            font-size: 0.96rem;
            font-weight: 700;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s var(--ease-out);
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.16);
            white-space: nowrap;
        }
        .btn-maroon-hero:hover {
            background: var(--maroon-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.24);
        }
        .btn-maroon-hero:active { transform: scale(0.98); }

        /* ---------- Tabel Riwayat Transaksi ---------- */
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
            background: #ffffff;
        }
        .card-title-main {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-dark);
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
            font-size: 0.96rem;
            transition: background-color 0.15s ease;
        }
        .table-custom tbody tr:hover td {
            background-color: #fafbfc;
        }

        .badge-method-cash {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
        }
        .badge-method-other {
            background: #f8fafc;
            color: #475569;
            border: 1px solid var(--border-soft);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
            text-transform: uppercase;
        }

        .empty-center-cell {
            height: calc(100vh - 235px);
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

        /* ---------- Panel Kanan (Shift) ---------- */
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
            padding: 1rem 1.2rem;
            border-bottom: 1px solid var(--border-soft);
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
            margin-bottom: 0.65rem;
        }

        /* ---------- Informasi Shift (Flat dengan garis pemisah tipis) ---------- */
        .kpi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .kpi-box {
            padding: 0.15rem 0.75rem;
        }
        .kpi-box:first-child {
            padding-left: 0;
            border-right: 1px solid #f1f5f9;
        }
        .kpi-box:last-child {
            padding-right: 0;
            padding-left: 1rem;
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
            font-size: 1.45rem;
            font-weight: 800;
            line-height: 1.15;
            color: var(--text-dark);
            font-variant-numeric: tabular-nums;
        }
        .kpi-unit {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        /* ---------- Input Nominal Uang ---------- */
        .money-input-group {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            background: #f8fafc;
            transition: all 0.2s ease;
            overflow: hidden;
        }
        .money-input-group:focus-within {
            background: #ffffff;
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }
        .money-prefix {
            padding: 0.65rem 0.9rem;
            background: transparent;
            border-right: 1.5px solid var(--border-soft);
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.95rem;
        }
        .money-input {
            border: none;
            outline: none;
            width: 100%;
            padding: 0.65rem 0.9rem;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text-dark);
            background: transparent;
            font-variant-numeric: tabular-nums;
        }

        .btn-maroon-full {
            background: var(--maroon);
            color: #ffffff;
            border: none;
            padding: 0.8rem 1.2rem;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 10px;
            width: 100%;
            transition: all 0.2s var(--ease-out);
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.16);
        }
        .btn-maroon-full:hover {
            background: var(--maroon-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.24);
        }
        .btn-maroon-full:active { transform: scale(0.99); }

        .btn-struk {
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            color: var(--text-dark);
            padding: 5px 14px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.15s ease;
        }
        .btn-struk:hover {
            background: #ffffff;
            border-color: var(--maroon);
            color: var(--maroon);
        }

        /* ---------- Halaman Buka Shift ---------- */
        .open-shift-wrapper {
            flex: 1;
            background-color: var(--bg-workspace);
            background-image: radial-gradient(rgba(100, 116, 139, 0.24) 1.5px, transparent 1.5px);
            background-size: 26px 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            animation: pageEntrance 0.35s var(--ease-out) forwards;
        }
        .open-shift-card {
            width: 100%;
            max-width: 440px;
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-top: 4px solid var(--maroon);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 12px 28px -6px rgba(15, 23, 42, 0.05);
        }
        .shift-meta-strip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            padding: 0.65rem 0.95rem;
            margin-bottom: 1.35rem;
            font-size: 0.88rem;
        }
        .status-text-idle {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.84rem;
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-4">
        <div class="user-identity">
            <span class="user-name">{{ Auth::user()->nama_pengguna ?? 'Kasir' }}</span>
            <span class="user-id">{{ Auth::user()->username ?? '-' }}</span>
        </div>

        @if($shiftAktif)
            <nav class="nav-segmented ms-2">
                <a href="{{ Route::has('kasir.dashboard') ? route('kasir.dashboard') : url('/kasir/dashboard') }}" class="active">Dashboard Kasir</a>
                <a href="{{ route('transaksi.index') }}">Terminal POS</a>
            </nav>
        @endif
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

@if(!$shiftAktif)
    <main class="open-shift-wrapper">
        <div class="open-shift-card">
            <h4 class="fw-bold text-dark mb-3" style="font-size: 1.35rem;">Buka Shift Kasir</h4>

            <div class="shift-meta-strip">
                <span class="text-muted fw-semibold" id="shiftDateLabel">-</span>
                <span class="status-text-idle">Shift Belum Aktif</span>
            </div>

            <form action="{{ route('kasir.shift.buka') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="section-heading mb-2" for="saldoAwalDisplay">Modal Awal Laci</label>
                    <div class="money-input-group">
                        <span class="money-prefix">Rp</span>
                        <input type="text" id="saldoAwalDisplay" class="money-input" placeholder="0" inputmode="numeric" required autofocus autocomplete="off">
                        <input type="hidden" name="saldo_awal" id="saldoAwalReal">
                    </div>
                </div>

                <button type="submit" class="btn-maroon-hero w-100">
                    Mulai Pelayanan
                </button>
            </form>
        </div>
    </main>

@else
    <main class="pos-container">

        <section class="workspace-left">
            <div class="table-card">
                <div class="table-card-header">
                    <span class="card-title-main">Riwayat Transaksi Terakhir</span>
                </div>

                <div class="table-wrapper">
                    <table class="table-custom">
                        <thead>
                        <tr>
                            <th style="width: 12%;">Waktu</th>
                            <th style="width: 21%;">No. Nota</th>
                            <th style="width: 23%;">Ringkasan Item</th>
                            <th style="width: 18%;">Total Belanja</th>
                            <th style="width: 14%; text-align: center;">Metode</th>
                            <th style="width: 12%; text-align: center;">Nota</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transaksiTerakhir as $trx)
                            <tr>
                                <td class="text-muted" style="font-variant-numeric: tabular-nums;">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('H:i') }}</td>
                                <td class="fw-bold text-dark font-monospace">TRX-{{ str_pad($trx->id_transaksi, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $trx->detail_transaksi->count() }} jenis obat</span>
                                </td>
                                <td class="fw-bold text-dark" style="font-variant-numeric: tabular-nums;">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @if($trx->metode_pembayaran == 'cash')
                                        <span class="badge-method-cash">Tunai</span>
                                    @else
                                        <span class="badge-method-other">{{ $trx->metode_pembayaran }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('transaksi.struk', $trx->id_transaksi) }}" target="_blank" class="btn-struk">
                                        Struk
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-center-cell">
                                    <div class="empty-icon-box">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <div class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Belum Ada Transaksi</div>
                                    <p class="text-muted mb-0" style="font-size: 0.92rem;">Buka Terminal POS untuk mulai mencatat transaksi.</p>
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
                <span class="section-heading">Informasi Shift</span>
                <div class="kpi-grid">
                    <div class="kpi-box">
                        <span class="kpi-label">Waktu Buka</span>
                        <div class="kpi-value">{{ \Carbon\Carbon::parse($shiftAktif->waktu_mulai)->format('H:i') }} <span class="kpi-unit">WIB</span></div>
                    </div>
                    <div class="kpi-box">
                        <span class="kpi-label">Modal Awal</span>
                        <div class="kpi-value">Rp {{ number_format($shiftAktif->saldo_awal, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="panel-section-distinct flex-grow-1 d-flex flex-column justify-content-between">
                <div>
                    <span class="section-heading">Tutup Shift</span>
                    <form action="{{ route('kasir.shift.tutup') }}" method="POST" id="formTutupShift"
                          data-confirm="Pastikan uang fisik di laci sudah dihitung. Setelah shift ditutup, Anda akan keluar dari sistem kasir."
                          data-confirm-title="Tutup shift?"
                          data-confirm-accept="Tutup shift">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label fw-semibold text-muted mb-1" for="uangFisikDisplay" style="font-size: 0.86rem;">Uang Fisik di Laci</label>
                            <div class="money-input-group">
                                <span class="money-prefix">Rp</span>
                                <input type="text" id="uangFisikDisplay" class="money-input" placeholder="0" inputmode="numeric" required autocomplete="off">
                                <input type="hidden" name="uang_fisik" id="uangFisikReal">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="pt-3">
                    <button type="submit" form="formTutupShift" class="btn-maroon-full">
                        Tutup Shift
                    </button>
                </div>
            </div>

        </aside>

    </main>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/system-popups.js') }}"></script>
@if(session('success'))
<script>
    AppPopup.alert(@json(session('success')), { title: 'Berhasil', icon: 'bi-check-circle' });
</script>
@endif
@if(session('error'))
<script>
    AppPopup.alert(@json(session('error')), { title: 'Terjadi kesalahan', icon: 'bi-exclamation-circle' });
</script>
@endif
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

        const rupiah = new Intl.NumberFormat('id-ID');

        function bindRupiahInput(displayId, realId) {
            const displayEl = document.getElementById(displayId);
            const realEl = document.getElementById(realId);
            if (!displayEl || !realEl) return;

            displayEl.addEventListener('input', function () {
                const digitsBefore = this.value.slice(0, this.selectionStart).replace(/\D/g, '').length;
                const digits = this.value.replace(/\D/g, '').replace(/^0+(?=\d)/, '');

                realEl.value = digits;
                this.value = digits ? rupiah.format(digits) : '';

                let seen = 0, pos = 0;
                while (pos < this.value.length && seen < digitsBefore) {
                    if (/\d/.test(this.value[pos])) seen++;
                    pos++;
                }
                this.setSelectionRange(pos, pos);
            });
        }

        bindRupiahInput('saldoAwalDisplay', 'saldoAwalReal');
        bindRupiahInput('uangFisikDisplay', 'uangFisikReal');

        const shiftDateEl = document.getElementById('shiftDateLabel');
        if (shiftDateEl) {
            shiftDateEl.textContent = new Date().toLocaleDateString('id-ID', {
                timeZone: 'Asia/Jakarta',
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }
    })();
</script>

</body>
</html>
