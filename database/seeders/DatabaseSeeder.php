<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Staff::create([
            'nama_pengguna' => 'Bapak Manajer',
            'username' => 'manajemen',
            'password' => Hash::make('rahasia123'),
            'role_akses' => 'Manajemen',
        ]);

        Staff::create([
            'nama_pengguna' => 'Ibu Apoteker',
            'username' => 'apoteker',
            'password' => Hash::make('rahasia123'),
            'role_akses' => 'Apoteker',
        ]);

        Staff::create([
            'nama_pengguna' => 'Mbak Kasir',
            'username' => 'kasir',
            'password' => Hash::make('rahasia123'),
            'role_akses' => 'Kasir',
        ]);
    }
}
