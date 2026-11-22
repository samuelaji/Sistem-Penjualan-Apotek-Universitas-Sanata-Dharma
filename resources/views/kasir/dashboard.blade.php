<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - Apotek USD</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-workspace: #f8fafc;
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
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Hilangkan spinner number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }

        @keyframes pageEntrance {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- TOPBAR --- */
        .pos-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 20;
        }
        .user-info { display: flex; align-items: center; gap: 10px; }
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

        /* --- WORKSPACE FULL WIDTH --- */
        .main-workspace {
            flex: 1;
            padding: 2rem;
            animation: pageEntrance 0.3s ease forwards;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* --- CLEAN CARDS --- */
        .clean-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 4px 20px -4px rgba(15, 23, 42, 0.02);
            display: flex;
            flex-direction: column;
        }
        .clean-card-danger {
            background: #fffafa;
            border: 1px solid #fee2e2;
        }

        .label-sm {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--text-muted);
            display: block;
            margin-bottom: 0.5rem;
        }
        .value-lg {
            font-size: 2.25rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -1px;
            color: var(--text-dark);
        }

        /* --- INPUT UANG --- */
        .money-input-group {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            background: #ffffff;
            transition: all 0.2s ease;
            overflow: hidden;
        }
        .money-input-group:focus-within {
            border-color: var(--maroon);
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08);
        }
        .money-prefix {
            padding: 0.85rem 1.25rem;
            background: #f8fafc;
            border-right: 1px solid var(--border-soft);
            color: var(--text-muted);
            font-weight: 700;
            font-size: 1rem;
        }
        .money-input {
            border: none;
            outline: none;
            width: 100%;
            padding: 0.85rem 1.25rem;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-dark);
            background: transparent;
        }

        /* --- BUTTONS --- */
        .btn-maroon {
            background: var(--maroon);
            color: white;
            font-weight: 700;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            border: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.95rem;
        }
        .btn-maroon:hover { background: var(--maroon-dark); color: white; transform: translateY(-1px); }
        .btn-maroon:active { transform: translateY(0); }

        .btn-dark-modern {
            background: var(--text-dark);
            color: white;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-dark-modern:hover { background: #1e293b; color: white; }

        /* --- TABEL --- */
        .table-container {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            overflow: hidden;
        }
        .table-custom { width: 100%; margin: 0; border-collapse: separate; border-spacing: 0; }
        .table-custom th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-soft);
        }
        .table-custom td {
            padding: 1.1rem 1.5rem;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .table-custom tr:last-child td { border-bottom: none; }
        .table-custom tbody tr:hover { background-color: #fafbfc; }

        .empty-state { padding: 4rem 2rem; text-align: center; color: var(--text-muted); }
    </style>
</head>
<body>

<header class="pos-header">
    <div class="user-info">
        <div class="user-avatar"><i class="bi bi-person-fill"></i></div>
        <div class="fw-bold text-dark fs-6">{{ Auth::user()->nama_pengguna ?? 'Kasir' }}</div>
    </div>

    <div class="d-flex align-items-center gap-3">
        <span class="text-muted small fw-medium font-monospace" id="headerLiveClock">--:--:--</span>
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
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-4 rounded-3" style="background-color: #f0fdf4;">
            <i class="bi bi-check-circle-fill text-success"></i>
            <div class="small fw-semibold text-success">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-2 mb-4 rounded-3" style="background-color: #fef2f2;">
            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
            <div class="small fw-semibold text-danger">{{ session('error') }}</div>
        </div>
    @endif

    <!-- ================= KONDISI 1: SHIFT BELUM BUKA ================= -->
    @if(!$shiftAktif)
        <div class="d-flex flex-column align-items-center justify-content-center h-100" style="margin-top: 10vh;">
            <h2 class="fw-bold mb-2">Buka Shift Kasir</h2>
            <p class="text-muted mb-5">Masukkan nominal uang modal awal di laci kasir.</p>

            <div class="clean-card" style="width: 100%; max-width: 400px; padding: 2.5rem;">
                <form action="{{ route('kasir.shift.buka') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="label-sm">Uang Modal Awal</label>
                        <div class="money-input-group">
                            <span class="money-prefix">Rp</span>
                            <input type="number" name="saldo_awal" class="money-input" placeholder="0" required autofocus autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn-maroon w-100">Mulai Pelayanan</button>
                </form>
            </div>
        </div>

        <!-- ================= KONDISI 2: SHIFT AKTIF ================= -->
    @else
        <!-- Header Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
            <div>
                <h3 class="fw-bold mb-1">Dashboard Kasir</h3>
                <span class="text-muted small">Ringkasan operasional shift berjalan.</span>
            </div>
            <a href="{{ route('transaksi.index') }}" class="btn-dark-modern">
                Buka Terminal POS &rarr;
            </a>
        </div>

        <!-- ROW 1: Info Shift & Penutupan -->
        <div class="row g-4 mb-5">
            <!-- Informasi Shift -->
            <div class="col-lg-6">
                <div class="clean-card">
                    <span class="label-sm mb-4">Informasi Shift Aktif</span>

                    <div class="row g-4 mt-2">
                        <div class="col-6">
                            <span class="text-muted small fw-medium d-block mb-1">Waktu Buka</span>
                            <div class="value-lg">{{ \Carbon\Carbon::parse($shiftAktif->waktu_mulai)->format('H:i') }} <span class="fs-6 text-muted fw-normal">WIB</span></div>
                        </div>
                        <div class="col-6">
                            <span class="text-muted small fw-medium d-block mb-1">Modal Awal Laci</span>
                            <div class="value-lg" style="color: var(--maroon);">
                                <span class="fs-5 text-muted fw-normal">Rp</span> {{ number_format($shiftAktif->saldo_awal, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Tutup Laci -->
            <div class="col-lg-6">
                <div class="clean-card clean-card-danger">
                    <span class="label-sm mb-1 text-danger">Akhiri Shift & Tutup Laci</span>
                    <p class="text-muted small mb-4">Hitung total uang fisik tunai di laci saat ini untuk pencocokan buta (blind close).</p>

                    <form action="{{ route('kasir.shift.tutup') }}" method="POST" class="mt-auto">
                        @csrf
                        <div class="d-flex gap-3">
                            <div class="money-input-group flex-grow-1">
                                <span class="money-prefix">Rp</span>
                                <input type="number" name="uang_fisik" class="money-input" placeholder="0" required autocomplete="off">
                            </div>
                            <button type="submit" class="btn-maroon" onclick="return confirm('Sistem akan menutup shift Anda. Pastikan uang telah dihitung dengan akurat.')">
                                Tutup Shift
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ROW 2: Tabel Transaksi Terakhir -->
        <div>
            <span class="label-sm mb-3">5 Transaksi Terakhir</span>

            <div class="table-container">
                <table class="table-custom">
                    <thead>
                    <tr>
                        <th style="width: 15%;">Waktu</th>
                        <th style="width: 25%;">No. Nota</th>
                        <th style="width: 25%;">Ringkasan Item</th>
                        <th style="width: 20%;">Total Belanja</th>
                        <th style="width: 15%;">Metode</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transaksiTerakhir as $trx)
                        <tr>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('H:i') }}</td>
                            <td class="fw-bold font-monospace text-dark">TRX-{{ str_pad($trx->id_transaksi, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <span class="fw-medium text-dark">{{ $trx->detail_transaksi->count() }} jenis obat</span>
                            </td>
                            <td class="fw-bold text-maroon">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if($trx->metode_pembayaran == 'cash')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Tunai</span>
                                @else
                                    <span class="badge bg-light text-secondary border border-secondary-subtle rounded-pill px-2 text-uppercase">{{ $trx->metode_pembayaran }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <span class="fw-medium">Belum ada transaksi di shift ini.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</main>

<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('headerLiveClock').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>
