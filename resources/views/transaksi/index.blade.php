<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-workspace: #f1f5f9;
            --surface: #ffffff;
            --border-soft: #e2e8f0;
            --maroon: #8B0000;
            --maroon-dark: #6e0000;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-workspace);
            color: var(--text-dark);
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }

        @keyframes rowAppear {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-row {
            animation: rowAppear 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .pos-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0.65rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 20;
        }

        .cashier-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cashier-avatar {
            width: 36px;
            height: 36px;
            background: rgba(139, 0, 0, 0.08);
            color: var(--maroon);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .pos-container {
            flex: 1;
            display: flex;
            overflow: hidden;
            padding: 1rem;
            gap: 1rem;
        }

        .workspace-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            overflow: hidden;
        }

        .search-container {
            background: var(--surface);
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            border: 1.5px solid var(--border-soft);
            position: relative;
            transition: all 0.2s;
        }

        .search-container:focus-within {
            border-color: var(--maroon);
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08);
        }

        .search-input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 1rem;
            background: transparent;
            font-weight: 500;
            color: var(--text-dark);
        }

        .search-results-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
            max-height: 340px;
            overflow-y: auto;
            z-index: 100;
            display: none;
            animation: rowAppear 0.2s ease;
        }

        .search-item {
            padding: 0.85rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f8fafc;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .search-item:hover {
            background-color: #f8fafc;
        }

        .search-item:last-child {
            border-bottom: none;
        }

        .table-card {
            flex: 1;
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border-soft);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .table-wrapper {
            flex: 1;
            overflow-y: auto;
        }

        .table-custom {
            width: 100%;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--border-soft);
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .table-custom tbody td {
            padding: 0.9rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        .table-custom tbody tr:hover {
            background-color: #fafbfc;
        }

        .table-qty-btn {
            width: 26px;
            height: 26px;
            border: 1px solid var(--border-soft);
            background: #ffffff;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .table-qty-btn:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: scale(1.05);
        }

        .shortcut-bar {
            padding: 0.2rem 0.5rem;
            display: flex;
            gap: 1.5rem;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .key-badge {
            background: rgba(0, 0, 0, 0.05);
            padding: 1px 5px;
            border-radius: 4px;
            font-weight: 700;
            font-family: monospace;
            color: var(--text-dark);
        }

        .panel-right {
            width: 380px;
            min-width: 380px;
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .panel-section {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
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
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            opacity 0.25s ease,
            transform 0.25s ease,
            margin-top 0.3s ease;
            margin-top: 0;
        }

        .smooth-accordion.active {
            max-height: 300px;
            opacity: 1;
            transform: translateY(0);
            margin-top: 0.6rem;
        }

        .expandable-box {
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            padding: 0.85rem;
        }

        .total-display-box {
            background: #fff5f5;
            border: 1.5px solid #fed7d7;
            border-left: 5px solid var(--maroon);
            border-radius: 14px;
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .total-label {
            color: #991b1b;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 0.25rem;
        }

        .total-amount {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--maroon);
            line-height: 1;
            letter-spacing: -0.5px;
        }

        .cash-input-group {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .cash-input-group:focus-within {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.08);
        }

        .cash-prefix {
            padding: 0.55rem 0.85rem;
            background: #f8fafc;
            border-right: 1.5px solid var(--border-soft);
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.9rem;
            border-radius: 8px 0 0 8px;
        }

        .cash-input {
            border: none;
            outline: none;
            width: 100%;
            padding: 0.55rem 0.85rem;
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--text-dark);
            background: transparent;
        }

        .btn-pay {
            background: var(--maroon);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 0.95rem;
            border-radius: 12px;
            font-size: 1rem;
            width: 100%;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.15);
        }

        .btn-pay:hover {
            background: var(--maroon-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.25);
        }

        .btn-pay:active {
            transform: scale(0.99);
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="cashier-info">
        <div class="cashier-avatar">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="fw-bold text-dark fs-6">{{ Auth::user()->nama_pengguna ?? 'Kasir Pelayanan' }}</div>
    </div>

    <div class="d-flex align-items-center gap-2">
        <span class="text-muted small me-2" id="headerLiveClock">--:--:--</span>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Keluar">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </button>
        </form>
    </div>
</header>

<main class="pos-container">
    <section class="workspace-left">
        <div class="search-container">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-search text-muted fs-5"></i>
                <input
                    type="text"
                    class="search-input"
                    id="medicineSearchInput"
                    placeholder="Cari nama obat atau kategori..."
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
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Kode/SKU</th>
                        <th style="width: 35%;">Nama Item & Bentuk</th>
                        <th style="width: 15%;">Harga Satuan</th>
                        <th style="width: 15%; text-align: center;">Jumlah (Qty)</th>
                        <th style="width: 15%; text-align: right;">Subtotal</th>
                        <th style="width: 5%; text-align: center;"></th>
                    </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                    <tr id="emptyTableRow">
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt fs-1 d-block opacity-25 mb-2"></i>
                            <span class="fw-medium">Belum ada obat dalam nota transaksi saat ini.</span>
                            <small class="d-block text-muted opacity-75">Ketik nama obat pada kolom pencarian di atas untuk memasukkan item.</small>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="shortcut-bar">
            <span><span class="key-badge">/</span> Cari Obat</span>
            <span><span class="key-badge">F8</span> Kosongkan Nota</span>
            <span><span class="key-badge">F9</span> Selesaikan Transaksi</span>
            <span class="ms-auto text-dark fw-semibold" id="tableItemCounter">0 Baris Item</span>
        </div>
    </section>

    <aside class="panel-right">
        <div class="panel-section">
            <label class="form-label text-muted fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">TIPE PASIEN</label>
            <div class="segmented-selector mb-1">
                <input type="radio" name="patient_type" id="pasien-umum" value="Umum" checked onchange="updatePaymentVisibility()">
                <label for="pasien-umum">Pasien Umum</label>

                <input type="radio" name="patient_type" id="pasien-blu" value="BLU" onchange="updatePaymentVisibility()">
                <label for="pasien-blu">Sivitas BLU USD</label>
            </div>

            <div class="smooth-accordion" id="bluExpandableArea">
                <div class="expandable-box">
                    <label class="form-label small fw-semibold text-muted mb-1" style="font-size: 0.75rem;">NIM / NIP</label>
                    <input type="text" class="form-control form-control-sm border-1" id="nimNipInput" placeholder="Masukkan NIM / NIP">
                </div>
            </div>

            <label class="form-label text-muted fw-bold mb-1 mt-3" style="font-size: 0.7rem; letter-spacing: 0.5px;">STATUS RESEP</label>
            <div class="segmented-selector mb-1">
                <input type="radio" name="recipe_type" id="resep-non" value="Non-Resep" checked onchange="toggleRecipeType()">
                <label for="resep-non">Tanpa Resep</label>

                <input type="radio" name="recipe_type" id="resep-ada" value="Resep" onchange="toggleRecipeType()">
                <label for="resep-ada">Resep Dokter</label>
            </div>

            <div class="smooth-accordion" id="recipeExpandableArea">
                <div class="expandable-box">
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1" style="font-size: 0.72rem;">Nomor Resep</label>
                            <input type="text" class="form-control form-control-sm border-1" id="recipeNoInput" placeholder="No. Resep">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1" style="font-size: 0.72rem;">Tanggal Resep</label>
                            <input type="date" class="form-control form-control-sm border-1" id="recipeDateInput" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted mb-1" style="font-size: 0.72rem;">Nama Dokter Penulis</label>
                        <input type="text" class="form-control form-control-sm border-1" id="doctorNameInput" placeholder="Contoh: dr. Budi Santoso">
                    </div>
                    <div>
                        <label class="form-label small fw-semibold text-muted mb-1" style="font-size: 0.72rem;">Nama Klinik / RS</label>
                        <input type="text" class="form-control form-control-sm border-1" id="clinicNameInput" placeholder="Contoh: RS Panti Rapih">
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
                    <label class="form-label text-muted fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">METODE BAYAR</label>
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
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold mb-1">Uang Diterima dari Pembeli</label>
                        <div class="cash-input-group">
                            <span class="cash-prefix">Rp</span>
                            <input
                                type="number"
                                class="cash-input"
                                id="cashReceivedInput"
                                placeholder="0"
                                autocomplete="off"
                            >
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center p-2 px-3 rounded-3 bg-light border">
                        <span class="text-muted small fw-semibold">Uang Kembalian:</span>
                        <span class="fw-bold text-success fs-6" id="changeAmountDisplay">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="pt-3">
                <button class="btn-pay" id="btnCompletePayment">
                    Selesaikan Transaksi
                </button>
            </div>
        </div>
    </aside>
</main>

<script>
    const masterObatList = @json($obatList);

    let activeTransaction = [];
    let grandTotal = 0;

    const formatRupiah = (val) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(val);
    };

    const searchInput = document.getElementById('medicineSearchInput');
    const searchDropdown = document.getElementById('searchResults');
    const tableBody = document.getElementById('transactionTableBody');
    const emptyRow = document.getElementById('emptyTableRow');
    const cashInput = document.getElementById('cashReceivedInput');

    function updateHeaderClock() {
        const now = new Date();
        document.getElementById('headerLiveClock').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
    }
    setInterval(updateHeaderClock, 1000);
    updateHeaderClock();

    function toggleRecipeType() {
        const isRecipe = document.getElementById('resep-ada').checked;
        const recipeArea = document.getElementById('recipeExpandableArea');
        recipeArea.classList.toggle('active', isRecipe);
    }

    function updatePaymentVisibility() {
        const isBlu = document.getElementById('pasien-blu').checked;
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked')?.value || 'Cash';

        const paymentSection = document.getElementById('paymentMethodSection');
        const cashArea = document.getElementById('cashCalcArea');
        const bluExpandable = document.getElementById('bluExpandableArea');

        bluExpandable.classList.toggle('active', isBlu);

        if (isBlu) {
            paymentSection.classList.remove('active');
            cashArea.classList.remove('active');
            document.getElementById('totalLabelText').innerText = 'Nilai Penjaminan BLU';
        } else {
            paymentSection.classList.add('active');
            document.getElementById('totalLabelText').innerText = 'Total Tagihan';
            cashArea.classList.toggle('active', selectedPayment === 'Cash');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updatePaymentVisibility();
        toggleRecipeType();
    });

    searchInput.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        searchDropdown.innerHTML = '';

        if (query.length === 0) {
            searchDropdown.style.display = 'none';
            return;
        }

        const filtered = masterObatList.filter(o =>
            o.nama_obat.toLowerCase().includes(query) ||
            o.sku.toLowerCase().includes(query)
        );

        if (filtered.length > 0) {
            filtered.forEach(obat => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'search-item';
                itemDiv.innerHTML = `
                    <div>
                        <span class="fw-bold text-dark d-block">${obat.nama_obat}</span>
                        <small class="text-muted font-monospace">${obat.sku} • ${obat.jenis_obat}</small>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold text-dark d-block" style="color: #8B0000 !important;">${formatRupiah(obat.harga_obat)}</span>
                        <small class="badge ${obat.stok <= obat.batas_minimum ? 'bg-warning-subtle text-warning-emphasis' : 'bg-success-subtle text-success'} rounded-pill">
                            Stok: ${obat.stok}
                        </small>
                    </div>
                `;
                itemDiv.onclick = () => {
                    addItemToTransaction(obat);
                    searchInput.value = '';
                    searchDropdown.style.display = 'none';
                    searchInput.focus();
                };
                searchDropdown.appendChild(itemDiv);
            });
            searchDropdown.style.display = 'block';
        } else {
            searchDropdown.innerHTML = `<div class="p-3 text-center text-muted small">Obat tidak ditemukan.</div>`;
            searchDropdown.style.display = 'block';
        }
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.search-container')) {
            searchDropdown.style.display = 'none';
        }
    });

    function addItemToTransaction(obat) {
        if (obat.stok <= 0) {
            alert('Maaf, stok obat ini sudah habis!');
            return;
        }

        const exist = activeTransaction.find(item => item.id_obat === obat.id_obat);
        if (exist) {
            if (exist.qty < obat.stok) {
                exist.qty += 1;
            } else {
                alert('Maksimal stok yang tersedia sudah tercapai!');
            }
        } else {
            activeTransaction.push({
                id_obat: obat.id_obat,
                sku: obat.sku,
                nama: obat.nama_obat,
                jenis: obat.jenis_obat,
                harga: parseFloat(obat.harga_obat),
                qty: 1,
                max_stok: obat.stok
            });
        }
        renderTable();
    }

    function renderTable() {
        tableBody.innerHTML = '';
        grandTotal = 0;

        if (activeTransaction.length === 0) {
            tableBody.appendChild(emptyRow);
            document.getElementById('tableItemCounter').innerText = '0 Baris Item';
            updateTotals();
            return;
        }

        activeTransaction.forEach((item, index) => {
            const subtotal = item.harga * item.qty;
            grandTotal += subtotal;

            const tr = document.createElement('tr');
            tr.className = 'animate-row';
            tr.innerHTML = `
                <td class="text-muted fw-bold">${index + 1}</td>
                <td><span class="font-monospace text-muted small">${item.sku}</span></td>
                <td>
                    <span class="fw-bold text-dark d-block">${item.nama}</span>
                    <small class="text-muted" style="font-size: 0.75rem;">${item.jenis}</small>
                </td>
                <td class="fw-medium">${formatRupiah(item.harga)}</td>
                <td class="text-center">
                    <div class="d-inline-flex align-items-center gap-2">
                        <button class="table-qty-btn" onclick="updateItemQty(${index}, -1)"><i class="bi bi-dash"></i></button>
                        <span class="fw-bold px-1" style="min-width: 22px;">${item.qty}</span>
                        <button class="table-qty-btn" onclick="updateItemQty(${index}, 1)"><i class="bi bi-plus"></i></button>
                    </div>
                </td>
                <td class="text-end fw-bold text-dark">${formatRupiah(subtotal)}</td>
                <td class="text-center">
                    <button class="btn btn-sm text-danger border-0 p-1" onclick="removeItem(${index})" title="Hapus Baris">
                        <i class="bi bi-x-circle fs-6"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(tr);
        });

        document.getElementById('tableItemCounter').innerText = `${activeTransaction.length} Baris Item`;
        updateTotals();
    }

    function updateItemQty(index, delta) {
        const item = activeTransaction[index];
        const newQty = item.qty + delta;
        if (newQty > 0 && newQty <= item.max_stok) {
            item.qty = newQty;
        } else if (newQty === 0) {
            removeItem(index);
            return;
        } else if (newQty > item.max_stok) {
            alert('Maksimal stok tercapai!');
        }
        renderTable();
    }

    function removeItem(index) {
        activeTransaction.splice(index, 1);
        renderTable();
    }

    function clearTransaction() {
        if (activeTransaction.length > 0 && confirm('Kosongkan semua data transaksi saat ini?')) {
            activeTransaction = [];
            renderTable();
        }
    }

    function updateTotals() {
        document.getElementById('grandTotalDisplay').innerText = formatRupiah(grandTotal);
        calculateChange();
    }

    function calculateChange() {
        const received = parseFloat(cashInput.value) || 0;
        const change = received - grandTotal;
        const changeDisplay = document.getElementById('changeAmountDisplay');

        if (received >= grandTotal && grandTotal > 0) {
            changeDisplay.innerText = formatRupiah(change);
            changeDisplay.className = 'fw-bold text-success fs-6';
        } else if (received > 0 && received < grandTotal) {
            changeDisplay.innerText = 'Kurang ' + formatRupiah(Math.abs(change));
            changeDisplay.className = 'fw-bold text-danger fs-6';
        } else {
            changeDisplay.innerText = 'Rp 0';
            changeDisplay.className = 'fw-bold text-muted fs-6';
        }
    }

    cashInput.addEventListener('input', calculateChange);

    document.addEventListener('keydown', function(e) {
        if (e.key === '/' && document.activeElement !== searchInput && document.activeElement !== cashInput) {
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

    document.getElementById('btnCompletePayment').addEventListener('click', async function() {
        // 1. Validasi Keranjang Kosong
        if (activeTransaction.length === 0) {
            alert('Belum ada obat yang dimasukkan ke dalam nota transaksi!');
            return;
        }

        // 2. Ambil semua data dari formulir di layar
        const patientType = document.querySelector('input[name="patient_type"]:checked').value;
        const recipeType = document.querySelector('input[name="recipe_type"]:checked').value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value || 'Cash';

        let cashReceived = 0;
        let changeAmount = 0;

        // 3. Logika Uang Tunai vs Non-Tunai/BLU
        if (patientType === 'Umum' && paymentMethod === 'Cash') {
            cashReceived = parseFloat(cashInput.value) || 0;
            changeAmount = cashReceived - grandTotal;

            if (cashReceived < grandTotal) {
                alert('Maaf, nominal uang tunai yang diterima kurang dari total tagihan!');
                cashInput.focus();
                return;
            }
        } else {
            // Jika QRIS/Transfer atau Pasien BLU, uang dianggap PAS
            cashReceived = grandTotal;
            changeAmount = 0;
        }

        // 4. Ubah tombol jadi "Loading" agar kasir tidak klik 2 kali
        const btn = this;
        const originalBtnHTML = btn.innerHTML;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...`;
        btn.disabled = true;

        // 5. Susun paket data (Payload) untuk dikirim ke Backend
        const payload = {
            cart: activeTransaction,
            patient_type: patientType,
            nim_nip: document.getElementById('nimNipInput').value,
            recipe_type: recipeType,
            recipe_no: document.getElementById('recipeNoInput').value,
            recipe_date: document.getElementById('recipeDateInput').value,
            doctor_name: document.getElementById('doctorNameInput').value,
            clinic_name: document.getElementById('clinicNameInput').value,
            payment_method: paymentMethod,
            grand_total: grandTotal,
            cash_received: cashReceived,
            change_amount: changeAmount
        };

        // 6. Tembakkan ke Controller menggunakan Fetch API (AJAX)
        try {
            const response = await fetch("{{ route('transaksi.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Kunci Keamanan
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (response.ok && result.success) {

                let successMsg = result.message;
                if(result.status_transaksi === 'Pending') {
                    successMsg += '\n(Resep dikirim ke Apoteker untuk validasi)';
                }
                alert(successMsg);

                const strukUrl = `/transaksi/${result.id_transaksi}/struk`;
                window.open(strukUrl, 'StrukWindow', 'width=350,height=600,scrollbars=yes');

                // 3. Refresh halaman untuk transaksi berikutnya
                window.location.reload();
            } else {
                alert('Gagal memproses transaksi: ' + (result.message || 'Error tidak diketahui'));
                btn.innerHTML = originalBtnHTML;
                btn.disabled = false;
            }
        } catch (error) {
            console.error(error);
            alert('Gagal menghubungi server. Pastikan koneksi stabil.');
            btn.innerHTML = originalBtnHTML;
            btn.disabled = false;
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
