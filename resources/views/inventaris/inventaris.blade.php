<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris</title>
    <!-- Memuat Bootstrap 5 CSS dari CDN agar komponen tampilan langsung rapi secara instan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    <!-- Container utama untuk membungkus seluruh konten agar berada di tengah dengan margin yang pas -->
    <div class="container py-4">

        <!-- ================= BAGIAN HEADER / NAVIGASI ATAS ================= -->
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <!-- Judul halaman -->
            <h1 class="h3 fw-bold">Laporan Inventaris</h1>
            <!-- Menu navigasi antar modul -->
            <div>
                <a href="#" class="text-decoration-none text-secondary me-3">Dasbor</a>
                <a href="#" class="text-decoration-none text-secondary me-3">Penjualan</a>
                <a href="#" class="text-decoration-none text-danger fw-bold">Inventaris</a>
            </div>
        </div>

        <!-- ================= BANNER INFORMASI UTAMA ================= -->
        <div class="card shadow-sm border-0 mb-4 p-4 text-center">
            <div class="card-body">
                <!-- Judul sub-bagian -->
                <h3 class="card-title fw-bold mb-2">Laporan Pengelolaan Inventaris</h3>
                <!-- Deskripsi singkat fungsi halaman -->
                <p class="text-muted small mb-4">Pantau nilai stok, kategori obat, dan pergerakan barang secara sekilas.</p>
                <!-- Tombol aksi utama (Ekspor dan Lihat Detail) -->
                <div>
                    <button class="btn btn-outline-danger me-2 px-4">Ekspor CSV</button>
                    <button class="btn btn-danger px-4">Lihat Detail</button>
                </div>
            </div>
        </div>

        <!-- ================= BAGIAN GRAFIK / RINCIAN PENILAIAN STOK ================= -->
        <div class="mb-4">
            <h4 class="text-center fw-bold mb-3">Rincian Penilaian Stok</h4>
            <div class="row g-3">
                
                <!-- Kotak Grafik 1: Nilai Berdasarkan Kategori (Placeholder Pie Chart) -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 p-3 h-100 text-center">
                        <p class="small text-muted text-start mb-2 fw-semibold">Nilai Berdasarkan Kategori</p>
                        <!-- Elemen visual bulat sebagai tiruan grafik -->
                        <div class="mx-auto rounded-circle bg-secondary bg-opacity-25 my-auto" style="width: 80px; height: 80px;"></div>
                    </div>
                </div>

                <!-- Kotak Grafik 2: Kategori Teratas (Placeholder Bar Chart) -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 p-3 h-100">
                        <p class="small text-muted mb-2 fw-semibold">Kategori Teratas Berdasarkan Nilai</p>
                        <!-- Elemen visual batang vertikal tiruan grafik -->
                        <div class="d-flex align-items-end justify-content-around bg-light rounded p-2" style="height: 100px;">
                            <div class="bg-success rounded-top" style="width: 15px; height: 60px;"></div>
                            <div class="bg-danger rounded-top" style="width: 15px; height: 90px;"></div>
                            <div class="bg-warning rounded-top" style="width: 15px; height: 40px;"></div>
                            <div class="bg-success rounded-top" style="width: 15px; height: 75px;"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= TABEL DATA CONTOH (MOCK DATA) ================= -->
        <div class="card shadow-sm border-0 mb-4 p-3">
            <div class="card-body">
                <h4 class="card-title fw-bold mb-3">Tabel Data Inventaris (Pratinjau Tampilan)</h4>
                <!-- Wrapper responsif agar tabel aman dibuka di layar kecil -->
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
                            <!-- Baris data contoh 1 -->
                            <tr>
                                <td>Paracetamol 500mg</td>
                                <td>Analgesik</td>
                                <td>150 Strip</td>
                            </tr>
                            <!-- Baris data contoh 2 -->
                            <tr>
                                <td>Amoxicillin 500mg</td>
                                <td>Antibiotik</td>
                                <td>85 Strip</td>
                            </tr>
                            <!-- Baris data contoh 3 -->
                            <tr>
                                <td>Antasida Doen</td>
                                <td>Lambung</td>
                                <td>200 Tablet</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= FORM FILTER & OPSI TABEL MUTASI STOK ================= -->
        <div class="card shadow-sm border-0 p-4">
            <h4 class="text-center fw-bold mb-1">Opsi Tabel Mutasi Stok</h4>
            <p class="text-center text-muted small mb-4">Pilih data yang akan ditampilkan pada tabel mendetail di bawah ini.</p>
            
            <form method="GET" action="">
                <div class="row g-3 mb-4">
                    
                    <!-- Pilihan Filter: Kategori Obat -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Kategori Obat</label>
                        <select class="form-select form-select-sm">
                            <option value="">Semua Kategori</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Filter tabel berdasarkan kategori</div>
                    </div>

                    <!-- Pilihan Filter: Jenis Mutasi Stok -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Jenis Mutasi Stok</label>
                        <select class="form-select form-select-sm">
                            <option value="">Semua</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Penerimaan, Pengeluaran, Transfer, Penyesuaian</div>
                    </div>

                    <!-- Pilihan Filter: Mode Tampilan -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Mode Tampilan</label>
                        <select class="form-select form-select-sm">
                            <option value="">Penilaian Saat Ini</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Beralih antara Saat Ini / Rerata Bulanan</div>
                    </div>

                    <!-- Pilihan Filter: Urutkan Berdasarkan -->
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Urutkan Berdasarkan</label>
                        <select class="form-select form-select-sm">
                            <option value="">Nilai Tertinggi</option>
                        </select>
                        <div class="form-text text-muted" style="font-size: 10px;">Penilaian, Nama, atau Tanggal Mutasi Terakhir</div>
                    </div>

                </div>

                <!-- Tombol Aksi Form (Atur Ulang & Perbarui Tabel) -->
                <div class="text-center border-top pt-3">
                    <button type="reset" class="btn btn-outline-danger px-4 me-2">Atur Ulang</button>
                    <button type="submit" class="btn btn-danger px-4">Perbarui Tabel</button>
                </div>
            </form>
        </div>

    </div>

    <!-- Memuat Bootstrap 5 JS Bundle dari CDN untuk mendukung komponen interaktif -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>