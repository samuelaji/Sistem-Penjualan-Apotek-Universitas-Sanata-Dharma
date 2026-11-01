<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir POS - Apotek Sanata Dharma</title>
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Font: Inter / Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f6f9;
        }
        .bg-maroon { background-color: #8B0000 !important; }
        .text-maroon { color: #8B0000 !important; }
        .btn-maroon {
            background-color: #8B0000;
            color: #ffffff;
            font-weight: 600;
            border: none;
            transition: all 0.2s;
        }
        .btn-maroon:hover {
            background-color: #6d0000;
            color: #ffffff;
            transform: translateY(-1px);
        }
        /* Card & UI modern */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            transition: all 0.2s ease-in-out;
        }
        .card-product:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            border: 1px solid #8B0000;
        }
        .category-pill {
            cursor: pointer;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #495057;
            transition: all 0.2s;
        }
        .category-pill.active, .category-pill:hover {
            background: #8B0000;
            color: white;
            border-color: #8B0000;
        }
        /* Keranjang Sticky di sisi kanan */
        .cart-sticky {
            position: sticky;
            top: 20px;
            height: calc(100vh - 100px);
            display: flex;
            flex-direction: column;
        }
        .cart-items-container {
            flex-grow: 1;
            overflow-y: auto;
            max-height: 380px;
        }
        .btn-qty {
            width: 28px;
            height: 28px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Navbar Modern -->
<nav class="navbar navbar-expand-lg bg-maroon navbar-dark shadow-sm py-2 px-3">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="#">
            <i class="bi bi-capsule fs-4"></i>
            <span>Apotek USD <span class="badge bg-danger text-white fs-6 fw-normal ms-1">POS Kasir</span></span>
        </a>
        <div class="d-flex align-items-center gap-3 text-white">
            <div class="d-none d-md-block text-end">
                <small class="d-block opacity-75" style="font-size: 0.75rem;">Petugas Aktif:</small>
                <span class="fw-semibold small"><i class="bi bi-person-circle me-1"></i> {{ Auth::user()->nama_pengguna ?? 'Kasir Pelayanan' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Main POS Layout: Split Screen -->
<div class="container-fluid py-4 px-4">
    <div class="row g-4">

        <!-- ================= SISI KIRI: KATALOG OBAT & PENCARIAN (65%) ================= -->
        <div class="col-lg-8">

            <!-- Header Pencarian & Kategori -->
            <div class="card card-custom p-3 mb-3">
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="Ketik nama obat atau scan SKU..." autofocus>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-light text-secondary border p-2 w-100 text-truncate">
                            <i class="bi bi-calendar3 me-1"></i> {{ date('d F Y') }}
                        </span>
                    </div>
                </div>

                <!-- Filter Kategori Pill -->
                <div class="d-flex gap-2 overflow-auto pb-1">
                    <span class="category-pill active">Semua Obat</span>
                    <span class="category-pill">Antibiotik</span>
                    <span class="category-pill">Analgesik & Antipiretik</span>
                    <span class="category-pill">Vitamin & Suplemen</span>
                    <span class="category-pill">Sirup & Tetes</span>
                </div>
            </div>

            <!-- Grid Kartu Obat -->
            <div class="row g-3">

                <!-- Contoh Obat 1 -->
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="card card-custom card-product h-100 p-3 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill" style="font-size: 0.7rem;">Stok: 45</span>
                                <small class="text-muted font-monospace" style="font-size: 0.65rem;">AMO-500</small>
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted mb-2" style="height: 100px;">
                                <i class="bi bi-capsule fs-1 text-secondary opacity-50"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-truncate" title="Amoxicillin 500mg">Amoxicillin 500mg</h6>
                            <p class="text-muted small mb-2" style="font-size: 0.75rem;">12 Kapsul / Strip</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="fw-bold text-maroon">Rp 18.000</span>
                            <button class="btn btn-sm btn-maroon rounded-circle btn-qty" title="Tambah ke Pesanan">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contoh Obat 2 -->
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="card card-custom card-product h-100 p-3 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill" style="font-size: 0.7rem;">Stok: 24</span>
                                <small class="text-muted font-monospace" style="font-size: 0.65rem;">PARA-SYR</small>
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted mb-2" style="height: 100px;">
                                <i class="bi bi-prescription2 fs-1 text-secondary opacity-50"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-truncate" title="Paracetamol Sirup 60ml">Paracetamol Sirup</h6>
                            <p class="text-muted small mb-2" style="font-size: 0.75rem;">Botol 60ml</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="fw-bold text-maroon">Rp 27.000</span>
                            <button class="btn btn-sm btn-maroon rounded-circle btn-qty" title="Tambah ke Pesanan">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contoh Obat 3 -->
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="card card-custom card-product h-100 p-3 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill" style="font-size: 0.7rem;">Stok Tipis: 5</span>
                                <small class="text-muted font-monospace" style="font-size: 0.65rem;">CET-10</small>
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted mb-2" style="height: 100px;">
                                <i class="bi bi-capsule fs-1 text-secondary opacity-50"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-truncate" title="Cetirizine 10mg">Cetirizine 10mg</h6>
                            <p class="text-muted small mb-2" style="font-size: 0.75rem;">10 Tablet</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="fw-bold text-maroon">Rp 12.500</span>
                            <button class="btn btn-sm btn-maroon rounded-circle btn-qty" title="Tambah ke Pesanan">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contoh Obat 4 -->
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="card card-custom card-product h-100 p-3 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill" style="font-size: 0.7rem;">Stok: 80</span>
                                <small class="text-muted font-monospace" style="font-size: 0.65rem;">VIT-C500</small>
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted mb-2" style="height: 100px;">
                                <i class="bi bi-capsule fs-1 text-secondary opacity-50"></i>
                            </div>
                            <h6 class="fw-bold mb-1 text-truncate" title="Vitamin C 500mg">Vitamin C 500mg</h6>
                            <p class="text-muted small mb-2" style="font-size: 0.75rem;">10 Tablet Hisap</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="fw-bold text-maroon">Rp 10.000</span>
                            <button class="btn btn-sm btn-maroon rounded-circle btn-qty" title="Tambah ke Pesanan">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= SISI KANAN: KERANJANG & CHECKOUT (35%) ================= -->
        <div class="col-lg-4">
            <div class="card card-custom p-3 cart-sticky">

                <!-- Header Keranjang -->
                <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                    <h5 class="fw-bold m-0 d-flex align-items-center gap-2">
                        <i class="bi bi-cart3 text-maroon"></i> Keranjang Transaksi
                    </h5>
                    <button class="btn btn-link text-danger text-decoration-none p-0 small" style="font-size: 0.8rem;">
                        <i class="bi bi-trash"></i> Kosongkan
                    </button>
                </div>

                <!-- Informasi Pelanggan & Resep -->
                <div class="bg-light p-2 rounded-3 mb-3 border">
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label text-muted small mb-1" style="font-size: 0.75rem;">Tipe Pasien</label>
                            <select class="form-select form-select-sm border-0 fw-semibold">
                                <option value="Umum">Umum</option>
                                <option value="BLU">Pasien BLU</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small mb-1" style="font-size: 0.75rem;">Status Resep</label>
                            <select class="form-select form-select-sm border-0 fw-semibold">
                                <option value="Tanpa Resep">Non-Resep</option>
                                <option value="Resep Dokter">Ada Resep</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Daftar Item Belanja (Bisa di-scroll) -->
                <div class="cart-items-container pe-1">

                    <!-- Item 1 -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div style="max-width: 60%;">
                            <h6 class="fw-semibold mb-0 small text-truncate">Amoxicillin 500mg</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">Rp 18.000 / strip</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-outline-secondary btn-qty"><i class="bi bi-dash"></i></button>
                            <span class="fw-bold small px-1">2</span>
                            <button class="btn btn-sm btn-outline-secondary btn-qty"><i class="bi bi-plus"></i></button>
                            <span class="fw-bold small text-maroon ms-2">Rp 36.000</span>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <div style="max-width: 60%;">
                            <h6 class="fw-semibold mb-0 small text-truncate">Paracetamol Sirup</h6>
                            <small class="text-muted" style="font-size: 0.75rem;">Rp 27.000 / botol</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-sm btn-outline-secondary btn-qty"><i class="bi bi-dash"></i></button>
                            <span class="fw-bold small px-1">1</span>
                            <button class="btn btn-sm btn-outline-secondary btn-qty"><i class="bi bi-plus"></i></button>
                            <span class="fw-bold small text-maroon ms-2">Rp 27.000</span>
                        </div>
                    </div>

                </div>

                <!-- Bagian Total & Pembayaran (Selalu ada di bawah) -->
                <div class="pt-3 border-top mt-auto">
                    <div class="d-flex justify-content-between mb-1 text-muted small">
                        <span>Subtotal</span>
                        <span>Rp 63.000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold fs-5">Total Bayar</span>
                        <span class="fw-bold fs-4 text-maroon">Rp 63.000</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted small mb-1" style="font-size: 0.75rem;">Metode Pembayaran</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="btnradio" id="cash" checked>
                            <label class="btn btn-outline-secondary btn-sm fw-semibold" for="cash"><i class="bi bi-cash me-1"></i> Cash</label>

                            <input type="radio" class="btn-check" name="btnradio" id="qris">
                            <label class="btn btn-outline-secondary btn-sm fw-semibold" for="qris"><i class="bi bi-qr-code me-1"></i> QRIS</label>

                            <input type="radio" class="btn-check" name="btnradio" id="transfer">
                            <label class="btn btn-outline-secondary btn-sm fw-semibold" for="transfer"><i class="bi bi-bank me-1"></i> Transfer</label>
                        </div>
                    </div>

                    <button class="btn btn-maroon w-100 py-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Proses Pembayaran (F9)</span>
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
