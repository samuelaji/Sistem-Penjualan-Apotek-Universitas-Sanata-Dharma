<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk &amp; Inventaris - Apotek USD</title>
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
            --maroon-soft: rgba(139, 0, 0, 0.08);
            --text-dark: #0f172a;
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
            margin: 0;
            display: flex;
            flex-direction: column;
            font-size: 16px;
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }

        @keyframes pageEntrance {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ---------- Header ---------- */
        .pos-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0.85rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
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

        /* ---------- Area Kerja Utama ---------- */
        .main-workspace {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            padding: 0.85rem 1.15rem;
            width: 100%;
            overflow: hidden;
            min-height: 0;
            animation: pageEntrance 0.35s var(--ease-out) forwards;
        }

        /* ---------- Toolbar Pencarian & Filter ---------- */
        .toolbar-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 0.75rem 1.15rem;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            flex-wrap: wrap;
            flex-shrink: 0;
        }

        .filter-left-group {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex: 1;
            min-width: 280px;
            flex-wrap: wrap;
        }

        .search-field {
            position: relative;
            flex: 1;
            min-width: 240px;
            max-width: 420px;
        }
        .search-field > i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.96rem;
            pointer-events: none;
        }
        .search-field input {
            width: 100%;
            padding: 0.54rem 2.2rem 0.54rem 2.45rem;
            border-radius: 9px;
            border: 1.5px solid var(--border-soft);
            outline: none;
            font-size: 0.92rem;
            background: #ffffff;
            transition: all 0.2s ease;
        }
        .search-field input:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }
        .btn-clear-search {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--text-muted);
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .btn-clear-search:hover {
            background: #e2e8f0;
            color: var(--text-dark);
        }

        .btn-maroon-sm {
            background: var(--maroon);
            color: #ffffff;
            border: none;
            padding: 0.54rem 1.05rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.15s ease;
            white-space: nowrap;
        }
        .btn-maroon-sm:hover {
            background: var(--maroon-dark);
            color: #ffffff;
        }

        .category-select {
            border-radius: 9px;
            border: 1.5px solid var(--border-soft);
            background-color: #ffffff;
            padding: 0.54rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .category-select:focus {
            border-color: var(--maroon);
            outline: none;
            box-shadow: 0 0 0 3px var(--maroon-soft);
        }

        .btn-soft-sm {
            background: #ffffff;
            color: var(--text-dark);
            border: 1.5px solid var(--border-soft);
            padding: 0.54rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
            white-space: nowrap;
        }
        .btn-soft-sm:hover {
            background: #f8fafc;
            border-color: var(--maroon);
            color: var(--maroon);
        }

        /* ---------- Kartu Tabel Penuh ---------- */
        .table-card {
            flex: 1;
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-height: 0;
            transition: opacity 0.15s ease;
        }
        .table-card.is-loading tbody {
            opacity: 0.55;
            pointer-events: none;
        }

        .table-wrapper {
            flex: 1;
            overflow: auto;
        }

        .table-custom {
            width: 100%;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 920px;
        }
        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.84rem;
            font-weight: 700;
            padding: 0.85rem 1.25rem;
            border-bottom: 1.5px solid var(--border-soft);
            position: sticky;
            top: 0;
            z-index: 5;
            white-space: nowrap;
        }
        .table-custom tbody td {
            padding: 0.9rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.94rem;
            transition: background-color 0.15s ease;
        }
        .table-custom tbody tr:last-child td { border-bottom: none; }
        .table-custom tbody tr:hover td { background-color: #fafbfc; }

        .sku-code {
            font-size: 0.88rem;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
        }
        .unit-label {
            font-size: 0.84rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ---------- Footer & Pagination Kompak ---------- */
        .table-footer {
            padding: 0.65rem 1.25rem;
            border-top: 1px solid var(--border-soft);
            background: #ffffff;
            font-size: 0.86rem;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .pagination-wrap nav > div.d-flex.justify-content-between.flex-fill.d-sm-none {
            display: none !important;
        }
        .pagination-wrap nav > div.d-none.flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between > div:first-child {
            display: none !important;
        }
        .pagination-wrap nav > div.d-none.flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between {
            justify-content: flex-end !important;
        }
        .pagination-wrap .pagination {
            margin: 0;
            gap: 3px;
            flex-wrap: nowrap;
        }
        .pagination-wrap .page-item .page-link {
            padding: 0.32rem 0.62rem;
            font-size: 0.82rem;
            font-weight: 600;
            line-height: 1.2;
            color: var(--text-dark);
            background-color: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 7px;
            font-variant-numeric: tabular-nums;
            transition: all 0.15s ease;
        }
        .pagination-wrap .page-item:first-child .page-link,
        .pagination-wrap .page-item:last-child .page-link {
            border-radius: 7px;
        }
        .pagination-wrap .page-item .page-link:hover {
            background-color: #f8fafc;
            border-color: var(--maroon);
            color: var(--maroon);
        }
        .pagination-wrap .page-item.active .page-link {
            background-color: var(--maroon);
            border-color: var(--maroon);
            color: #ffffff;
        }
        .pagination-wrap .page-item.disabled .page-link {
            color: #94a3b8;
            background-color: #f8fafc;
            border-color: var(--border-soft);
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-4">
        <div class="user-identity">
            <span class="user-name">{{ Auth::user()->nama_pengguna ?? 'Manajemen' }}</span>
            <span class="user-id">{{ Auth::user()->username ?? 'manajemen' }}</span>
        </div>

        <nav class="nav-segmented ms-2 d-none d-md-flex">
            <a href="{{ route('manajemen.dashboard') }}">Analitik Bisnis</a>
            <a href="{{ route('manajemen.inventaris') }}" class="active">Laporan Inventaris</a>
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

<main class="main-workspace">

    <div class="toolbar-card">
        <form method="GET" action="{{ route('manajemen.inventaris') }}" id="filterInventarisForm" class="filter-left-group">
            <div class="search-field">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInventarisInput" name="search" value="{{ request('search') }}" placeholder="Cari nama obat, SKU, atau kategori..." autocomplete="off">
                <button type="button" id="btnClearInventarisSearch" class="btn-clear-search {{ request('search') ? '' : 'd-none' }}" title="Hapus pencarian" aria-label="Hapus pencarian">
                    <i class="bi bi-x-lg" style="font-size: 0.78rem;"></i>
                </button>
            </div>

            <button type="submit" class="btn-maroon-sm" id="btnSearchInventaris">Cari</button>

            <select name="kategori" id="kategoriInventarisSelect" class="category-select" aria-label="Filter Kategori">
                <option value="Semua">Semua Kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ ucfirst($kat) }}</option>
                @endforeach
            </select>
        </form>

        <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" id="btnExportCsv" class="btn-soft-sm text-decoration-none">
            <i class="bi bi-download"></i>
            <span>Ekspor CSV</span>
        </a>
    </div>

    <div class="table-card" id="inventarisTableCard">
        <div class="table-wrapper">
            <table class="table-custom">
                <thead>
                <tr>
                    <th style="width: 6%;">No.</th>
                    <th style="width: 12%;">Kode SKU</th>
                    <th style="width: 24%;">Nama Obat</th>
                    <th style="width: 13%;">Kategori</th>
                    <th style="width: 11%; text-align: center;">Total Terjual</th>
                    <th style="width: 10%; text-align: center;">Sisa Stok</th>
                    <th style="width: 12%; text-align: right;">Harga Satuan</th>
                    <th style="width: 12%; text-align: right;">Nilai Aset</th>
                </tr>
                </thead>
                <tbody id="inventarisTableBody">
                @forelse($obatList as $index => $obat)
                    @php
                        $nomorUrut = method_exists($obatList, 'firstItem') && $obatList->firstItem()
                            ? $obatList->firstItem() + $index
                            : $index + 1;
                    @endphp
                    <tr>
                        <td class="text-muted fw-semibold" style="font-variant-numeric: tabular-nums;">{{ $nomorUrut }}</td>
                        <td><span class="font-monospace sku-code">{{ $obat->sku }}</span></td>
                        <td class="fw-bold text-dark">{{ $obat->nama_obat }}</td>
                        <td><span class="text-dark fw-medium text-capitalize">{{ $obat->kategori }}</span></td>
                        <td class="text-center" style="font-variant-numeric: tabular-nums;">
                            <span class="fw-bold text-dark">{{ $obat->total_terjual ?? 0 }}</span>
                            <span class="unit-label">unit</span>
                        </td>
                        <td class="text-center" style="font-variant-numeric: tabular-nums;">
                            <span class="fw-bold text-dark">{{ $obat->stok }}</span>
                            <span class="unit-label">unit</span>
                        </td>
                        <td class="text-end fw-medium text-dark" style="font-variant-numeric: tabular-nums;">Rp {{ number_format($obat->harga_obat, 0, ',', '.') }}</td>
                        <td class="text-end fw-bold text-dark" style="font-variant-numeric: tabular-nums;">
                            Rp {{ number_format($obat->stok * $obat->harga_obat, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block opacity-25 mb-2"></i>
                            <span class="fw-medium" style="font-size: 0.92rem;">Tidak ada data obat ditemukan.</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer" id="inventarisTableFooter">
            @if(method_exists($obatList, 'total'))
                <span style="font-variant-numeric: tabular-nums;">Menampilkan {{ $obatList->firstItem() ?? 0 }}–{{ $obatList->lastItem() ?? 0 }} dari {{ $obatList->total() }} data</span>
            @else
                <span style="font-variant-numeric: tabular-nums;">Menampilkan {{ count($obatList) }} data</span>
            @endif

            @if(method_exists($obatList, 'hasPages') && $obatList->hasPages())
                <div class="pagination-wrap">{{ $obatList->withQueryString()->links('pagination::bootstrap-5') }}</div>
            @endif
        </div>
    </div>

</main>

<script>
    (function () {
        'use strict';

        const clockEl = document.getElementById('headerLiveClock');
        function updateClock() {
            clockEl.textContent = new Date().toLocaleTimeString('en-GB', {
                timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', hour12: false
            }) + ' WIB';
        }
        updateClock();
        setInterval(updateClock, 1000);

        const filterForm = document.getElementById('filterInventarisForm');
        const searchInput = document.getElementById('searchInventarisInput');
        const btnClearSearch = document.getElementById('btnClearInventarisSearch');
        const kategoriSelect = document.getElementById('kategoriInventarisSelect');
        const btnExportCsv = document.getElementById('btnExportCsv');
        const tableCard = document.getElementById('inventarisTableCard');
        const tableBody = document.getElementById('inventarisTableBody');
        const tableFooter = document.getElementById('inventarisTableFooter');

        let searchTimer = null;
        let activeController = null;

        function toggleClearButton() {
            if (!searchInput || !btnClearSearch) return;
            btnClearSearch.classList.toggle('d-none', searchInput.value.trim() === '');
        }

        function buildFilterUrl(baseTarget) {
            const url = new URL(baseTarget || filterForm.action, window.location.origin);
            const keyword = searchInput ? searchInput.value.trim() : '';
            const kategori = kategoriSelect ? kategoriSelect.value : 'Semua';

            url.searchParams.delete('search');
            url.searchParams.delete('kategori');
            url.searchParams.delete('page');

            if (keyword !== '') url.searchParams.set('search', keyword);
            if (kategori && kategori !== 'Semua') url.searchParams.set('kategori', kategori);
            return url;
        }

        function syncExportLink() {
            if (!btnExportCsv) return;
            const exportUrl = buildFilterUrl(filterForm.action);
            exportUrl.searchParams.set('export', 'csv');
            btnExportCsv.href = exportUrl.toString();
        }

        async function fetchFilteredInventaris(targetUrl = null) {
            if (!filterForm || !tableCard || !tableBody || !tableFooter) return;
            if (activeController) activeController.abort();
            activeController = new AbortController();

            const url = targetUrl ? new URL(targetUrl, window.location.origin) : buildFilterUrl(filterForm.action);
            tableCard.classList.add('is-loading');

            try {
                const response = await fetch(url.toString(), {
                    signal: activeController.signal,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) throw new Error('Network response was not ok');

                const html = await response.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const newBody = doc.getElementById('inventarisTableBody');
                const newFooter = doc.getElementById('inventarisTableFooter');

                if (newBody && newFooter) {
                    tableBody.innerHTML = newBody.innerHTML;
                    tableFooter.innerHTML = newFooter.innerHTML;
                    window.history.replaceState(null, '', url.toString());
                    syncExportLink();
                } else {
                    window.location.assign(url.toString());
                }
            } catch (err) {
                if (err.name === 'AbortError') return;
                window.location.assign(url.toString());
            } finally {
                tableCard.classList.remove('is-loading');
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', () => {
                toggleClearButton();
                syncExportLink();
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => fetchFilteredInventaris(), 300);
            });
        }

        if (btnClearSearch && searchInput) {
            btnClearSearch.addEventListener('click', () => {
                searchInput.value = '';
                toggleClearButton();
                syncExportLink();
                clearTimeout(searchTimer);
                searchInput.focus();
                fetchFilteredInventaris();
            });
        }

        if (kategoriSelect) {
            kategoriSelect.addEventListener('change', () => {
                syncExportLink();
                clearTimeout(searchTimer);
                fetchFilteredInventaris();
            });
        }

        if (filterForm) {
            filterForm.addEventListener('submit', e => {
                e.preventDefault();
                syncExportLink();
                clearTimeout(searchTimer);
                fetchFilteredInventaris();
            });
        }

        if (tableFooter) {
            tableFooter.addEventListener('click', e => {
                const link = e.target.closest('.pagination-wrap a.page-link');
                if (!link || !link.href) return;
                e.preventDefault();
                clearTimeout(searchTimer);
                fetchFilteredInventaris(link.href);
            });
        }

        syncExportLink();
    })();
</script>

</body>
</html>
