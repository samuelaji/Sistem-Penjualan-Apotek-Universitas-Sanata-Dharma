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
            --border-strong: #cbd5e1;
            --maroon: #8B0000;
            --maroon-dark: #6e0000;
            --text-dark: #0f172a;
            --text-muted: #64748b;
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
        }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }

        @keyframes pageEntrance {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes progressGrow {
            from { width: 0%; }
        }

        .pos-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0.65rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 20;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-avatar {
            width: 36px;
            height: 36px;
            background: rgba(139, 0, 0, 0.08);
            color: var(--maroon);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: transform 0.2s ease;
        }
        .user-avatar:hover {
            transform: scale(1.05);
        }

        .nav-segmented {
            display: flex;
            background: #e2e8f0;
            border-radius: 10px;
            padding: 3px;
            gap: 3px;
        }
        .nav-segmented a {
            text-decoration: none;
            padding: 6px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 8px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-segmented a:hover {
            color: var(--text-dark);
        }
        .nav-segmented a:active {
            transform: scale(0.96);
        }
        .nav-segmented a.active {
            background: var(--maroon);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(139, 0, 0, 0.2);
        }

        .pos-container {
            flex: 1;
            display: flex;
            overflow: hidden;
            padding: 1rem;
            gap: 1rem;
            animation: pageEntrance 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .workspace-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            overflow: hidden;
        }

        .table-card {
            flex: 1;
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .table-card-header {
            padding: 1.1rem 1.4rem;
            border-bottom: 1.5px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
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
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.85rem 1.4rem;
            border-bottom: 1px solid var(--border-soft);
            position: sticky;
            top: 0;
            z-index: 5;
        }
        .table-custom tbody td {
            padding: 0.95rem 1.4rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
            transition: background-color 0.15s ease;
        }
        .table-custom tbody tr:hover td {
            background-color: #f8fafc;
        }

        .empty-center-cell {
            height: calc(100vh - 240px);
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
            margin-bottom: 0.85rem;
            transition: all 0.25s ease;
        }
        .empty-icon-box:hover {
            transform: scale(1.08);
            background: #e2e8f0;
            color: var(--maroon);
        }

        .panel-right {
            width: 380px;
            min-width: 380px;
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .panel-section-distinct {
            padding: 1.2rem 1.3rem;
            border-bottom: 2px solid #eef2f6;
            position: relative;
        }
        .panel-section-distinct:last-child {
            border-bottom: none;
        }

        .section-header-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.85rem;
        }
        .section-heading {
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: #334155;
            margin: 0;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .kpi-box {
            background: #f8fafc;
            border: 1.5px solid var(--border-soft);
            border-radius: 12px;
            padding: 0.85rem;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .kpi-box:hover {
            border-color: #cbd5e1;
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        }
        .kpi-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            display: block;
            margin-bottom: 0.25rem;
        }
        .kpi-value {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.5px;
        }

        .btn-maroon-sm {
            background: var(--maroon);
            color: #ffffff;
            border: none;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .btn-maroon-sm:hover {
            background: var(--maroon-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(139, 0, 0, 0.25);
        }
        .btn-maroon-sm:active {
            transform: scale(0.97);
        }

        .btn-outline-sm {
            background: transparent;
            color: #dc2626;
            border: 1px solid var(--border-soft);
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .btn-outline-sm:hover {
            background: #fef2f2;
            border-color: #fecaca;
            transform: translateY(-1px);
        }
        .btn-outline-sm:active {
            transform: scale(0.97);
        }

        .stock-progress-wrap {
            width: 85px;
            height: 6px;
            background: #fee2e2;
            border-radius: 99px;
            overflow: hidden;
            margin-top: 5px;
        }
        .stock-progress-fill {
            height: 100%;
            background: #ef4444;
            border-radius: 99px;
            animation: progressGrow 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-3">
        <div class="user-info">
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="fw-bold text-dark fs-6">{{ Auth::user()->nama_pengguna ?? 'Apoteker' }}</div>
        </div>

        <nav class="nav-segmented ms-2">
            <a href="{{ route('apoteker.dashboard') }}" class="active">Dashboard Validasi</a>
            <a href="#" onclick="alert('Katalog Obat segera dihubungkan!')">Katalog Obat</a>
        </nav>
    </div>

    <div class="d-flex align-items-center gap-2">
        <span class="text-muted small me-2" id="headerLiveClock">--:--:--</span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Keluar">
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
                    <span class="fw-bold text-dark fs-6">Antrean Validasi Resep Dokter</span>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Resep aktif dari kasir yang memerlukan verifikasi legalitas farmasi</small>
                </div>
                @if($totalPending > 0)
                    <span class="badge bg-danger rounded-pill px-2.5 py-1 fw-bold" style="font-size: 0.72rem;">
                        {{ $totalPending }} Resep Menunggu
                    </span>
                @else
                    <span class="badge bg-light text-muted border fw-normal" style="font-size: 0.72rem;">
                        Semua Terverifikasi
                    </span>
                @endif
            </div>

            <div class="table-wrapper">
                <table class="table-custom">
                    <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">No. Resep / Tgl</th>
                        <th style="width: 25%;">Dokter & Faskes</th>
                        <th style="width: 32%;">Item Obat Diresepkan</th>
                        <th style="width: 13%;">Total Tagihan</th>
                        <th style="width: 10%; text-align: center;">Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pendingResep as $index => $trx)
                        <tr>
                            <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                            <td>
                                <span class="fw-bold text-dark font-monospace d-block">
                                    {{ $trx->resep->nama_dokter && $trx->resep->nama_dokter != 'Tidak Diketahui' ? 'RSP-00'.$trx->id_resep : 'RSP-AUTO-'.$trx->id_transaksi }}
                                </span>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ date('d M Y, H:i', strtotime($trx->tanggal_transaksi)) }}</small>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $trx->resep->nama_dokter ?? 'Dokter' }}</div>
                                <small class="text-muted">{{ $trx->resep->nama_klinik ?? 'Fasilitas Kesehatan' }}</small>
                            </td>
                            <td>
                                @foreach($trx->detail_transaksi as $detail)
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-semibold small text-dark">• {{ $detail->obat->nama_obat ?? 'Obat' }}</span>
                                        <span class="badge bg-light text-secondary border" style="font-size: 0.7rem;">{{ $detail->jumlah_beli }} {{ $detail->obat->jenis_obat ?? 'Unit' }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td class="fw-bold text-maroon">
                                Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <form action="{{ route('apoteker.resep.approve', $trx->id_transaksi) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn-maroon-sm">Setujui</button>
                                    </form>

                                    <form action="{{ route('apoteker.resep.reject', $trx->id_transaksi) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn-outline-sm" onclick="return confirm('Tolak resep ini?')">Tolak</button>
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
                                <h6 class="fw-bold text-dark mb-1">Tidak Ada Antrean Resep</h6>
                                <p class="text-muted small mb-0">Resep baru dari kasir akan otomatis masuk ke tabel ini.</p>
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
            <div class="section-header-wrap">
                <span class="section-heading">Ringkasan Farmasi</span>
                <span class="badge bg-light text-muted border fw-normal" style="font-size: 0.65rem;">Status Hari Ini</span>
            </div>
            <div class="kpi-grid">

                <div class="kpi-box">
                    <span class="kpi-label">Antrean Resep</span>
                    <div class="kpi-value {{ $totalPending > 0 ? 'text-danger' : 'text-dark' }}">{{ $totalPending }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Stok Menipis</span>
                    <div class="kpi-value {{ $totalKritis > 0 ? 'text-warning' : 'text-dark' }}">{{ $totalKritis }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Hampir Expired</span>
                    <div class="kpi-value text-dark">{{ $totalExpiredAlert }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Katalog Obat</span>
                    <div class="kpi-value text-dark">{{ $totalObat }}</div>
                </div>

            </div>
        </div>

        <div class="panel-section-distinct">
            <div class="section-header-wrap">
                <span class="section-heading">Stok Menipis</span>
                <span class="badge bg-danger-subtle text-danger rounded-pill px-2" style="font-size: 0.65rem;">Perlu Restock</span>
            </div>

            <div class="table-responsive" style="max-height: 180px; overflow-y: auto;">
                <table class="table table-sm table-borderless align-middle mb-0" style="font-size: 0.8rem;">
                    <tbody>
                    @forelse($stokKritis as $obat)
                        <tr class="border-bottom border-light">
                            <td class="ps-0 py-2">
                                <div class="fw-bold text-dark text-truncate" style="max-width: 140px;">{{ $obat->nama_obat }}</div>
                                <small class="text-muted font-monospace" style="font-size: 0.68rem;">{{ $obat->sku }}</small>
                            </td>
                            <td class="text-end pe-0 py-2">
                                <div class="fw-bold text-danger">Sisa {{ $obat->stok }} <span class="text-muted fw-normal" style="font-size: 0.7rem;"></span></div>
                                <div class="stock-progress-wrap ms-auto">
                                    @php
                                        $percentage = $obat->batas_minimum > 0 ? min(100, ($obat->stok / $obat->batas_minimum) * 100) : 0;
                                    @endphp
                                    <div class="stock-progress-fill" style="width: {{ $percentage }}%;"></div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-3 text-muted small">Semua stok obat aman.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel-section-distinct flex-grow-1">
            <div class="section-header-wrap">
                <span class="section-heading">Peringatan Kedaluwarsa</span>
            </div>

            <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                <table class="table table-sm table-borderless align-middle mb-0" style="font-size: 0.8rem;">
                    <tbody>
                    @forelse($mendekatiExpired as $obat)
                        <tr class="border-bottom border-light">
                            <td class="ps-0 py-2">
                                <div class="fw-bold text-dark text-truncate" style="max-width: 140px;">{{ $obat->nama_obat }}</div>
                                <small class="text-muted" style="font-size: 0.7rem;">{{ date('d M Y', strtotime($obat->tanggal_kadaluwarsa)) }}</small>
                            </td>
                            <td class="text-end pe-0 py-2">
                                @php
                                    $diffInDays = (int) now()->diffInDays($obat->tanggal_kadaluwarsa, false);
                                    $diffInMonths = (int) round($diffInDays / 30);
                                @endphp
                                @if($diffInDays <= 0)
                                    <span class="badge bg-danger text-white rounded-pill px-2" style="font-size: 0.68rem;">Expired</span>
                                @elseif($diffInMonths <= 6)Bln
                                    <span class="badge bg-danger-subtle text-danger rounded-pill fw-bold px-2" style="font-size: 0.68rem;">{{ $diffInMonths }} Bulan lagi</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill fw-bold px-2" style="font-size: 0.68rem;">{{ $diffInMonths }} Bulan lagi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-3 text-muted small">Tidak ada obat mendekati expired.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </aside>

</main>

<script>
    function updateHeaderClock() {
        const now = new Date();
        document.getElementById('headerLiveClock').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
    }
    setInterval(updateHeaderClock, 1000);
    updateHeaderClock();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
