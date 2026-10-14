# Sistem Penjualan Apotek Universitas Sanata Dharma

Aplikasi ini adalah fondasi sistem penjualan apotek berbasis Laravel untuk kebutuhan operasional internal, meliputi manajemen obat, stok, dan transaksi kasir.

## Fitur MVP Saat Ini

- Manajemen data obat (`obats`) beserta relasi kategori dan supplier
- Pencatatan dan pembaruan stok obat, termasuk log pergerakan stok
- Transaksi penjualan kasir dengan detail item dan perhitungan total
- Role-based authorization untuk `admin`, `kasir`, dan `apoteker`

## Struktur Domain Inti

- `categories`: kategori obat
- `suppliers`: pemasok obat
- `obats`: master obat + stok
- `sales`: transaksi penjualan
- `sale_items`: item detail transaksi
- `stock_movements`: histori mutasi stok
- `shifts`: data shift pengguna

## Prasyarat

- PHP 8.3+
- Composer
- SQLite/MySQL/PostgreSQL (default test memakai SQLite in-memory)

## Setup Proyek

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## Menjalankan Aplikasi

```bash
php artisan serve
```

## Endpoint Utama

Semua endpoint berada di prefix `/api` dan memerlukan autentikasi.

### Obat (admin, apoteker)
- `GET /api/obats`
- `POST /api/obats`
- `GET /api/obats/{id}`
- `PUT/PATCH /api/obats/{id}`
- `DELETE /api/obats/{id}`
- `PATCH /api/obats/{id}/stock`

### Penjualan (admin, kasir)
- `GET /api/sales`
- `POST /api/sales`
- `GET /api/sales/{id}`

## Pengujian

```bash
composer test
```

## Kualitas Kode

Format/lint style:

```bash
./vendor/bin/pint --test
```

CI akan menjalankan pengecekan format dan test otomatis pada push/pull request.
