<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Obat - Apotek USD</title>
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

        * { box-sizing: border-box; }
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

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }

        @keyframes pageEntrance {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
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
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-avatar {
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

        .nav-segmented {
            display: flex;
            background: #e2e8f0;
            border-radius: 10px;
            padding: 3px;
            gap: 3px;
        }
        .nav-segmented a {
            text-decoration: none;
            padding: 6px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 8px;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-segmented a:hover { color: var(--text-dark); }
        .nav-segmented a.active {
            background: var(--maroon);
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(139, 0, 0, 0.2);
        }

        .main-workspace {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 1rem 1.5rem;
            gap: 0.85rem;
            animation: pageEntrance 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .toolbar-card {
            background: var(--surface);
            border-radius: 14px;
            padding: 0.75rem 1.25rem;
            border: 1px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .search-field {
            position: relative;
            flex: 1;
            max-width: 450px;
        }
        .search-field i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        .search-field input {
            width: 100%;
            padding: 0.55rem 1rem 0.55rem 2.4rem;
            border-radius: 10px;
            border: 1.5px solid var(--border-soft);
            outline: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .search-field input:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.08);
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
        .table-wrapper { flex: 1; overflow-y: auto; }
        .table-custom { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .table-custom thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.72rem;
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
            padding: 0.85rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.88rem;
        }
        .table-custom tbody tr:hover td { background-color: #fafbfc; }

        .btn-maroon {
            background: var(--maroon);
            color: #ffffff;
            border: none;
            padding: 0.55rem 1.15rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-maroon:hover {
            background: var(--maroon-dark);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid var(--border-soft);
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            transition: all 0.15s;
        }
        .btn-action-icon:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }
        .btn-action-icon.delete:hover {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        .modal-content {
            border-radius: 18px;
            border: 1px solid var(--border-soft);
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
        }
        .modal-body {
            padding: 1.5rem;
        }
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-soft);
        }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="d-flex align-items-center gap-3">
        <div class="user-info">
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="fw-bold text-dark fs-6">{{ Auth::user()->nama_pengguna ?? 'Apoteker' }}</div>
        </div>

        <nav class="nav-segmented ms-2">
            <a href="{{ route('apoteker.dashboard') }}">Dashboard Validasi</a>
            <a href="{{ route('apoteker.obat.index') }}" class="active">Katalog Obat</a>
        </nav>
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

<main class="main-workspace">

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 py-2 px-3 mb-0" style="border-radius: 10px;">
            <i class="bi bi-check-circle-fill"></i>
            <div class="small fw-semibold">{{ session('success') }}</div>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-2 py-2 px-3 mb-0" style="border-radius: 10px;">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div class="small fw-semibold">{{ $errors->first() }}</div>
        </div>
    @endif

    <div class="toolbar-card">
        <form method="GET" action="{{ route('apoteker.obat.index') }}" class="d-flex align-items-center gap-2 flex-grow-1">
            <div class="search-field">
                <i class="bi bi-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama obat, SKU, atau kategori..." autocomplete="off">
            </div>

            <select name="kategori" class="form-select form-select-sm" style="width: auto; border-radius: 10px;" onchange="this.form.submit()">
                <option value="Semua">Semua Kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
        </form>

        <button class="btn-maroon" data-bs-toggle="modal" data-bs-target="#modalTambahObat">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Obat</span>
        </button>
    </div>

    <div class="table-card">
        <div class="table-wrapper">
            <table class="table-custom">
                <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 12%;">Kode / SKU</th>
                    <th style="width: 28%;">Nama Obat</th>
                    <th style="width: 15%;">Kategori & Kemasan</th>
                    <th style="width: 10%; text-align: center;">Stok</th>
                    <th style="width: 12%;">Harga Satuan</th>
                    <th style="width: 10%;">Kedaluwarsa</th>
                    <th style="width: 8%; text-align: center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($obatList as $index => $obat)
                    <tr>
                        <td class="text-muted fw-bold">{{ $obatList->firstItem() + $index }}</td>
                        <td><span class="font-monospace text-muted small fw-bold">{{ $obat->sku }}</span></td>
                        <td>
                            <span class="fw-bold text-dark d-block">{{ $obat->nama_obat }}</span>
                            <small class="text-muted" style="font-size: 0.72rem;">Min. Stok: {{ $obat->batas_minimum }} unit</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border mb-1">{{ $obat->kategori }}</span>
                            <small class="d-block text-muted" style="font-size: 0.75rem;">{{ $obat->jenis_obat }}</small>
                        </td>
                        <td class="text-center">
                            @if($obat->stok <= $obat->batas_minimum)
                                <span class="badge bg-danger-subtle text-danger fw-bold rounded-pill px-2.5 py-1">
                                    {{ $obat->stok }} (Kritis)
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success fw-bold rounded-pill px-2.5 py-1">
                                    {{ $obat->stok }}
                                </span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">
                            Rp {{ number_format($obat->harga_obat, 0, ',', '.') }}
                        </td>
                        <td class="text-muted small">
                            {{ date('d M Y', strtotime($obat->tanggal_kadaluwarsa)) }}
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex gap-1">
                                <button class="btn-action-icon" title="Edit Data" onclick="openEditModal({{ json_encode($obat) }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('apoteker.obat.destroy', $obat->id_obat) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus obat ini dari sistem?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-icon delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-capsule fs-1 d-block opacity-25 mb-2"></i>
                            <span class="fw-medium">Belum ada data obat yang sesuai pencarian.</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 border-top d-flex justify-content-between align-items-center bg-white" style="font-size: 0.8rem;">
            <span class="text-muted">Menampilkan {{ $obatList->firstItem() ?? 0 }} - {{ $obatList->lastItem() ?? 0 }} dari {{ $obatList->total() }} total item</span>
            <div>{{ $obatList->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>

</main>

<div class="modal fade" id="modalTambahObat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold text-dark">Tambah Data Obat Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('apoteker.obat.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Kode / SKU</label>
                            <input type="text" class="form-control form-control-sm" name="sku" placeholder="Contoh: AMO-500" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Kategori</label>
                            <input type="text" class="form-control form-control-sm" name="kategori" placeholder="Contoh: Antibiotik" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold text-muted mb-1">Nama Lengkap Obat</label>
                            <input type="text" class="form-control form-control-sm" name="nama_obat" placeholder="Contoh: Amoxicillin 500mg" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold text-muted mb-1">Kemasan / Bentuk Sediaan</label>
                            <input type="text" class="form-control form-control-sm" name="jenis_obat" placeholder="Contoh: Strip (12 Kapsul) / Botol 60ml" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Stok Awal</label>
                            <input type="number" class="form-control form-control-sm" name="stok" placeholder="0" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Batas Minimum (Defecta)</label>
                            <input type="number" class="form-control form-control-sm" name="batas_minimum" value="10" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Harga Satuan (Rp)</label>
                            <input type="number" class="form-control form-control-sm" name="harga_obat" placeholder="Contoh: 18000" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Tanggal Kedaluwarsa</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_kadaluwarsa" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-maroon">Simpan Obat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditObat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold text-dark">Perbarui Data Obat</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditObat" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Kode / SKU</label>
                            <input type="text" class="form-control form-control-sm" id="edit_sku" name="sku" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Kategori</label>
                            <input type="text" class="form-control form-control-sm" id="edit_kategori" name="kategori" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold text-muted mb-1">Nama Lengkap Obat</label>
                            <input type="text" class="form-control form-control-sm" id="edit_nama_obat" name="nama_obat" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold text-muted mb-1">Kemasan / Bentuk Sediaan</label>
                            <input type="text" class="form-control form-control-sm" id="edit_jenis_obat" name="jenis_obat" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Stok Tersedia</label>
                            <input type="number" class="form-control form-control-sm" id="edit_stok" name="stok" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Batas Minimum (Defecta)</label>
                            <input type="number" class="form-control form-control-sm" id="edit_batas_minimum" name="batas_minimum" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Harga Satuan (Rp)</label>
                            <input type="number" class="form-control form-control-sm" id="edit_harga_obat" name="harga_obat" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Tanggal Kedaluwarsa</label>
                            <input type="date" class="form-control form-control-sm" id="edit_tanggal_kadaluwarsa" name="tanggal_kadaluwarsa" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-maroon">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateHeaderClock() {
        const now = new Date();
        document.getElementById('headerLiveClock').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
    }
    setInterval(updateHeaderClock, 1000);
    updateHeaderClock();

    function openEditModal(obat) {
        document.getElementById('edit_sku').value = obat.sku;
        document.getElementById('edit_kategori').value = obat.kategori;
        document.getElementById('edit_nama_obat').value = obat.nama_obat;
        document.getElementById('edit_jenis_obat').value = obat.jenis_obat;
        document.getElementById('edit_stok').value = obat.stok;
        document.getElementById('edit_batas_minimum').value = obat.batas_minimum;
        document.getElementById('edit_harga_obat').value = parseInt(obat.harga_obat);
        document.getElementById('edit_tanggal_kadaluwarsa').value = obat.tanggal_kadaluwarsa;

        document.getElementById('formEditObat').action = `/apoteker/obat/${obat.id_obat}`;

        new bootstrap.Modal(document.getElementById('modalEditObat')).show();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
