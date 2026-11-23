<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analitik Bisnis - Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            overflow: hidden;
            min-width: 0;
        }

        .chart-card {
            flex: 1;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .chart-card-header {
            padding: 0.95rem 1.25rem;
            border-bottom: 1.5px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.85rem;
            background: #ffffff;
        }
        .card-title-main {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-dark);
            display: block;
            line-height: 1.3;
        }
        .chart-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .period-segmented {
            display: inline-flex;
            background: #f1f5f9;
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            padding: 3px;
            gap: 2px;
        }
        .period-btn {
            border: none;
            background: transparent;
            color: var(--text-muted);
            font-size: 0.84rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 7px;
            cursor: pointer;
            transition: all 0.18s ease;
            white-space: nowrap;
        }
        .period-btn:hover { color: var(--text-dark); }
        .period-btn.active {
            background: var(--maroon);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(139, 0, 0, 0.18);
        }

        .chart-canvas-wrap {
            flex: 1;
            position: relative;
            padding: 1.15rem 1.25rem;
            min-height: 0;
        }

        /* ---------- Panel Kanan ---------- */
        .panel-right {
            width: 395px;
            min-width: 395px;
            background: transparent;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            overflow-y: auto;
        }

        .panel-section-card {
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            padding: 1rem 1.2rem;
        }
        .panel-section-card.is-grow {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .section-heading-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 0.72rem;
            margin-bottom: 0.75rem;
            border-bottom: 1.5px solid var(--border-soft);
        }
        .section-heading {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: var(--text-body);
            display: block;
        }
        .section-date {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }

        /* ---------- Ringkasan Metrik (Rata Tengah & Garis Tegas) ---------- */
        .kpi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .kpi-box {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.45rem 0.65rem 0.85rem;
        }
        .kpi-box:nth-child(1) {
            border-right: 1.5px solid var(--border-soft);
            border-bottom: 1.5px solid var(--border-soft);
        }
        .kpi-box:nth-child(2) {
            border-bottom: 1.5px solid var(--border-soft);
        }
        .kpi-box:nth-child(3) {
            grid-column: span 2;
            padding: 0.85rem 0.65rem 0.25rem;
        }
        .kpi-label {
            font-size: 0.76rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.35px;
            color: var(--text-muted);
            display: block;
            margin-bottom: 0.3rem;
        }
        .kpi-value {
            font-size: 1.38rem;
            font-weight: 700;
            line-height: 1.2;
            color: var(--text-dark);
            font-variant-numeric: tabular-nums;
        }

        /* ---------- Daftar Top Produk ---------- */
        .top-product-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .top-product-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-soft);
        }
        .top-product-item:first-child { padding-top: 0.25rem; }
        .top-product-item:last-child {
            border-bottom: none;
            padding-bottom: 0.25rem;
        }

        .rank-number {
            width: 22px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.92rem;
            margin-right: 0.75rem;
            flex-shrink: 0;
            text-align: center;
            font-variant-numeric: tabular-nums;
        }
        .product-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.35;
        }
        .product-category {
            font-size: 0.82rem;
            font-weight: 400;
            color: var(--text-muted);
            text-transform: capitalize;
        }
        .product-qty {
            font-size: 0.94rem;
            font-weight: 600;
            color: var(--text-dark);
            font-variant-numeric: tabular-nums;
        }
        .product-qty-unit {
            font-size: 0.82rem;
            font-weight: 400;
            color: var(--text-muted);
        }
        .product-revenue {
            font-size: 0.84rem;
            font-weight: 500;
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-4">
        <div class="user-identity">
            <span class="user-name">{{ Auth::user()->nama_pengguna ?? 'Manajemen' }}</span>
            <span class="user-id">{{ Auth::user()->username ?? 'manajemen' }}</span>
        </div>

        <nav class="nav-segmented ms-2 d-none d-md-flex">
            <a href="{{ route('manajemen.dashboard') }}" class="active">Analitik Bisnis</a>
            <a href="{{ route('manajemen.inventaris') }}">Inventaris</a>
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
        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <span class="card-title-main" id="chartTitleMain">Tren Penjualan</span>
                </div>

                <div class="chart-controls">
                    <div class="period-segmented" role="group" aria-label="Rentang waktu tren penjualan">
                        <button type="button" class="period-btn" data-period="day">Hari Ini</button>
                        <button type="button" class="period-btn active" data-period="7d">7 Hari</button>
                        <button type="button" class="period-btn" data-period="1m">1 Bulan</button>
                        <button type="button" class="period-btn" data-period="1y">1 Tahun</button>
                    </div>
                </div>
            </div>

            <div class="chart-canvas-wrap">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </section>

    <aside class="panel-right">

        <div class="panel-section-card">
            <div class="section-heading-row">
                <span class="section-heading">Ringkasan Hari Ini</span>
                <span class="section-date">{{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}</span>
            </div>

            <div class="kpi-grid">
                <div class="kpi-box">
                    <span class="kpi-label">Omset Hari Ini</span>
                    <div class="kpi-value">Rp {{ number_format($omsetHariIni, 0, ',', '.') }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Transaksi Selesai</span>
                    <div class="kpi-value">{{ number_format($transaksiHariIni, 0, ',', '.') }}</div>
                </div>

                <div class="kpi-box">
                    <span class="kpi-label">Estimasi Nilai Aset Obat</span>
                    <div class="kpi-value">Rp {{ number_format($nilaiAset ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <div class="panel-section-card is-grow">
            <div class="section-heading-row">
                <span class="section-heading">Top 5 Produk Terlaris</span>
            </div>

            <ul class="top-product-list">
                @forelse($produkTerlaris as $index => $item)
                    <li class="top-product-item">
                        <span class="rank-number">{{ $index + 1 }}</span>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="product-title text-truncate">{{ $item->nama_obat }}</div>
                            <span class="product-category">{{ $item->kategori }}</span>
                        </div>
                        <div class="text-end ms-2">
                            <div class="product-qty">{{ $item->total_terjual }} <span class="product-qty-unit">unit</span></div>
                            <div class="product-revenue">Rp {{ number_format($item->total_rupiah, 0, ',', '.') }}</div>
                        </div>
                    </li>
                @empty
                    <div class="py-5 text-center text-muted">
                        <i class="bi bi-inbox fs-2 d-block opacity-25 mb-2"></i>
                        <span class="fw-medium" style="font-size: 0.92rem;">Belum ada data penjualan.</span>
                    </div>
                @endforelse
            </ul>
        </div>

    </aside>

</main>

<script>
    (function () {
        'use strict';

        const clockEl = document.getElementById('headerLiveClock');
        function updateClock() {
            clockEl.textContent = new Date().toLocaleTimeString('en-GB', {
                timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', hour12: false
            }) + ' WIB';
        }
        updateClock();
        setInterval(updateClock, 1000);

        const rawLabels = @json($grafikTanggal);
        const rawValues = @json($grafikOmset);
        const sevenDayLabels = Array.isArray(rawLabels) ? [...rawLabels].reverse() : [];
        const sevenDayValues = Array.isArray(rawValues) ? [...rawValues].reverse().map(Number) : [];

        const omsetToday = Number(@json($omsetHariIni ?? 0));

        const serverDailyLabels = @json($grafikHarianLabel ?? null);
        const serverDailyValues = @json($grafikHarianOmset ?? null);
        const serverMonthlyLabels = @json($grafikBulananLabel ?? null);
        const serverMonthlyValues = @json($grafikBulananOmset ?? null);
        const serverYearlyLabels = @json($grafikTahunanLabel ?? null);
        const serverYearlyValues = @json($grafikTahunanOmset ?? null);

        const weekSum = sevenDayValues.reduce((acc, v) => acc + v, 0);

        const seriesMap = {
            day: {
                title: 'Tren Penjualan',
                labels: Array.isArray(serverDailyLabels) ? serverDailyLabels : ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', 'Sekarang'],
                values: Array.isArray(serverDailyValues)
                    ? serverDailyValues.map(Number)
                    : [0, 0, 0, 0, 0, 0, 0, omsetToday]
            },
            '7d': {
                title: 'Tren Penjualan',
                labels: sevenDayLabels,
                values: sevenDayValues
            },
            '1m': {
                title: 'Tren Penjualan',
                labels: Array.isArray(serverMonthlyLabels) ? serverMonthlyLabels : ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                values: Array.isArray(serverMonthlyValues)
                    ? serverMonthlyValues.map(Number)
                    : [0, 0, 0, weekSum]
            },
            '1y': {
                title: 'Tren Penjualan',
                labels: Array.isArray(serverYearlyLabels)
                    ? serverYearlyLabels
                    : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                values: Array.isArray(serverYearlyValues)
                    ? serverYearlyValues.map(Number)
                    : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, weekSum, 0]
            }
        };

        const ctx = document.getElementById('revenueChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 380);
        gradient.addColorStop(0, 'rgba(139, 0, 0, 0.18)');
        gradient.addColorStop(1, 'rgba(139, 0, 0, 0.0)');

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: seriesMap['7d'].labels,
                datasets: [{
                    label: 'Omset Penjualan (Rp)',
                    data: seriesMap['7d'].values,
                    borderColor: '#8B0000',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#8B0000',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.35
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        titleFont: { family: 'Plus Jakarta Sans', size: 13, weight: '600' },
                        bodyFont: { family: 'Plus Jakarta Sans', size: 14, weight: '700' },
                        callbacks: {
                            label: function (context) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 12, weight: '500' },
                            color: '#64748b'
                        }
                    },
                    y: {
                        grid: { color: '#e2e8f0' },
                        beginAtZero: true,
                        ticks: {
                            font: { family: 'Plus Jakarta Sans', size: 12, weight: '500' },
                            color: '#64748b',
                            callback: function (value) {
                                if (value >= 1000000) return 'Rp ' + (value / 1000000) + 'M';
                                if (value >= 1000) return 'Rp ' + (value / 1000) + 'K';
                                return 'Rp ' + value;
                            }
                        }
                    }
                }
            }
        });

        const titleMainEl = document.getElementById('chartTitleMain');
        const periodButtons = document.querySelectorAll('.period-btn');

        periodButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const period = this.dataset.period;
                const target = seriesMap[period] || seriesMap['7d'];

                periodButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                titleMainEl.textContent = target.title;

                chart.data.labels = target.labels;
                chart.data.datasets[0].data = target.values;
                chart.update();
            });
        });
    })();
</script>

</body>
</html>
