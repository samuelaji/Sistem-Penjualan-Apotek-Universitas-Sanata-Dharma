<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Apotek USD</title>
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
        .product-img-placeholder { width: 60px; height: 60px; background-color: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; }
    </style>
</head>
<body class="bg-white">

<!-- Header Navigasi Atas untuk Laporan Penjualan -->
    <nav class="navbar navbar-expand-lg bg-maroon navbar-dark py-2">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold fs-6" href="#">Laporan Penjualan</a>
            <div class="d-flex ms-auto gap-4 text-white small">
                <span style="cursor: pointer;">Dasbor</span>
                <a href="{{ url('/penjualan') }}" class="text-white text-decoration-none fw-bold">Penjualan</a>
                <a href="{{ url('/inventaris') }}" class="text-white text-decoration-none">Inventaris</a>
                <a href="{{ url('/login') }}" class="text-white text-decoration-none">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <!--filter laporan-->
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-1">Filter Laporan</h3>
            <p class="text-muted small">Pilih periode waktu dan perbaiki hasilnya.</p>
        </div>

        <div class="card shadow-sm border box-sharp p-4 mb-5">
            <form method="GET" action="">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Periode</label>
                        <select name="periode" class="form-select form-select-sm box-sharp">
                            <option value="">Pilih Periode</option>
                            <option value="harian">Harian</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control form-control-sm box-sharp" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Berakhir</label>
                        <input type="date" name="tanggal_berakhir" class="form-control form-control-sm box-sharp" placeholder="YYYY-MM-DD">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-maroon px-4 me-2 box-sharp">Terapkan</button>
                    <button type="reset" class="btn btn-outline-maroon px-4 me-2 box-sharp">Atur Ulang</button>
                    <button type="button" class="btn btn-outline-maroon px-4 box-sharp">Ekspor CSV</button>
                </div>
            </form>
        </div>

        <!--tren penjualan dan kategori teratas-->
        <div class="text-center mb-3">
            <h3 class="fw-bold">Tren Penjualan</h3>
            <p class="text-muted small">Visualisasikan pergerakan pendapatan untuk jangka waktu yang dipilih.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 h-100">
                    <h6 class="fw-bold mb-1">Tren Pendapatan</h6>
                    <p class="text-muted" style="font-size: 11px;">Pendapatan (Rp)</p>
                    <div style="position: relative; height: 220px; width: 100%;">
                        <canvas id="trenPendapatanChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 h-100">
                    <h6 class="fw-bold mb-1">Kategori Teratas</h6>
                    <p class="text-muted" style="font-size: 11px;">Produk Terjual</p>
                    <div style="position: relative; height: 220px; width: 100%;">
                        <canvas id="kategoriTeratasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!--ringkasan singkat-->
        <div class="text-center mb-3">
            <h3 class="fw-bold">Ringkasan Singkat</h3>
            <p class="text-muted small">Kondisi cepat sebelum meninjau detail transaksi.</p>
        </div>

        <div class="row g-4 text-center mb-5">
            <div class="col-md-3">
                <div class="card shadow-sm border box-sharp p-3 h-100">
                    <span class="text-muted small">Produk Terlaris</span>
                    <span class="text-muted" style="font-size: 10px;">Berdasarkan Jumlah</span>
                    <h5 class="fw-bold mt-2 text-dark">Amoxicillin 500mg</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border box-sharp p-3 h-100">
                    <span class="text-muted small">Rata-rata Nilai Penjualan</span>
                    <span class="text-muted" style="font-size: 10px;">Pendapatan / Transaksi</span>
                    <h5 class="fw-bold mt-2 text-dark">Rp200.000</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border box-sharp p-3 h-100">
                    <span class="text-muted small">Pendorong Diskon Terbaik</span>
                    <span class="text-muted" style="font-size: 10px;">Peningkatan Tertinggi</span>
                    <h5 class="fw-bold mt-2 text-dark">Beli 1, Diskon 50%</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border box-sharp p-3 h-100">
                    <span class="text-muted small">Jam Penjualan Puncak</span>
                    <span class="text-muted" style="font-size: 10px;">Selama periode tersebut</span>
                    <h5 class="fw-bold mt-2 text-dark">11:00 AM – 1:00 PM</h5>
                </div>
            </div>
        </div>

        <!--obat dengan penjualan tertinggi-->
        <div class="text-center mb-4">
            <h3 class="fw-bold">Obat dengan Penjualan Tertinggi</h3>
            <p class="text-muted small">Diurutkan berdasarkan total penjualan periode terpilih. Prioritas pengadaan obat berdasarkan peringkat dan momentum.</p>
        </div>

        <div class="row g-4 text-center">
            <!-- Item 1 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Amoxicillin 500mg</h6>
                        <small class="text-muted">Kapsul</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp1.390.778 - 24.1k unit</p>
                    </div>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Atorvastatin 20mg</h6>
                        <small class="text-muted">Tablet</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp1.097.885 - 18.3k unit</p>
                    </div>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Metformin 500mg</h6>
                        <small class="text-muted">Tablet</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp963.542 - 27.6k unit</p>
                    </div>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Omeprazole 20mg</h6>
                        <small class="text-muted">Kapsul</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp884.444 - 15.9k unit</p>
                    </div>
                </div>
            </div>
            <!-- Item 5 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Azithromycin 250mg</h6>
                        <small class="text-muted">Tablet</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp746.909 - 12.6k unit</p>
                    </div>
                </div>
            </div>
            <!-- Item 6 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Losartan 50mg</h6>
                        <small class="text-muted">Tablet</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp687.053 - 10.7k unit</p>
                    </div>
                </div>
            </div>
            <!-- Item 7 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Ibuprofen 400mg</h6>
                        <small class="text-muted">Tablet</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp608.133 - 21.2k unit</p>
                    </div>
                </div>
            </div>
            <!-- Item 8 -->
            <div class="col-md-6">
                <div class="card shadow-sm border box-sharp p-3 d-flex flex-row align-items-center">
                    <div class="product-img-placeholder">💊</div>
                    <div class="text-start ms-3">
                        <h6 class="fw-bold mb-0">Cetirizine 10mg</h6>
                        <small class="text-muted">Tablet</small>
                        <p class="fw-bold text-dark mb-0 mt-1">Rp525.044 - 19.8k unit</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Script Chart.js untuk Grafik Tren Pendapatan & Kategori Teratas -->
    <script>
        // Grafik Tren Pendapatan (Line Chart dengan Gradient Marun)
        const ctxTren = document.getElementById('trenPendapatanChart').getContext('2d');
        const gradient = ctxTren.createLinearGradient(0, 0, 0, 220);
        gradient.addColorStop(0, 'rgba(153, 0, 0, 0.4)');
        gradient.addColorStop(1, 'rgba(153, 0, 0, 0.0)');

        new Chart(ctxTren, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [1200000, 1900000, 1500000, 2200000, 1800000, 1300000, 2500000],
                    borderColor: 'rgba(153, 0, 0, 1)',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Grafik Kategori Teratas (Bar Chart Warna Marun)
        const ctxKategori = document.getElementById('kategoriTeratasChart').getContext('2d');
        new Chart(ctxKategori, {
            type: 'bar',
            data: {
                labels: ['Kat 1', 'Kat 2', 'Kat 3', 'Kat 4', 'Kat 5', 'Kat 6', 'Kat 7'],
                datasets: [{
                    label: 'Produk Terjual',
                    data: [450, 380, 250, 410, 320, 480, 390],
                    backgroundColor: 'rgba(153, 0, 0, 0.8)',
                    borderColor: 'rgba(153, 0, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>

    <!-- Memuat Bootstrap 5 JS Bundle dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>