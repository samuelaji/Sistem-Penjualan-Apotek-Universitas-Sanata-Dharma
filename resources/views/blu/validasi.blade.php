<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi BLU - Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-maroon { background-color: #990000; }
        .text-maroon { color: #990000; }
        .btn-maroon { background-color: #990000; color: white; border: none; border-radius: 0; }
        .btn-maroon:hover { background-color: #7a0000; color: white; }
        .box-sharp { border-radius: 0 !important; }
    </style>
</head>
<body class="bg-white">

<nav class="navbar navbar-expand-lg bg-maroon navbar-dark py-1">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-6" href="#">Validasi BLU</a>
        <div class="d-flex ms-auto gap-3 text-white small" style="font-size: 0.75rem;">
            <span style="cursor: pointer;">Dasbor</span>
            <span style="cursor: pointer;">Transaksi</span>
            <span style="cursor: pointer;">Riwayat</span>
            <span style="cursor: pointer;">Shift</span>
            <span style="cursor: pointer;">Logout</span>
        </div>
    </div>
</nav>

<!-- Konten Utama -->
<div class="container py-5 mt-4" style="max-width: 800px;">

    <!-- Judul & Keterangan -->
    <div class="text-center mb-5">
        <h3 class="fw-bold mb-2">Verifikasi Anggota BLU</h3>
        <p class="text-muted small">Pilih jenis pasien dan verifikasi NIM/NIP sebelum menjual layanan BLU.</p>
    </div>

    <!-- Form Verifikasi -->
    <form action="#" method="POST">
        @csrf
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold" style="font-size: 0.85rem;">Tipe Pasien</label>
                <select class="form-select form-select-sm box-sharp py-2">
                    <option selected disabled>Pilih Tipe</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen_staf">Dosen / Staf</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold" style="font-size: 0.85rem;">NIM / NIP</label>
                <input type="text" class="form-control form-control-sm box-sharp py-2" placeholder="Masukkan NIM/NIP">
            </div>
        </div>

        <!-- Tombol Verifikasi -->
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-maroon px-5 py-2 fw-bold box-sharp" style="font-size: 0.9rem;">Verifikasi</button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
