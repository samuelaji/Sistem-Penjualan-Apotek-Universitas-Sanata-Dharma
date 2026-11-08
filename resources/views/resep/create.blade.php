<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Resep - Apotek USD</title>
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

        .btn-circle { width: 24px; height: 24px; padding: 0; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; }
        .btn-minus { background-color: white; border: 1px solid #dc3545; color: #dc3545; }
        .btn-plus { background-color: white; border: 1px solid #198754; color: #198754; }
    </style>
</head>
<body class="bg-white">

<!-- Navbar Merah Marun -->
<nav class="navbar navbar-expand-lg bg-maroon navbar-dark py-1">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-6" href="#">Validasi Resep</a>
        <div class="d-flex ms-auto gap-3 text-white small" style="font-size: 0.75rem;">
            <span style="cursor: pointer;">Dasbor</span>
            <span style="cursor: pointer;">Transaksi</span>
            <span style="cursor: pointer;">Riwayat</span>
            <span style="cursor: pointer;">Shift</span>
            <span style="cursor: pointer;">Logout</span>
        </div>
    </div>
</nav>

<div class="container py-5" style="max-width: 700px;">

    <!-- Bagian 1: Detail Resep -->
    <div class="mb-5">
        <h5 class="fw-bold mb-4 text-center">Detail Resep</h5>
        <div class="row g-4 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold" style="font-size: 0.85rem;">Nama Dokter</label>
                <input type="text" class="form-control form-control-sm box-sharp" placeholder="Contoh: Dr. Sarah Kim">
                <div class="form-text" style="font-size: 0.7rem;">Wajib diisi</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold" style="font-size: 0.85rem;">Tanggal Resep</label>
                <input type="date" class="form-control form-control-sm box-sharp">
                <div class="form-text" style="font-size: 0.7rem;">Wajib diisi</div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-bold" style="font-size: 0.85rem;">Nama Pasien</label>
                <input type="text" class="form-control form-control-sm box-sharp" placeholder="Contoh: Budi Santoso">
                <div class="form-text" style="font-size: 0.7rem;">Wajib diisi</div>
            </div>
        </div>
    </div>

    <!-- Bagian 2: Pilih Obat -->
    <div class="mb-5">
        <h5 class="fw-bold mb-4 text-center">Pilih Obat yang Diresepkan</h5>
        <div class="mb-3">
            <label class="form-label fw-bold" style="font-size: 0.85rem;">Cari Obat</label>
            <input type="text" class="form-control form-control-sm box-sharp" placeholder="Contoh: Amoxicillin, Paracetamol, 500mg">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-maroon btn-sm px-3 fw-bold box-sharp">Buka Katalog Obat</button>
            <button class="btn btn-maroon btn-sm px-4 fw-bold box-sharp">Tambahkan Obat</button>
        </div>
    </div>

    <!-- Bagian 3: Daftar Obat Dipilih -->
    <div class="mb-5">
        <h5 class="fw-bold mb-4 text-center">Daftar Obat Dipilih</h5>

        <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <button class="btn btn-circle btn-minus"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-circle btn-plus"><i class="bi bi-plus"></i></button>
                </div>
                <div>
                    <div class="small fw-bold">Amoxicillin 500mg</div>
                    <div class="text-muted" style="font-size: 0.7rem;">21 tablet</div>
                </div>
            </div>
            <div class="text-start" style="min-width: 150px;">
                <div class="small fw-bold">Qty: 1 strip</div>
                <div class="text-muted" style="font-size: 0.7rem;">Aturan: 1 kapsul, 3x sehari</div>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <button class="btn btn-circle btn-minus"><i class="bi bi-dash"></i></button>
                    <button class="btn btn-circle btn-plus"><i class="bi bi-plus"></i></button>
                </div>
                <div>
                    <div class="small fw-bold">Paracetamol 500mg</div>
                    <div class="text-muted" style="font-size: 0.7rem;">15 tablet</div>
                </div>
            </div>
            <div class="text-start" style="min-width: 150px;">
                <div class="small fw-bold">Qty: 1 box</div>
                <div class="text-muted" style="font-size: 0.7rem;">Aturan: 1 tablet, bila perlu</div>
            </div>
        </div>
    </div>

    <!-- Tombol Submit -->
    <div class="text-center mt-5 mb-5">
        <button class="btn btn-maroon px-4 py-2 fw-bold box-sharp" style="font-size: 0.9rem;">Simpan & Ajukan Validasi</button>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
