<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan - Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .bg-maroon { background-color: #990000; }
        .text-maroon { color: #990000; }
        .btn-maroon { background-color: #990000; color: white; border: none; border-radius: 0; }
        .btn-maroon:hover { background-color: #7a0000; color: white; }
        .btn-outline-maroon { border-color: #990000; color: #990000; background-color: transparent; border-radius: 0; }
        .btn-outline-maroon:hover { background-color: #f8d7d7; color: #990000; border-color: #990000; }

        .box-sharp { border-radius: 0 !important; }
        .card-obat { border: none; }
        .card-obat img { height: 120px; object-fit: contain; }

        /* Tombol bulat kecil untuk tambah/kurang item */
        .btn-circle { width: 24px; height: 24px; padding: 0; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; }
        .btn-minus { background-color: white; border: 1px solid #dc3545; color: #dc3545; }
        .btn-plus { background-color: white; border: 1px solid #198754; color: #198754; }
    </style>
</head>
<body class="bg-white">

<!-- Navbar Merah Marun -->
<nav class="navbar navbar-expand-lg bg-maroon navbar-dark py-1">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-6" href="#">Transaksi</a>
        <div class="d-flex ms-auto gap-3 text-white small" style="font-size: 0.75rem;">
            <span style="cursor: pointer;">Laporan</span>
            <span style="cursor: pointer;">Inventaris</span>
            <span style="cursor: pointer;">Riwayat</span>
            <span style="cursor: pointer;">Obat</span>
            <span style="cursor: pointer;">Logout</span>
        </div>
    </div>
</nav>

<div class="container py-4" style="max-width: 800px;">

    <!-- Bagian Pencarian & Katalog -->
    <div class="text-center mb-4">
        <h5 class="fw-bold mb-1">Pencarian & Katalog Obat</h5>
        <p class="text-muted" style="font-size: 0.75rem;">Cari berdasarkan nama atau SKU dari kolom. Tambahkan ke keranjang.</p>
    </div>

    <!-- Grid Obat (Contoh 3 Item Sesuai Desain) -->
    <div class="row g-4 justify-content-center mb-4">
        <!-- Item 1 -->
        <div class="col-4 col-md-3">
            <div class="card card-obat h-100 text-center">
                <!-- Gunakan placeholder abu-abu jika belum ada gambar -->
                <div class="bg-light mb-2 d-flex align-items-center justify-content-center" style="height:120px;">Gambar Obat</div>
                <div class="small fw-bold text-truncate">Amoxicillin 500mg</div>
                <div class="text-muted" style="font-size: 0.65rem;">SKU AMO 500 • 12 kapsul</div>
                <div class="mt-2">
                    <button class="btn btn-circle btn-minus"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-circle btn-plus"><i class="bi bi-plus"></i></button>
                </div>
            </div>
        </div>
        <!-- Item 2 -->
        <div class="col-4 col-md-3">
            <div class="card card-obat h-100 text-center">
                <div class="bg-light mb-2 d-flex align-items-center justify-content-center" style="height:120px;">Gambar Obat</div>
                <div class="small fw-bold text-truncate">Paracetamol Syrup</div>
                <div class="text-muted" style="font-size: 0.65rem;">SKU PARA-SYR • 60ml</div>
                <div class="mt-2">
                    <button class="btn btn-circle btn-minus"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-circle btn-plus"><i class="bi bi-plus"></i></button>
                </div>
            </div>
        </div>
        <!-- Item 3 -->
        <div class="col-4 col-md-3">
            <div class="card card-obat h-100 text-center">
                <div class="bg-light mb-2 d-flex align-items-center justify-content-center" style="height:120px;">Gambar Obat</div>
                <div class="small fw-bold text-truncate">Cetirizine 10mg</div>
                <div class="text-muted" style="font-size: 0.65rem;">SKU CET10 • 10 tablet</div>
                <div class="mt-2">
                    <button class="btn btn-circle btn-minus"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-circle btn-plus"><i class="bi bi-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Pagination -->
    <div class="d-flex justify-content-center gap-2 mb-5">
        <button class="btn btn-outline-maroon btn-sm px-3" style="font-size: 0.75rem;">Halaman Sebelumnya</button>
        <button class="btn btn-maroon btn-sm px-3" style="font-size: 0.75rem;">Ke Halaman 2</button>
    </div>

    <hr>

    <!-- Bagian Keranjang (transaksi Saat Ini) -->
    <div class="mt-5">
        <h5 class="fw-bold mb-1">Transaksi Saat Ini (Keranjang)</h5>
        <p class="text-muted mb-4" style="font-size: 0.75rem;">Tambahkan obat dari katalog. Sesuaikan jumlah sebelum pembayaran.</p>

        <!-- List Item Keranjang -->
        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <button class="btn btn-circle btn-minus"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-circle btn-plus"><i class="bi bi-plus"></i></button>
                </div>
                <div>
                    <div class="small fw-bold">Amoxicillin 500mg</div>
                    <div class="text-muted" style="font-size: 0.7rem;">x1 @ Rp 15.000</div>
                </div>
            </div>
            <div class="fw-bold small">Rp 15.000</div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <button class="btn btn-circle btn-minus"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-circle btn-plus"><i class="bi bi-plus"></i></button>
                </div>
                <div>
                    <div class="small fw-bold">Paracetamol Syrup</div>
                    <div class="text-muted" style="font-size: 0.7rem;">x1 @ Rp 18.000</div>
                </div>
            </div>
            <div class="fw-bold small">Rp 18.000</div>
        </div>

        <!-- Total Harga -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div class="fw-bold">Total</div>
            <div class="fw-bold text-maroon fs-5">Rp 84.500</div>
        </div>

        <!-- Dropdown Pilihan Pembayaran & Pasien -->
        <div class="row g-3 mb-5">
            <div class="col-md-4">
                <label class="form-label text-muted" style="font-size: 0.75rem;">Tipe Pembayaran</label>
                <select class="form-select form-select-sm box-sharp border-0 border-bottom">
                    <option>Cash</option>
                    <option>Transfer</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted" style="font-size: 0.75rem;">Tipe Pasien</label>
                <select class="form-select form-select-sm box-sharp border-0 border-bottom">
                    <option>Umum / BLU</option>
                    <option>Mahasiswa</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted" style="font-size: 0.75rem;">Resep</label>
                <select class="form-select form-select-sm box-sharp border-0 border-bottom">
                    <option>Tidak Ada</option>
                    <option>Ada Resep</option>
                </select>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-center gap-3 mt-4 mb-5">
            <button class="btn btn-outline-maroon px-4 fw-bold" style="font-size: 0.85rem;">Batalkan Transaksi</button>
            <button class="btn btn-maroon px-5 fw-bold" style="font-size: 0.85rem;">Proses Pembayaran</button>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
