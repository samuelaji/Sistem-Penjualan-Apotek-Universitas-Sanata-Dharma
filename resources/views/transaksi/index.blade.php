<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Terminal POS - Apotek USD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/system-popups.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }

        @keyframes pageEntrance {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes rowAppear {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .animate-row {
            animation: rowAppear 0.25s var(--ease-out) forwards;
        }

        .text-maroon { color: var(--maroon) !important; }

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
            gap: 0.75rem;
            overflow: hidden;
            min-width: 0;
        }

        /* ---------- Pencarian Obat ---------- */
        .search-container {
            background: var(--surface);
            border-radius: 12px;
            padding: 0.75rem 1.15rem;
            border: 1.5px solid var(--border-soft);
            position: relative;
            transition: all 0.2s ease;
        }
        .search-container:focus-within {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }

        .search-input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 0.98rem;
            background: transparent;
            font-weight: 500;
            color: var(--text-dark);
        }

        .search-results-dropdown {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            background: var(--surface);
            border-radius: 12px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
            max-height: 360px;
            overflow-y: auto;
            z-index: 100;
            display: none;
            animation: rowAppear 0.2s ease;
        }

        .search-item {
            padding: 0.85rem 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background 0.15s ease;
        }
        .search-item:hover { background-color: #f8fafc; }
        .search-item.active {
            background-color: #f8fafc;
            border-left: 3px solid var(--maroon);
        }
        .search-item:last-child { border-bottom: none; }

        .search-item-title {
            font-size: 0.96rem;
            font-weight: 600;
            color: var(--text-dark);
            display: block;
        }
        .search-item-meta {
            font-size: 0.84rem;
            font-weight: 400;
            color: var(--text-muted);
            font-variant-numeric: tabular-nums;
        }
        .search-item-price {
            font-size: 0.96rem;
            font-weight: 600;
            color: var(--text-dark);
            display: block;
            font-variant-numeric: tabular-nums;
        }
        .search-item-stock {
            font-size: 0.82rem;
            font-weight: 600;
            display: block;
            margin-top: 2px;
            font-variant-numeric: tabular-nums;
        }
        .stock-safe { color: #047857; }
        .stock-low  { color: #b45309; }
        .stock-out  { color: #dc2626; }

        /* ---------- Tabel Transaksi ---------- */
        .table-card {
            flex: 1;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .table-wrapper {
            flex: 1;
            overflow: auto;
            display: flex;
            flex-direction: column;
        }

        .table-custom {
            width: 100%;
            min-width: 820px;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.15px;
            padding: 0.85rem 0.65rem;
            border-bottom: 1.5px solid var(--border-soft);
            position: sticky;
            top: 0;
            z-index: 5;
            white-space: nowrap;
            text-align: center;
            vertical-align: middle;
        }

        .table-custom tbody td {
            padding: 0.85rem 0.65rem;
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.98rem;
            line-height: 1.45;
            color: var(--text-body);
            transition: background-color 0.15s ease;
        }

        .table-custom tbody tr:hover td {
            background-color: #fafbfc;
        }

        /* Hirarki Tipografi Kolom */
        .col-no {
            font-weight: 500;
            color: var(--text-muted) !important;
            font-variant-numeric: tabular-nums;
        }
        .col-sku {
            font-weight: 600;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.25px;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }
        .col-med-name {
            font-weight: 600;
            color: var(--text-dark);
        }
        .col-packaging {
            font-weight: 400;
            color: #475569;
            text-transform: capitalize;
        }
        .col-price {
            font-weight: 500;
            color: var(--text-body);
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }
        .qty-val {
            font-weight: 600;
            color: var(--text-dark);
            min-width: 28px;
            display: inline-block;
            text-align: center;
            font-variant-numeric: tabular-nums;
        }
        .col-subtotal {
            font-weight: 600;
            color: var(--text-dark);
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        /* Tombol Pengatur Jumlah & Hapus Item (Merah Marun + Ikon SVG Tebal) */
        .table-qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: var(--maroon);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            padding: 0;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .table-qty-btn:hover {
            background: var(--maroon-dark);
            color: #ffffff;
        }
        .table-qty-btn:active {
            transform: scale(0.95);
        }

        .btn-remove-item {
            width: 34px;
            height: 34px;
            border: none;
            background: var(--maroon);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            padding: 0;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .btn-remove-item:hover {
            background: #520000;
            color: #ffffff;
        }
        .btn-remove-item:active {
            transform: scale(0.95);
        }

        .table-qty-btn svg,
        .btn-remove-item svg {
            display: block;
            flex-shrink: 0;
        }

        .empty-center-cell {
            height: calc(100vh - 245px);
            vertical-align: middle !important;
            text-align: center;
            border-bottom: none !important;
        }
        .empty-icon-box {
            width: 58px;
            height: 58px;
            background: #f1f5f9;
            color: #94a3b8;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 0.8rem;
        }

        /* ---------- Footer Tabel & Bilah Pintasan ---------- */
        .shortcut-bar {
            padding: 0.72rem 1.25rem;
            border-top: 1px solid var(--border-soft);
            background: #ffffff;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.25rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .key-badge {
            background: #f1f5f9;
            border: 1px solid var(--border-soft);
            padding: 2px 7px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-right: 5px;
            font-variant-numeric: tabular-nums;
        }

        /* ---------- Panel Kanan ---------- */
        .panel-right {
            width: 395px;
            min-width: 395px;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .panel-section {
            padding: 1rem 1.2rem;
            border-bottom: 1px solid var(--border-soft);
        }
        .panel-section:last-child {
            border-bottom: none;
        }

        .section-heading {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            color: #334155;
            display: block;
            margin-bottom: 0.45rem;
        }

        .segmented-selector {
            display: flex;
            background: #f1f5f9;
            border-radius: 10px;
            padding: 3px;
            gap: 3px;
        }
        .segmented-selector input[type="radio"] {
            display: none;
        }
        .segmented-selector label {
            flex: 1;
            text-align: center;
            padding: 6px 0;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s var(--ease-out);
        }
        .segmented-selector input[type="radio"]:checked + label {
            background: var(--maroon);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(139, 0, 0, 0.2);
        }

        .smooth-accordion {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transform: translateY(-4px);
            transition: max-height 0.35s var(--ease-out),
            opacity 0.25s ease,
            transform 0.25s ease,
            margin-top 0.3s ease;
            margin-top: 0;
        }
        .smooth-accordion.active {
            max-height: 450px;
            opacity: 1;
            transform: translateY(0);
            margin-top: 0.7rem;
        }

        /* Form tambahan tanpa kotak abu-abu */
        .expandable-box {
            padding-top: 0.7rem;
            border-top: 1px solid #f1f5f9;
        }
        .expandable-box .form-label {
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.3rem;
        }
        .expandable-box .form-control {
            font-size: 0.94rem;
            border-radius: 9px;
            border: 1.5px solid var(--border-soft);
            background: #f8fafc;
            padding: 0.48rem 0.75rem;
            transition: all 0.2s ease;
        }
        .expandable-box .form-control:focus {
            background: #ffffff;
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }

        /* ---------- Ringkasan Total ---------- */
        .total-display-box {
            padding-bottom: 0.9rem;
            margin-bottom: 0.95rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .total-label {
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            display: block;
        }

        .total-amount {
            font-size: 2.15rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.15;
            letter-spacing: -0.75px;
            font-variant-numeric: tabular-nums;
        }

        .cash-input-group {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            background: #f8fafc;
            transition: all 0.2s ease;
            overflow: hidden;
        }
        .cash-input-group:focus-within {
            background: #ffffff;
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }

        .cash-prefix {
            padding: 0.65rem 0.9rem;
            background: transparent;
            border-right: 1.5px solid var(--border-soft);
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.95rem;
        }

        .cash-input {
            border: none;
            outline: none;
            width: 100%;
            padding: 0.65rem 0.9rem;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text-dark);
            background: transparent;
            font-variant-numeric: tabular-nums;
        }

        /* Kembalian */
        .change-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 0.7rem;
            margin-top: 0.75rem;
            border-top: 1px solid #f1f5f9;
            font-size: 0.94rem;
            font-variant-numeric: tabular-nums;
        }

        .btn-pay {
            background: var(--maroon);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.2s var(--ease-out);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.16);
        }
        .btn-pay:hover {
            background: var(--maroon-dark);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(139, 0, 0, 0.24);
        }
        .btn-pay:active { transform: scale(0.99); }
        .btn-pay:disabled { opacity: 0.75; cursor: wait; }

    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-4">
        <div class="user-identity">
            <span class="user-name">{{ Auth::user()->nama_pengguna ?? 'Kasir' }}</span>
            <span class="user-id">{{ Auth::user()->username ?? '-' }}</span>
        </div>

        <nav class="nav-segmented ms-2">
            <a href="{{ Route::has('kasir.dashboard') ? route('kasir.dashboard') : url('/kasir/dashboard') }}">Dashboard</a>
            <a href="{{ route('transaksi.index') }}" class="active">Transaksi</a>
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
        <div class="search-container">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-search text-muted fs-5"></i>
                <input
                    type="text"
                    class="search-input"
                    id="medicineSearchInput"
                    placeholder="Cari nama obat, SKU, atau kategori..."
                    autocomplete="off"
                    autofocus
                >
            </div>
            <div class="search-results-dropdown" id="searchResults"></div>
        </div>

        <div class="table-card">
            <div class="table-wrapper">
                <table class="table-custom">
                    <thead>
                    <tr>
                        <th style="width: 5%;">No.</th>
                        <th style="width: 11%;">Kode SKU</th>
                        <th style="width: 25%;">Nama Obat</th>
                        <th style="width: 14%;">Kemasan</th>
                        <th style="width: 14%;">Harga Satuan</th>
                        <th style="width: 13%;">Jumlah</th>
                        <th style="width: 12%;">Subtotal</th>
                        <th style="width: 6%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                    <tr id="emptyTableRow">
                        <td colspan="8" class="empty-center-cell">
                            <div class="empty-icon-box">
                                <i class="bi bi-receipt"></i>
                            </div>
                            <div class="fw-bold text-dark mb-1" style="font-size: 1.05rem;">Belum Ada Item Transaksi</div>
                            <p class="text-muted mb-0" style="font-size: 0.92rem;">Cari nama obat, SKU, atau kategori pada kolom di atas untuk menambahkan item.</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="shortcut-bar">
                <span><span class="key-badge">/</span>Cari Obat</span>
                <span><span class="key-badge">F8</span>Kosongkan Transaksi</span>
                <span><span class="key-badge">F9</span>Selesaikan Transaksi</span>
                <span class="ms-auto text-dark fw-semibold" id="tableItemCounter" style="font-variant-numeric: tabular-nums;">0 Item</span>
            </div>
        </div>
    </section>

    <aside class="panel-right">
        <div class="panel-section">
            <span class="section-heading">Jenis Pasien</span>
            <div class="segmented-selector">
                <input type="radio" name="patient_type" id="pasien-umum" value="Umum" checked onchange="updatePaymentVisibility()">
                <label for="pasien-umum">Pasien Umum</label>

                <input type="radio" name="patient_type" id="pasien-blu" value="BLU" onchange="updatePaymentVisibility()">
                <label for="pasien-blu">Sivitas BLU USD</label>
            </div>

            <div class="smooth-accordion" id="bluExpandableArea">
                <div class="expandable-box">
                    <label class="form-label" for="nimNipInput">NIM / NIP</label>
                    <input type="text" class="form-control" id="nimNipInput" placeholder="Masukkan NIM atau NIP" autocomplete="off">
                </div>
            </div>

            <span class="section-heading mt-3">Status Resep</span>
            <div class="segmented-selector">
                <div id="tanpaResepWrapper" style="display: contents;">
                    <input type="radio" name="recipe_type" id="resep-non" value="Non-Resep" checked onchange="toggleRecipeType()">
                    <label for="resep-non">Tanpa Resep</label>
                </div>

                <input type="radio" name="recipe_type" id="resep-ada" value="Resep" onchange="toggleRecipeType()">
                <label for="resep-ada">Resep Dokter</label>
            </div>

            <div class="smooth-accordion" id="recipeExpandableArea">
                <div class="expandable-box">
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label" for="recipeNoInput">No. Resep</label>
                            <input type="text" class="form-control" id="recipeNoInput" placeholder="Nomor resep" autocomplete="off">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="recipeDateInput">Tanggal Resep</label>
                            <input type="date" class="form-control" id="recipeDateInput" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="doctorNameInput">Dokter Penulis</label>
                        <input type="text" class="form-control" id="doctorNameInput" placeholder="Contoh: dr. Budi Santoso" autocomplete="off">
                    </div>
                    <div>
                        <label class="form-label" for="clinicNameInput">Fasilitas Kesehatan</label>
                        <input type="text" class="form-control" id="clinicNameInput" placeholder="Contoh: RS Panti Rapih" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>

   <div class="panel-section flex-grow-1 d-flex flex-column justify-content-between">
            <div>
                <div class="total-display-box">
                    <span class="total-label" id="totalLabelText">Total Tagihan</span>
                    <div class="total-amount" id="grandTotalDisplay">Rp 0</div>
                </div>

                <div class="smooth-accordion" id="paymentMethodSection">
                    <span class="section-heading">Metode Pembayaran</span>
                    <div class="segmented-selector mb-3">
                        <input type="radio" name="payment_method" id="pay-cash" value="Cash" checked onchange="updatePaymentVisibility()">
                        <label for="pay-cash">Tunai</label>

                        <input type="radio" name="payment_method" id="pay-qris" value="QRIS" onchange="updatePaymentVisibility()">
                        <label for="pay-qris">QRIS</label>

                        <input type="radio" name="payment_method" id="pay-transfer" value="Transfer" onchange="updatePaymentVisibility()">
                        <label for="pay-transfer">Transfer</label>
                    </div>
                </div>

                <div class="smooth-accordion" id="cashCalcArea">
                    <div>
                        <label class="form-label fw-semibold text-muted mb-1" for="cashReceivedInput" style="font-size: 0.86rem;">Uang Diterima</label>
                        <div class="cash-input-group">
                            <span class="cash-prefix">Rp</span>
                            <input
                                type="text"
                                class="cash-input"
                                id="cashReceivedInput"
                                placeholder="0"
                                inputmode="numeric"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <div class="change-box">
                        <span class="text-muted fw-semibold">Kembalian</span>
                        <span class="fw-bold text-muted" style="font-size: 1.02rem;" id="changeAmountDisplay">Rp 0</span>
                    </div>
                </div>

                 <div class="smooth-accordion" id="qrisCalcArea">
                    <div>
                        <label class="form-label fw-semibold text-muted mb-1" for="qrisReceivedInput" style="font-size: 0.86rem;">Uang Diterima</label>
                        <div class="cash-input-group">
                            <span class="cash-prefix">Rp</span>
                            <input
                                type="text"
                                class="cash-input"
                                id="qrisReceivedInput"
                                placeholder="0"
                                inputmode="numeric"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <div class="change-box">
                        <span class="text-muted fw-semibold">Kembalian</span>
                        <span class="fw-bold text-muted" style="font-size: 1.02rem;" id="qrisChangeAmountDisplay">Rp 0</span>
                    </div>
                </div>

                <div class="smooth-accordion" id="transferCalcArea">
                    <div>
                        <label class="form-label fw-semibold text-muted mb-1" for="transferReceivedInput" style="font-size: 0.86rem;">Uang Diterima</label>
                        <div class="cash-input-group">
                            <span class="cash-prefix">Rp</span>
                            <input
                                type="text"
                                class="cash-input"
                                id="transferReceivedInput"
                                placeholder="0"
                                inputmode="numeric"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <div class="change-box">
                        <span class="text-muted fw-semibold">Kembalian</span>
                        <span class="fw-bold text-muted" style="font-size: 1.02rem;" id="transferChangeAmountDisplay">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>

            <div class="pt-3">
                <button type="button" class="btn-pay" id="btnCompletePayment">
                    Selesaikan Transaksi
                </button>
            </div>
        </div>
    </aside>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/system-popups.js') }}"></script>
<script>
    const masterObatList = @json($obatList);

    let activeTransaction = [];
    let grandTotal = 0;

    function showTransactionResult(title, message, success) {
        AppPopup.alert(message, {
            title: title,
            icon: success ? 'bi-check-circle' : 'bi-exclamation-circle'
        }).then(function () {
            if (success) window.location.reload();
        });
    }

    const rupiahFormatter = new Intl.NumberFormat('id-ID');
    const formatRupiah = (val) => 'Rp ' + rupiahFormatter.format(Number(val) || 0);

    function escapeHtml(str) {
        return String(str ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function parseNominal(value) {
        return Number(String(value ?? '').replace(/\D/g, '')) || 0;
    }

    const searchInput = document.getElementById('medicineSearchInput');
    const searchDropdown = document.getElementById('searchResults');
    const tableBody = document.getElementById('transactionTableBody');
    const emptyRow = document.getElementById('emptyTableRow');
    const cashInput = document.getElementById('cashReceivedInput');
    const qrisInput = document.getElementById('qrisReceivedInput');
    const transferInput = document.getElementById('transferReceivedInput');

    /* ---------- Jam Header (WIB) ---------- */
    const clockEl = document.getElementById('headerLiveClock');
    function updateHeaderClock() {
        clockEl.textContent = new Date().toLocaleTimeString('en-GB', {
            timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', hour12: false
        }) + ' WIB';
    }
    updateHeaderClock();
    setInterval(updateHeaderClock, 1000);

    /* ---------- Kontrol Tampilan Panel Kanan ---------- */
    function toggleRecipeType() {
        const isRecipe = document.getElementById('resep-ada').checked;
        document.getElementById('recipeExpandableArea').classList.toggle('active', isRecipe);
    }

    function updatePaymentVisibility() {
        const isBlu = document.getElementById('pasien-blu').checked;
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked')?.value || 'Cash';

        const paymentSection = document.getElementById('paymentMethodSection');
        const cashArea = document.getElementById('cashCalcArea');
        const qrisArea = document.getElementById('qrisCalcArea');
        const transferArea = document.getElementById('transferCalcArea');
        const bluExpandable = document.getElementById('bluExpandableArea');
        const tanpaResepWrapper = document.getElementById('tanpaResepWrapper');
        const radioTanpaResep = document.getElementById('resep-non');
        const radioResepAda = document.getElementById('resep-ada');

        bluExpandable.classList.toggle('active', isBlu);

        if (isBlu) {
            paymentSection.classList.remove('active');
            cashArea.classList.remove('active');
            qrisArea.classList.remove('active');
            transferArea.classList.remove('active');
            document.getElementById('totalLabelText').textContent = 'Nilai Penjaminan BLU';

            tanpaResepWrapper.style.display = 'none';
            radioResepAda.checked = true;
            toggleRecipeType();
        } else {
            paymentSection.classList.add('active');
            document.getElementById('totalLabelText').textContent = 'Total Tagihan';
            cashArea.classList.toggle('active', selectedPayment === 'Cash');
            qrisArea.classList.toggle('active', selectedPayment === 'QRIS');
            transferArea.classList.toggle('active', selectedPayment === 'Transfer');

            tanpaResepWrapper.style.display = 'contents';
            radioTanpaResep.checked = true;
            toggleRecipeType();
        }

        calculateChange();
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePaymentVisibility();
        toggleRecipeType();
    });

    /* ---------- Pencarian Obat ---------- */
    let filteredMedicines = [];
    let activeIndex = -1;

    searchInput.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();

        searchDropdown.innerHTML = '';
        filteredMedicines = [];
        activeIndex = -1;

        if (query.length === 0) {
            searchDropdown.style.display = 'none';
            return;
        }

        filteredMedicines = masterObatList.filter(o =>
            (o.nama_obat && o.nama_obat.toLowerCase().includes(query)) ||
            (o.sku && o.sku.toLowerCase().includes(query)) ||
            (o.kategori && o.kategori.toLowerCase().includes(query))
        );

        if (filteredMedicines.length > 0) {
            filteredMedicines.forEach((obat, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'search-item';

                const isLowStock = Number(obat.stok) <= Number(obat.batas_minimum);
                const stockTextClass = Number(obat.stok) <= 0
                    ? 'stock-out'
                    : (isLowStock ? 'stock-low' : 'stock-safe');

                itemDiv.innerHTML = `
                    <div>
                        <span class="search-item-title">${escapeHtml(obat.nama_obat)}</span>
                        <span class="search-item-meta">${escapeHtml(obat.sku)} &bull; ${escapeHtml(obat.jenis_obat)}</span>
                    </div>
                    <div class="text-end">
                        <span class="search-item-price">${formatRupiah(obat.harga_obat)}</span>
                        <span class="search-item-stock ${stockTextClass}">Stok: ${Number(obat.stok)}</span>
                    </div>
                `;

                itemDiv.onclick = () => selectMedicine(index);
                searchDropdown.appendChild(itemDiv);
            });
            searchDropdown.style.display = 'block';
        } else {
            searchDropdown.innerHTML = `
                <div class="p-3 text-center text-muted" style="font-size: 0.92rem;">
                    Obat tidak ditemukan.
                </div>
            `;
            searchDropdown.style.display = 'block';
        }
    });

    function updateActiveMedicine() {
        const items = searchDropdown.querySelectorAll('.search-item');
        items.forEach((item, index) => {
            item.classList.toggle('active', index === activeIndex);
        });

        if (activeIndex >= 0 && items[activeIndex]) {
            items[activeIndex].scrollIntoView({ block: 'nearest' });
        }
    }

    function selectMedicine(index) {
        const obat = filteredMedicines[index];
        if (!obat) return;

        addItemToTransaction(obat);

        searchInput.value = '';
        searchDropdown.style.display = 'none';
        filteredMedicines = [];
        activeIndex = -1;
        searchInput.focus();
    }

    searchInput.addEventListener('keydown', function (e) {
        if (['ArrowDown', 'ArrowUp', 'PageDown', 'PageUp'].includes(e.key) && filteredMedicines.length > 0) {
            e.preventDefault();
            if (e.key === 'ArrowDown' || e.key === 'PageDown') {
                activeIndex = Math.min(activeIndex + 1, filteredMedicines.length - 1);
            } else {
                activeIndex = Math.max(activeIndex - 1, 0);
            }
            updateActiveMedicine();
        }

        if (e.key === 'Enter' && activeIndex >= 0) {
            e.preventDefault();
            selectMedicine(activeIndex);
        }

        if (e.key === 'Escape') {
            searchDropdown.style.display = 'none';
            activeIndex = -1;
        }
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.search-container')) {
            searchDropdown.style.display = 'none';
        }
    });

    /* ---------- Manajemen Keranjang Transaksi ---------- */
    function addItemToTransaction(obat) {
        const maxStok = Number(obat.stok) || 0;
        if (maxStok <= 0) {
            AppPopup.alert('Stok obat tidak tersedia.', { title: 'Stok tidak tersedia' });
            return;
        }

        const exist = activeTransaction.find(item => item.id_obat === obat.id_obat);
        if (exist) {
            if (exist.qty < maxStok) {
                exist.qty += 1;
            } else {
                AppPopup.alert('Jumlah melebihi stok tersedia.', { title: 'Stok tidak mencukupi' });
            }
        } else {
            activeTransaction.push({
                id_obat: obat.id_obat,
                sku: obat.sku,
                nama: obat.nama_obat,
                jenis: obat.jenis_obat,
                harga: parseFloat(obat.harga_obat) || 0,
                qty: 1,
                max_stok: maxStok
            });
        }
        renderTable();
    }

    function renderTable() {
        tableBody.innerHTML = '';
        grandTotal = 0;

        if (activeTransaction.length === 0) {
            tableBody.appendChild(emptyRow);
            document.getElementById('tableItemCounter').textContent = '0 Item';
            updateTotals();
            return;
        }

        activeTransaction.forEach((item, index) => {
            const subtotal = item.harga * item.qty;
            grandTotal += subtotal;

            const tr = document.createElement('tr');
            tr.className = 'animate-row';
            tr.innerHTML = `
                <td class="col-no">${index + 1}</td>
                <td class="col-sku">${escapeHtml(item.sku)}</td>
                <td class="col-med-name">${escapeHtml(item.nama)}</td>
                <td class="col-packaging">${escapeHtml(item.jenis)}</td>
                <td class="col-price">${formatRupiah(item.harga)}</td>
                <td>
                    <div class="d-inline-flex align-items-center justify-content-center gap-2">
                        <button type="button" class="table-qty-btn" title="Kurangi jumlah" aria-label="Kurangi jumlah" onclick="updateItemQty(${index}, -1)">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round">
                                <line x1="3" y1="8" x2="13" y2="8"/>
                            </svg>
                        </button>
                        <span class="qty-val">${item.qty}</span>
                        <button type="button" class="table-qty-btn" title="Tambah jumlah" aria-label="Tambah jumlah" onclick="updateItemQty(${index}, 1)">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round">
                                <line x1="8" y1="3" x2="8" y2="13"/>
                                <line x1="3" y1="8" x2="13" y2="8"/>
                            </svg>
                        </button>
                    </div>
                </td>
                <td class="col-subtotal">${formatRupiah(subtotal)}</td>
                <td>
                    <button type="button" class="btn-remove-item" onclick="removeItem(${index})" title="Hapus Item" aria-label="Hapus Item">
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round">
                            <line x1="3.5" y1="3.5" x2="12.5" y2="12.5"/>
                            <line x1="12.5" y1="3.5" x2="3.5" y2="12.5"/>
                        </svg>
                    </button>
                </td>
            `;
            tableBody.appendChild(tr);
        });

        document.getElementById('tableItemCounter').textContent = `${activeTransaction.length} Item`;
        updateTotals();
    }

    function updateItemQty(index, delta) {
        const item = activeTransaction[index];
        if (!item) return;

        const newQty = item.qty + delta;
        if (newQty > 0 && newQty <= item.max_stok) {
            item.qty = newQty;
        } else if (newQty === 0) {
            removeItem(index);
            return;
        } else if (newQty > item.max_stok) {
            AppPopup.alert('Jumlah melebihi stok tersedia.', { title: 'Stok tidak mencukupi' });
        }
        renderTable();
    }

    function removeItem(index) {
        activeTransaction.splice(index, 1);
        renderTable();
    }

    async function clearTransaction() {
        if (activeTransaction.length > 0 && await AppPopup.confirm('Kosongkan seluruh item pada transaksi ini?', {
            title: 'Kosongkan transaksi?',
            acceptText: 'Kosongkan'
        })) {
            activeTransaction = [];
            renderTable();
        }
    }

    /* ---------- Kalkulasi Pembayaran ---------- */
    function updateTotals() {
        document.getElementById('grandTotalDisplay').textContent = formatRupiah(grandTotal);
        calculateChange();
    }

    function calculateChange() {
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked')?.value || 'Cash';
        const paymentInputs = {
            Cash: { input: cashInput, display: document.getElementById('changeAmountDisplay') },
            QRIS: { input: qrisInput, display: document.getElementById('qrisChangeAmountDisplay') },
            Transfer: { input: transferInput, display: document.getElementById('transferChangeAmountDisplay') }
        };
        const payment = paymentInputs[selectedPayment] || paymentInputs.Cash;
        const received = parseNominal(payment.input.value);
        const change = received - grandTotal;
        const changeDisplay = payment.display;

        if (received >= grandTotal && grandTotal > 0) {
            changeDisplay.textContent = formatRupiah(change);
            changeDisplay.className = 'fw-bold text-success';
        } else if (received > 0 && received < grandTotal) {
            changeDisplay.textContent = 'Kurang ' + formatRupiah(Math.abs(change));
            changeDisplay.className = 'fw-bold text-danger';
        } else {
            changeDisplay.textContent = 'Rp 0';
            changeDisplay.className = 'fw-bold text-muted';
        }
    }

    [cashInput, qrisInput, transferInput].forEach(function (input) {
        input.addEventListener('input', function () {
            const digitsBefore = this.value.slice(0, this.selectionStart).replace(/\D/g, '').length;
            const digits = this.value.replace(/\D/g, '').replace(/^0+(?=\d)/, '');

            this.value = digits ? rupiahFormatter.format(digits) : '';

            let seen = 0, pos = 0;
            while (pos < this.value.length && seen < digitsBefore) {
                if (/\d/.test(this.value[pos])) seen++;
                pos++;
            }
            this.setSelectionRange(pos, pos);

            calculateChange();
        });
    });

    /* ---------- Pintasan Keyboard ---------- */
    document.addEventListener('keydown', function (e) {
        if (e.key === '/' && document.activeElement !== searchInput &&
            document.activeElement !== cashInput &&
            document.activeElement !== qrisInput &&
            document.activeElement !== transferInput) {
            e.preventDefault();
            searchInput.focus();
        }
        if (e.key === 'F8') {
            e.preventDefault();
            clearTransaction();
        }
        if (e.key === 'F9') {
            e.preventDefault();
            document.getElementById('btnCompletePayment').click();
        }
    });

    /* ---------- Simpan Transaksi ---------- */
    document.getElementById('btnCompletePayment').addEventListener('click', async function () {
        if (activeTransaction.length === 0) {
            AppPopup.alert('Belum ada item obat yang ditambahkan.', { title: 'Transaksi masih kosong' });
            return;
        }

        const patientType = document.querySelector('input[name="patient_type"]:checked').value;
        const recipeType = document.querySelector('input[name="recipe_type"]:checked').value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value || 'Cash';

        let cashReceived = 0;
        let changeAmount = 0;

        if (patientType === 'Umum') {
            const paymentInputs = {
                Cash: cashInput,
                QRIS: qrisInput,
                Transfer: transferInput
            };
            const receivedInput = paymentInputs[paymentMethod] || cashInput;
            cashReceived = parseNominal(receivedInput.value);
            changeAmount = cashReceived - grandTotal;

            if (cashReceived < grandTotal) {
                AppPopup.alert('Nominal pembayaran kurang dari total tagihan.', {
                    title: 'Pembayaran belum cukup'
                }).then(function () {
                    receivedInput.focus();
                });
                return;
            }
        } else {
            cashReceived = grandTotal;
            changeAmount = 0;
        }

        const btn = this;
        const originalBtnHTML = btn.innerHTML;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Memproses...`;
        btn.disabled = true;

        const payload = {
            cart: activeTransaction,
            patient_type: patientType,
            nim_nip: document.getElementById('nimNipInput').value.trim(),
            recipe_type: recipeType,
            recipe_no: document.getElementById('recipeNoInput').value.trim(),
            recipe_date: document.getElementById('recipeDateInput').value,
            doctor_name: document.getElementById('doctorNameInput').value.trim(),
            clinic_name: document.getElementById('clinicNameInput').value.trim(),
            payment_method: paymentMethod,
            grand_total: grandTotal,
            cash_received: cashReceived,
            change_amount: changeAmount
        };

        try {
            const response = await fetch('/transaksi/simpan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();
            if (response.ok && result.success) {
                showTransactionResult(
                    'Pembayaran berhasil!',
                    'Transaksi berhasil disimpan dan tercatat pada sistem apotek.',
                    true
                );
            } else {
                showTransactionResult(
                    'Transaksi belum berhasil',
                    result.message || 'Transaksi gagal diproses. Silakan coba kembali.',
                    false
                );
                btn.innerHTML = originalBtnHTML;
                btn.disabled = false;
            }
        } catch (error) {
            console.error('Error:', error);
            showTransactionResult(
                'Koneksi bermasalah',
                'Terjadi kesalahan jaringan atau server. Periksa koneksi, lalu coba kembali.',
                false
            );
            btn.innerHTML = originalBtnHTML;
            btn.disabled = false;
        }
    });
</script>

</body>
</html>
