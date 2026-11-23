<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use App\Models\Obat;
use App\Models\Shift;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $passwordHash = Hash::make('12345678');

        // 1. Akun Staff (username pakai NIM, password: 12345678)
        $manajemen = Staff::create([
            'nama_pengguna' => 'samuel',
            'username'      => '245314008',
            'password'      => $passwordHash,
            'role_akses'    => 'Manajemen',
        ]);

        $apoteker = Staff::create([
            'nama_pengguna' => 'nadia',
            'username'      => '245314015',
            'password'      => $passwordHash,
            'role_akses'    => 'Apoteker',
        ]);

        $apoteker2 = Staff::create([
            'nama_pengguna' => 'bagas',
            'username'      => '245314022',
            'password'      => $passwordHash,
            'role_akses'    => 'Apoteker',
        ]);

        $kasir = Staff::create([
            'nama_pengguna' => 'aji',
            'username'      => '245314031',
            'password'      => $passwordHash,
            'role_akses'    => 'Kasir',
        ]);

        $kasir2 = Staff::create([
            'nama_pengguna' => 'rara',
            'username'      => '245314044',
            'password'      => $passwordHash,
            'role_akses'    => 'Kasir',
        ]);

        $daftarApoteker = [$apoteker->id_pengguna, $apoteker2->id_pengguna];
        $kategoris = ['Analgesik', 'Antibiotik', 'Antihistamin', 'Suplemen', 'Antasida', 'Antipiretik', 'Topikal'];
        $kemasans = ['Strip (10 Tablet)', 'Strip (10 Kapsul)', 'Botol (60 ml)', 'Botol (30 Tablet)', 'Tube (5 gr)'];
        $seederNow = Carbon::now();

        // 2. 500 Nama Obat Unik (50 nama dasar x 10 varian sediaan/dosis)
        $namaObatDasar = [
            'Paracetamol', 'Amoxicillin', 'Cetirizine', 'Vitamin C', 'Antasida',
            'Ibuprofen', 'Cefadroxil', 'Loratadine', 'Vitamin B1', 'Omeprazole',
            'Asam Mefenamat', 'Ciprofloxacin', 'Dexamethasone', 'Minyak Kayu Putih', 'Hidrokortison',
            'Amlodipine', 'Metformin', 'Simvastatin', 'Captopril', 'Salbutamol',
            'Loperamide', 'Domperidone', 'Ranitidine', 'Meloxicam', 'Ketoprofen',
            'Azithromycin', 'Cefixime', 'Clindamycin', 'Metronidazole', 'Doxycycline',
            'Chlorpheniramine', 'Fexofenadine', 'Vitamin D3', 'Zinc Sulfate', 'Ferrous Sulfate',
            'Sucralfate', 'Lansoprazole', 'Pantoprazole', 'Piroxicam', 'Diclofenac',
            'Guaifenesin', 'Dextromethorphan', ' Ambroxol', 'Acetylcysteine', 'Povidone Iodine',
            'Gentamicin', 'Neomycin', 'Bacitracin', 'Betamethasone', 'Caladine',
        ];

        $varianObat = [
            'Tablet 250mg',
            'Tablet 500mg',
            'Kaplet Salut Selaput 500mg',
            'Kapsul 250mg',
            'Kapsul 500mg',
            'Sirup 60ml',
            'Sirup Forte 100ml',
            'Drop 15ml',
            'Krim 5gr',
            'Salep 10gr',
        ];

        $namaObat500 = [];
        foreach ($namaObatDasar as $dasar) {
            foreach ($varianObat as $varian) {
                $namaObat500[] = trim($dasar) . ' ' . $varian;
            }
        }

        // 3. Isi 500 data obat ke database
        for ($i = 0; $i < 500; $i++) {
            $nomor     = $i + 1;
            $namaObat  = $namaObat500[$i];
            $kategori  = $kategoris[$i % count($kategoris)];
            $kemasan   = $kemasans[$i % count($kemasans)];
            $kodeKat   = strtoupper(substr($kategori, 0, 3));

            Obat::create([
                'id_pengguna'         => $daftarApoteker[$i % count($daftarApoteker)],
                'sku'                 => $kodeKat . '-' . str_pad((string) $nomor, 3, '0', STR_PAD_LEFT),
                'nama_obat'           => $namaObat,
                'kategori'            => $kategori,
                'jenis_obat'          => $kemasan,
                'stok'                => 10 + (($nomor * 13) % 90),
                'batas_minimum'       => 10,
                'harga_obat'          => 5000 + (($nomor % 20) * 1500),
                'tanggal_kadaluwarsa' => $seederNow->copy()->addMonths(6 + ($nomor % 24)),
            ]);
        }

        // 4. Isi data shift
        Shift::create([
            'id_pengguna' => $kasir->id_pengguna,
            'waktu_mulai' => $seederNow->copy()->setTime(8, 0, 0),
            'saldo_awal'  => 500000,
            'status'      => 'Buka',
        ]);

        Shift::create([
            'id_pengguna'   => $kasir2->id_pengguna,
            'waktu_mulai'   => $seederNow->copy()->subDay()->setTime(8, 0, 0),
            'waktu_selesai' => $seederNow->copy()->subDay()->setTime(16, 0, 0),
            'saldo_awal'    => 500000,
            'saldo_akhir'   => 1250000,
            'status'        => 'Tutup',
        ]);
    }
}
