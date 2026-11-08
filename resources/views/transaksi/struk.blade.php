<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaksi->id_transaksi }}</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 10px;
            width: 280px; /* Ukuran standar kertas thermal 58mm/80mm */
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
        .divider { border-top: 1px dashed #000; margin: 8px 0; }
        .table-items { width: 100%; border-collapse: collapse; }
        .table-items td { vertical-align: top; padding: 2px 0; }

        /* Auto Print saat halaman terbuka */
        @media print {
            .no-print { display: none; }
            body { padding: 0; width: 100%; }
        }
    </style>
</head>
<body onload="window.print()"> <!-- Script ajaib agar langsung muncul dialog print! -->

<div class="text-center">
    <h3 style="margin: 0;">APOTEK SANATA DHARMA</h3>
    <p style="margin: 4px 0; font-size: 10px;">
        Kampus III Paingan, Maguwoharjo<br>
        Depok, Sleman, Yogyakarta<br>
        Telp: (0274) 123456
    </p>
</div>

<div class="divider"></div>

<table style="width: 100%; font-size: 11px;">
    <tr>
        <td>Tgl</td>
        <td>: {{ date('d/m/Y H:i', strtotime($transaksi->tanggal_transaksi)) }}</td>
    </tr>
    <tr>
        <td>No</td>
        <td>: TRX-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</td>
    </tr>
    <tr>
        <td>Kasir</td>
        <td>: {{ $transaksi->shift->staff->nama_pengguna ?? 'Kasir Default' }}</td>
    </tr>
</table>

<div class="divider"></div>

<table class="table-items">
    @foreach($transaksi->detail_transaksi as $detail)
        <tr>
            <td colspan="3" class="fw-bold">{{ $detail->obat->nama_obat }}</td>
        </tr>
        <tr>
            <td>{{ $detail->jumlah_beli }}x</td>
            <td>{{ number_format($detail->obat->harga_obat, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
        </tr>
    @endforeach
</table>

<div class="divider"></div>

<table style="width: 100%;">
    <tr>
        <td>Total Tagihan</td>
        <td class="text-right fw-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
    </tr>
    @if($transaksi->metode_pembayaran == 'cash')
        <tr>
            <td>Tunai</td>
            <td class="text-right">Rp {{ number_format($transaksi->nominal_bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="text-right">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
        </tr>
    @else
        <tr>
            <td>Metode Bayar</td>
            <td class="text-right fw-bold text-uppercase">{{ $transaksi->metode_pembayaran }}</td>
        </tr>
    @endif
</table>

<div class="divider"></div>

<div class="text-center" style="font-size: 10px; margin-top: 10px;">
    @if($transaksi->status_transaksi == 'Pending')
        ** MEMBUTUHKAN VALIDASI APOTEKER **<br>
    @endif
    Terima kasih atas kunjungan Anda.<br>
    Semoga lekas sembuh!
</div>

</body>
</html>
