<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris - Apotek</title>
    <!-- Memuat Bootstrap 5 CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js CDN untuk Grafik Dinamis -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .bg-maroon { background-color: #990000; }
        .text-maroon { color: #990000; }
        .btn-maroon { background-color: #990000; color: white; border: none; border-radius: 0; }
        .btn-maroon:hover { background-color: #7a0000; color: white; }
        .btn-outline-maroon { border-color: #990000; color: #990000; background-color: transparent; border-radius: 0; }
        .btn-outline-maroon:hover { background-color: #f8d7d7; color: #990000; border-color: #990000; }
        .box-sharp { border-radius: 0 !important; }
    </style>
</head>
<body class="bg-white">

    <?php
        // Mengambil data langsung dari model di dalam view sesuai rute sederhana
        use App\Models\Obat;
        
        $listObat = Obat::all();
        $chartData = Obat::select('kategori', \DB::raw('SUM(stok) as total_stok'))
                        ->groupBy('kategori')
                        ->get();

        $categories = $chartData->pluck('kategori');
        $totals = $chartData->pluck('total_stok');
    ?>

 <!-- Header Navigasi Atas dengan Tema Marun Manajer -->
    <nav class="navbar navbar-expand-lg bg-maroon navbar-dark py-1">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold fs-6" href="#">Laporan Inventaris</a>
            <div class="d-flex ms-auto gap-3 text-white small" style="font-size: 0.75rem;">
                <span style="cursor: pointer;">Dasbor</span>
                <a href="{{ url('/penjualan') }}" class="text-white text-decoration-none">Penjualan</a>
                <a href="{{ url('/inventaris') }}" class="text-white text-decoration-none fw-bold">Inventaris</a>
                <a href="{{ url('/login') }}" class="text-white text-decoration-none">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <!--banner informasi utama-->
        <div class="card shadow-sm border box-sharp mb-4 p-4 text-center">
            <div class="card-body">
                <h3 class="card-title fw-bold mb-2">Laporan Pengelolaan Inventaris</h3>
                <p class="text-muted small mb-4">Pantau nilai stok, kategori obat, dan pergerakan barang secara sekilas.</p>
                <div>
                    <button class="btn btn-outline-maroon me-2 px-4 box-sharp">Ekspor CSV</button>
                    <button class="btn btn-maroon px-4 box-sharp">Lihat Detail</button>
                </div>
            </div>
        </div>

        <!--grafik dinamis-->
        <div class="mb-4">
            <h4 class="text-center fw-bold mb-3">Rincian Penilaian Stok Berdasarkan Database</h4>
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="card shadow-sm border box-sharp p-3 h-100">
                        <p class="small text-muted mb-2 fw-semibold">Grafik Total Stok per Kategori Obat</p>
                        <div style="position: relative; height: 250px; width: 100%;">
                            <canvas id="inventarisChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--tabel data inventaris-->
        <div class="card shadow-sm border box-sharp mb-4 p-3">
            <div class="card-body">
                <h4 class="card-title fw-bold mb-3">Tabel Data Inventaris (Dinamis dari Database)</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($listObat as $obat)
                                <tr>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->kategori }}</td>
                                    <td>{{ $obat->stok }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada data inventaris di database.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--tabel opsi mutasi stok-->
        <div class="card shadow-sm border box-sharp p-4">
            <h4 class="text-center fw-bold mb-1">Opsi Tabel Mutasi Stok</h4>
            <p class="text-center text-muted small mb-4">Pilih data yang akan ditampilkan pada tabel mendetail di bawah ini.</p>
            
            <form method="GET" action="">
                <div class="row g-3 mb-4">
                    
                    <!-- Pilihan Filter: Kategori Obat -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Kategori Obat</label>
                        <select name="kategori" class="form-select form-select-sm box-sharp">
                            <option value="">Semua Kategori</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Filter tabel berdasarkan kategori</div>
                    </div>

                    <!-- Pilihan Filter: Jenis Mutasi Stok -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Jenis Mutasi Stok</label>
                        <select name="jenis_mutasi" class="form-select form-select-sm box-sharp">
                            <option value="">Semua</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Penerimaan, Pengeluaran, Transfer, Penyesuaian</div>
                    </div>

                    <!-- Pilihan Filter: Mode Tampilan -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Mode Tampilan</label>
                        <select name="mode_tampilan" class="form-select form-select-sm box-sharp">
                            <option value="">Penilaian Saat Ini</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Beralih antara Saat Ini / Rerata Bulanan</div>
                    </div>

                    <!-- Pilihan Filter: Urutkan Berdasarkan -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Urutkan Berdasarkan</label>
                        <select name="urutkan" class="form-select form-select-sm box-sharp">
                            <option value="">Nilai Tertinggi</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Penilaian, Nama, atau Tanggal Mutasi Terakhir</div>
                    </div>

                </div>

                <!-- Tombol Aksi Form Atur Ulang & Perbarui Tabel -->
                <div class="text-center border-top pt-3">
                    <button type="reset" class="btn btn-outline-maroon px-4 me-2 box-sharp">Atur Ulang</button>
                    <button type="submit" class="btn btn-maroon px-4 box-sharp">Perbarui Tabel</button>
                </div>
            </form>
        </div>

    </div>

    <!-- Script Chart.js dengan warna batang grafik -->
    <script>
        const ctx = document.getElementById('inventarisChart').getContext('2d');
        const inventarisChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categories) !!},
                datasets: [{
                    label: 'Total Stok',
                    data: {!! json_encode($totals) !!},
                    backgroundColor: 'rgba(153, 0, 0, 0.75)',
                    borderColor: 'rgba(153, 0, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- Memuat Bootstrap 5 JS Bundle dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>