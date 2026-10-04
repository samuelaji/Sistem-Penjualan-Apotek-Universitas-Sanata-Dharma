INSERT INTO staff (nama, role_akses, created_at, updated_at) VALUES
('Budi Santoso', 'Kasir', NOW(), NOW()),
('Dr. Siska Sp.A', 'Apoteker', NOW(), NOW());

INSERT INTO pasien (nama_pasien, tipe_pasien, no_identitas, created_at, updated_at) VALUES
('Ahmad Fauzi', 'Umum', '3404123456780001', NOW(), NOW()),
('Siti Aminah', 'BPJS', '3404123456780002', NOW(), NOW());

INSERT INTO resep (nama_dokter, nama_klinik, tanggal_resep, created_at, updated_at) VALUES
('Dr. Siska', 'Klinik Sehat', '2026-10-01', NOW(), NOW());

INSERT INTO obat (id_pengguna, nama_obat, kategori, stok, harga, tanggal_kadaluwarsa, created_at, updated_at) VALUES
(1, 'Paracetamol 500mg Tablet', 'Analgesik', 150, 5000.00, '2028-12-31', NOW(), NOW()),
(1, 'Amoxicillin 500mg', 'Antibiotik', 80, 12000.00, '2027-06-30', NOW(), NOW());

INSERT INTO shift (id_pengguna, waktu_mulai, waktu_selesai, saldo_awal, saldo_akhir, created_at, updated_at) VALUES
(1, '2026-10-03 08:00:00', '2026-10-03 16:00:00', 500000.00, 1250000.00, NOW(), NOW());

INSERT INTO transaksi (id_shift, id_pasien, id_resep, tanggal_transaksi, total_harga, nominal_bayar, created_at, updated_at) VALUES
(1, 1, 1, '2026-10-03 10:30:00', 17000.00, 20000.00, NOW(), NOW());

INSERT INTO detail_transaksi (id_transaksi, id_obat, jumlah_beli, subtotal, created_at, updated_at) VALUES
(1, 1, 1, 5000.00, NOW(), NOW()),
(1, 2, 1, 12000.00, NOW(), NOW());
