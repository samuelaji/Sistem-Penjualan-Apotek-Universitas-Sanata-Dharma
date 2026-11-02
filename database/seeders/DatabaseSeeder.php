<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\Obat;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $manajemen = Staff::create([
            'nama_pengguna' => 'Budi',
            'username' => 'manajemen',
            'password' => Hash::make('rahasia123'),
            'role_akses' => 'Manajemen',
        ]);

        $apoteker = Staff::create([
            'nama_pengguna' => 'Adi',
            'username' => 'apoteker',
            'password' => Hash::make('rahasia123'),
            'role_akses' => 'Apoteker',
        ]);

        $kasir = Staff::create([
            'nama_pengguna' => 'Loney',
            'username' => 'kasir',
            'password' => Hash::make('rahasia123'),
            'role_akses' => 'Kasir',
        ]);


        $obatData = [
            [
                'id_pengguna' => $apoteker->id_pengguna,
                'sku' => 'AMO-500',
                'nama_obat' => 'Amoxicillin 500mg',
                'kategori' => 'Antibiotik',
                'jenis_obat' => 'Strip (12 Kapsul)',
                'stok' => 45,
                'batas_minimum' => 10,
                'harga_obat' => 18000,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12),
            ],
            [
                'id_pengguna' => $apoteker->id_pengguna,
                'sku' => 'PARA-SYR',
                'nama_obat' => 'Paracetamol Sirup 60ml',
                'kategori' => 'Analgesik',
                'jenis_obat' => 'Botol (60 ml)',
                'stok' => 24,
                'batas_minimum' => 5,
                'harga_obat' => 27000,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24),
            ],
            [
                'id_pengguna' => $apoteker->id_pengguna,
                'sku' => 'CET-10',
                'nama_obat' => 'Cetirizine 10mg',
                'kategori' => 'Antihistamin',
                'jenis_obat' => 'Strip (10 Tablet)',
                'stok' => 5,
                'batas_minimum' => 10,
                'harga_obat' => 12500,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(8),
            ],
            [
                'id_pengguna' => $apoteker->id_pengguna,
                'sku' => 'VIT-C500',
                'nama_obat' => 'Vitamin C 500mg',
                'kategori' => 'Suplemen',
                'jenis_obat' => 'Botol (30 Tablet)',
                'stok' => 80,
                'batas_minimum' => 20,
                'harga_obat' => 35000,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(36),
            ]
        ];

        foreach ($obatData as $obat) {
            Obat::create($obat);
        }

        \App\Models\Shift::create([
            'id_pengguna' => $kasir->id_pengguna,
            'waktu_mulai' => Carbon::now(),
            'saldo_awal' => 500000,
            'status' => 'Buka'
        ]);
    }
}
