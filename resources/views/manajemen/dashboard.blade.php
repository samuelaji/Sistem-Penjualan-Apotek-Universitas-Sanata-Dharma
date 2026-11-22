<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analitik Bisnis - Apotek USD</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg-workspace: #f8fafc;
            --surface: #ffffff;
            --border-soft: #e2e8f0;
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
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        /* --- TOPBAR --- */
        .pos-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .user-info { display: flex; align-items: center; gap: 12px; }
        .user-avatar {
            width: 38px;
            height: 38px;
            background: rgba(139, 0, 0, 0.08);
            color: var(--maroon);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .nav-segmented {
            display: flex;
            background: #f1f5f9;
            border-radius: 10px;
            padding: 4px;
            gap: 2px;
        }
        .nav-segmented a {
            text-decoration: none;
            padding: 6px 16px;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-segmented a:hover { color: var(--text-dark); }
        .nav-segmented a.active {
            background: var(--surface);
            color: var(--maroon);
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        /* --- WORKSPACE --- */
        .main-workspace {
            flex: 1;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* --- KPI CARDS --- */
        .kpi-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
            box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.02);
            transition: transform 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        .kpi-card:hover {
            transform: translateY(-3px);
            border-color: #cbd5e1;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05);
        }
        .kpi-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .kpi-value {
            font-size: 2.25rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
            color: var(--text-dark);
        }

        /* Aksen Gradasi Card */
        .kpi-card.maroon-accent::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 4px;
            background: linear-gradient(90deg, var(--maroon), #ef4444);
        }
        .kpi-card.blue-accent::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 4px;
            background: linear-gradient(90deg, #0ea5e9, #3b82f6);
        }
        .kpi-card.green-accent::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 4px;
            background: linear-gradient(90deg, #10b981, #22c55e);
        }

        /* --- CHART & TABLE SECTION --- */
        .panel-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.02);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .panel-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Tabel Top Produk */
        .top-product-list {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }
        .top-product-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px dashed var(--border-soft);
        }
        .top-product-item:last-child { border-bottom: none; }

        .rank-badge {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.8rem;
            margin-right: 1rem;
        }
        .rank-1 { background: #fef08a; color: #854d0e; } /* Gold */
        .rank-2 { background: #e2e8f0; color: #475569; } /* Silver */
        .rank-3 { background: #ffedd5; color: #9a3412; } /* Bronze */
        .rank-other { background: #f1f5f9; color: var(--text-muted); }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-4">
        <div class="user-info">
            <div class="user-avatar"><i class="bi bi-person-fill"></i></div>
            <div>
                <div class="fw-bold text-dark fs-6" style="line-height: 1.2;">{{ Auth::user()->nama_pengguna ?? 'Manajemen' }}</div>
                <small class="text-muted" style="font-size: 0.75rem;">Kepala Apotek</small>
            </div>
        </div>

        <nav class="nav-segmented ms-3 d-none d-md-flex">
            <a href="{{ route('manajemen.dashboard') }}" class="active">Analitik Bisnis</a>
            <a href="{{ route('manajemen.inventaris') }}">Laporan Inventaris</a>
        </nav>
    </div>

    <div class="d-flex align-items-center gap-3">
        <span class="text-muted small fw-semibold font-monospace" id="liveClock">--:--:--</span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Keluar">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </button>
        </form>
    </div>
</header>

<main class="main-workspace">

    <div class="d-flex justify-content-between align-items-end mb-4 animate-fade-up">
        <div>
            <h3 class="fw-bold mb-1">Tinjauan Eksekutif</h3>
            <span class="text-muted small">Performa finansial dan operasional Apotek hari ini.</span>
        </div>
        <div class="badge bg-white text-dark border px-3 py-2 fw-semibold">
            <i class="bi bi-calendar3 me-2 text-muted"></i>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- ROW 1: 3 KPI UTAMA -->
    <div class="row g-4 mb-4 animate-fade-up" style="animation-delay: 0.1s;">

        <!-- Pendapatan Hari Ini -->
        <div class="col-lg-4">
            <div class="kpi-card maroon-accent">
                <div class="kpi-label">
                    <span>Omset Hari Ini</span>
                    <i class="bi bi-wallet2 fs-6"></i>
                </div>
                <div class="kpi-value">
                    <span class="fs-4 text-muted fw-normal">Rp</span> {{ number_format($omsetHariIni, 0, ',', '.') }}
                </div>
                <div class="mt-2 text-success small fw-semibold">
                    <i class="bi bi-arrow-up-right me-1"></i> Real-time sync
                </div>
            </div>
        </div>

        <!-- Transaksi Sukses -->
        <div class="col-lg-4">
            <div class="kpi-card blue-accent">
                <div class="kpi-label">
                    <span>Transaksi Selesai (Nota)</span>
                    <i class="bi bi-receipt fs-6"></i>
                </div>
                <div class="kpi-value">
                    {{ number_format($transaksiHariIni, 0, ',', '.') }}
                </div>
                <div class="mt-2 text-muted small fw-medium">
                    Transaksi valid dari kasir
                </div>
            </div>
        </div>

        <!-- Nilai Aset Gudang -->
        <div class="col-lg-4">
            <div class="kpi-card green-accent">
                <div class="kpi-label">
                    <span>Estimasi Nilai Aset Obat</span>
                    <i class="bi bi-boxes fs-6"></i>
                </div>
                <div class="kpi-value">
                    <span class="fs-4 text-muted fw-normal">Rp</span> {{ number_format($nilaiAset ?? 0, 0, ',', '.') }}
                </div>
                <div class="mt-2 text-muted small fw-medium">
                    Total kalkulasi stok x harga saat ini
                </div>
            </div>
        </div>

    </div>

    <!-- ROW 2: GRAFIK & TOP PRODUK -->
    <div class="row g-4 animate-fade-up" style="animation-delay: 0.2s;">

        <!-- Grafik Penjualan (7 Hari) -->
        <div class="col-lg-8">
            <div class="panel-card">
                <div class="panel-title">
                    <span>Tren Penjualan (7 Hari Terakhir)</span>
                    <button class="btn btn-sm btn-light border fw-semibold text-muted" style="font-size: 0.75rem;">
                        <i class="bi bi-download me-1"></i> Ekspor
                    </button>
                </div>
                <div style="position: relative; height: 320px; width: 100%;">
                    <!-- Canvas untuk Chart.js -->
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top 5 Produk Terlaris -->
        <div class="col-lg-4">
            <div class="panel-card">
                <div class="panel-title mb-2">
                    <span>Top 5 Produk Terlaris</span>
                    <i class="bi bi-trophy text-warning"></i>
                </div>

                <ul class="top-product-list">
                    @forelse($produkTerlaris as $index => $item)
                        <li class="top-product-item">
                            <div class="rank-badge {{ $index == 0 ? 'rank-1' : ($index == 1 ? 'rank-2' : ($index == 2 ? 'rank-3' : 'rank-other')) }}">
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h6 class="fw-bold text-dark mb-0 text-truncate" style="font-size: 0.9rem;">{{ $item->nama_obat }}</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">{{ $item->kategori }}</small>
                            </div>
                            <div class="text-end ms-2">
                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $item->total_terjual }} <span class="fw-normal text-muted" style="font-size: 0.7rem;">unit</span></div>
                                <small class="text-success fw-semibold" style="font-size: 0.75rem;">Rp {{ number_format($item->total_rupiah, 0, ',', '.') }}</small>
                            </div>
                        </li>
                    @empty
                        <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                            <i class="bi bi-inbox fs-2 opacity-25 mb-2"></i>
                            <span class="small fw-medium">Belum ada data penjualan.</span>
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

</main>

<!-- JAVASCRIPT: Jam & Chart.js -->
<script>
    // 1. Live Clock
    function updateClock() {
        const now = new Date();
        document.getElementById('liveClock').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';
    }
    setInterval(updateClock, 1000);
    updateClock();

    // 2. Inisialisasi Chart.js (Grafik Omzet)
    document.addEventListener("DOMContentLoaded", function() {
        const labels = @json($grafikTanggal);
        const dataValues = @json($grafikOmset);

        // Jangan lupa membalik array karena query kita dari tanggal sekarang mundur ke belakang,
        // sedangkan grafik biasanya dibaca dari kiri (masa lalu) ke kanan (hari ini).
        labels.reverse();
        dataValues.reverse();

        const ctx = document.getElementById('revenueChart').getContext('2d');

        // Membuat efek Gradient Fill di bawah garis grafik
        let gradient = ctx.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, 'rgba(139, 0, 0, 0.2)');   // Marun transparan di atas
        gradient.addColorStop(1, 'rgba(139, 0, 0, 0.0)');   // Memudar menghilang di bawah

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Omset Penjualan (Rp)',
                    data: dataValues,
                    borderColor: '#8B0000', // Marun Solid untuk Garis
                    backgroundColor: gradient, // Efek Gradasi untuk area bawah garis
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#8B0000',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true, // Mengaktifkan efek warna blok di bawah garis
                    tension: 0.4 // Membuat garis melengkung halus (bezier curve)
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
                        titleFont: { family: 'Plus Jakarta Sans', size: 13 },
                        bodyFont: { family: 'Plus Jakarta Sans', size: 14, weight: 'bold' },
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans' }, color: '#64748b' }
                    },
                    y: {
                        grid: { borderDash: [4, 4], color: '#e2e8f0' },
                        beginAtZero: true,
                        ticks: {
                            font: { family: 'Plus Jakarta Sans' },
                            color: '#64748b',
                            callback: function(value) {
                                // Format angka ribuan jadi K, jutaan jadi M (contoh: 50.000 -> 50K)
                                if(value >= 1000000) return 'Rp ' + (value/1000000) + 'M';
                                if(value >= 1000) return 'Rp ' + (value/1000) + 'K';
                                return 'Rp ' + value;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

</body>
</html>
