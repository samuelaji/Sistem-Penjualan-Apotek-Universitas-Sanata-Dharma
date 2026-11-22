<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk & Inventaris - Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg-workspace: #f8fafc;
            --surface: #ffffff;
            --border-soft: #e2e8f0;
            --maroon: #8B0000;
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

        .main-workspace {
            flex: 1;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

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
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .toolbar {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .search-field { position: relative; flex: 1; max-width: 400px; }
        .search-field i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); }
        .search-field input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.4rem;
            border-radius: 10px;
            border: 1px solid var(--border-soft);
            outline: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .search-field input:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.08);
        }

        .table-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.02);
        }
        .table-custom { width: 100%; margin-bottom: 0; }
        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
        }
        .table-custom tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        .table-custom tbody tr:hover { background-color: #fafbfc; }
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
            <a href="{{ route('manajemen.dashboard') }}">Analitik Bisnis</a>
            <a href="{{ route('manajemen.inventaris') }}" class="active">Laporan Inventaris</a>
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
            <h3 class="fw-bold mb-1">Performa Produk & Inventaris</h3>
            <span class="text-muted small">Pantau produk paling banyak terjual beserta ketersediaan nilai stoknya.</span>
        </div>
        <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="btn btn-sm btn-outline-secondary fw-semibold border rounded-3 px-3 py-2 text-decoration-none">
            <i class="bi bi-download me-1"></i> Ekspor CSV
        </a>
    </div>

    <div class="row g-4 mb-4 animate-fade-up" style="animation-delay: 0.1s;">

        <div class="col-lg-7">
            <div class="panel-card">
                <span class="panel-title text-muted">Produk Paling Banyak Terjual (Unit)</span>
                <div style="position: relative; height: 260px; width: 100%;">
                    @if($chartLabels->isEmpty())
                        <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                            <i class="bi bi-bar-chart fs-2 opacity-25 mb-2"></i>
                            <span class="small fw-medium">Belum ada data produk terjual.</span>
                        </div>
                    @else
                        <canvas id="productBarChart"></canvas>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="panel-card">
                <span class="panel-title text-muted">Kontribusi Pendapatan per Produk</span>
                <div style="position: relative; height: 260px; width: 100%; display: flex; justify-content: center;">
                    @if($chartLabels->isEmpty())
                        <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                            <i class="bi bi-pie-chart fs-2 opacity-25 mb-2"></i>
                            <span class="small fw-medium">Belum ada data omzet produk.</span>
                        </div>
                    @else
                        <canvas id="productPieChart"></canvas>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="animate-fade-up" style="animation-delay: 0.2s;">

        <div class="toolbar mb-4">
            <form method="GET" action="{{ route('manajemen.inventaris') }}" class="d-flex align-items-center gap-3 w-100">
                <div class="search-field">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama obat atau SKU..." autocomplete="off">
                </div>

                <div class="d-flex align-items-center gap-2 ms-auto">
                    <span class="text-muted small fw-semibold">Filter:</span>
                    <select name="kategori" class="form-select form-select-sm" style="border-radius: 8px; width: 180px;" onchange="this.form.submit()">
                        <option value="Semua">Semua Kategori</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                    <tr>
                        <th style="width: 12%;">SKU</th>
                        <th style="width: 24%;">Nama Obat</th>
                        <th style="width: 14%;">Kategori</th>
                        <th style="width: 12%; text-align: center;">Total Terjual</th>
                        <th style="width: 12%; text-align: center;">Sisa Stok</th>
                        <th style="width: 13%; text-align: right;">Harga Satuan</th>
                        <th style="width: 13%; text-align: right;">Nilai Aset</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($obatList as $obat)
                        <tr>
                            <td><span class="font-monospace text-muted small fw-bold">{{ $obat->sku }}</span></td>
                            <td class="fw-bold text-dark">{{ $obat->nama_obat }}</td>
                            <td><span class="badge bg-light text-secondary border">{{ $obat->kategori }}</span></td>
                            <td class="text-center">
                                <span class="badge bg-danger-subtle text-danger fw-bold rounded-pill px-2.5 py-1">
                                    {{ $obat->total_terjual ?? 0 }} unit
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="fw-semibold text-dark">{{ $obat->stok }}</span>
                                <small class="text-muted">unit</small>
                            </td>
                            <td class="text-end fw-medium">Rp {{ number_format($obat->harga_obat, 0, ',', '.') }}</td>
                            <td class="text-end fw-bold text-maroon">
                                Rp {{ number_format($obat->stok * $obat->harga_obat, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 opacity-25 d-block mb-2"></i>
                                <span class="small fw-medium">Tidak ada data obat ditemukan.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($obatList->hasPages())
                <div class="p-3 bg-light border-top d-flex justify-content-end">
                    {{ $obatList->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    </div>
</main>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('liveClock').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';
    }
    setInterval(updateClock, 1000);
    updateClock();

    @if($chartLabels->isNotEmpty())
    document.addEventListener("DOMContentLoaded", function() {
        const labels = {!! json_encode($chartLabels) !!};
        const unitValues = {!! json_encode($chartUnitValues) !!};
        const rupiahValues = {!! json_encode($chartRupiahValues) !!};

        const bgColors = [
            '#8B0000', '#dc2626', '#0f172a', '#475569', '#94a3b8', '#cbd5e1'
        ];

        new Chart(document.getElementById('productBarChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Unit Terjual',
                    data: unitValues,
                    backgroundColor: '#8B0000',
                    borderRadius: 6,
                    barThickness: 'flex',
                    maxBarThickness: 45
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 10,
                        bodyFont: { family: 'Plus Jakarta Sans', size: 13, weight: 'bold' },
                        callbacks: {
                            label: function(context) {
                                return (context.raw || 0) + ' unit terjual';
                            }
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans', size: 11 } } },
                    y: {
                        grid: { borderDash: [4, 4], color: '#f1f5f9' },
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: { family: 'Plus Jakarta Sans' },
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('productPieChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: rupiahValues,
                    backgroundColor: bgColors,
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { position: 'right', labels: { usePointStyle: true, font: { family: 'Plus Jakarta Sans', size: 11 } } },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 10,
                        bodyFont: { family: 'Plus Jakarta Sans', size: 13 },
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw || 0);
                            }
                        }
                    }
                }
            }
        });
    });
    @endif
</script>

</body>
</html>
