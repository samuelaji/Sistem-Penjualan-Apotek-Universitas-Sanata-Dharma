SELECT t.id_transaksi, t.tanggal_transaksi, p.nama_pasien, t.total_harga, t.nominal_bayar
FROM transaksi t
JOIN pasien p ON t.id_pasien = p.id_pasien;

SELECT t.id_transaksi, o.nama_obat, dt.jumlah_beli, dt.subtotal
FROM detail_transaksi dt
JOIN obat o ON dt.id_obat = o.id_obat
JOIN transaksi t ON dt.id_transaksi = t.id_transaksi;

SELECT nama_pasien, no_identitas, tipe_pasien
FROM pasien
WHERE tipe_pasien = 'umum';

SELECT nama_obat, kategori, stok, tanggal_kadaluwarsa
FROM obat
ORDER BY stok ASC;
