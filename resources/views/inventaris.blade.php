@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <!-- Header Bagian Atas -->

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Inventaris</h1>
        <div class="space-x-4 text-sm font-medium text-gray-600">
            <a href="#" class="hover:text-red-700">Dasbor</a>
            <a href="#" class="hover:text-red-700">Penjualan</a>
            <a href="#" class="text-red-700 font-semibold">Inventaris</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-red-700">Logout</button>
            </form>
        </div>
    </div>

    <!-- Banner Informasi Utama -->

    <div class="bg-white shadow-sm rounded-lg p-8 text-center mb-8 border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Laporan Pengelolaan Inventaris</h2>
        <p class="text-gray-500 text-sm mb-6">Pantau nilai stok, kategori obat, dan pergerakan barang secara sekilas.</p>
        <div class="flex justify-center gap-4">
            <button class="px-5 py-2 border border-red-700 text-red-700 text-sm font-medium rounded hover:bg-red-50 transition">
                Ekspor CSV
            </button>
            <button class="px-5 py-2 bg-red-800 text-white text-sm font-medium rounded hover:bg-red-900 transition">
                Lihat Detail
            </button>
        </div>
    </div>

    <!-- Bagian Grafik / Rincian Penilaian Stok -->

    <div class="mb-10">
        <h3 class="text-lg font-bold text-gray-800 text-center mb-6">Rincian Penilaian Stok</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Kotak Grafik 1 -->

            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm flex flex-col items-center justify-center h-64">
                <p class="text-xs font-semibold text-gray-500 self-start mb-2">Nilai Berdasarkan Kategori</p>
                <div class="w-32 h-32 rounded-full bg-gradient-to-tr from-green-500 via-yellow-400 to-red-700 shadow-inner"></div>
                <span class="text-xs text-gray-400 mt-4 self-end">Kategori</span>
            </div>

            <!-- Kotak Grafik 2 -->

            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm flex flex-col justify-between h-64">
                <p class="text-xs font-semibold text-gray-500">Kategori Teratas Berdasarkan Nilai</p>
                <div class="flex items-end justify-around h-40 pt-4 px-2">
                    <div class="w-6 bg-green-500 h-full rounded-t"></div>
                    <div class="w-6 bg-red-800 h-3/4 rounded-t"></div>
                    <div class="w-6 bg-green-500 h-1/2 rounded-t"></div>
                    <div class="w-6 bg-yellow-400 h-4/5 rounded-t"></div>
                    <div class="w-6 bg-green-500 h-3/5 rounded-t"></div>
                    <div class="w-6 bg-red-800 h-5/6 rounded-t"></div>
                    <div class="w-6 bg-yellow-400 h-2/3 rounded-t"></div>
                </div>
                <span class="text-xs text-gray-400 self-end">Kategori</span>
            </div>
        </div>
    </div>

    <!-- Tabel Data Dinamis Inventaris (Dari Database) -->
     
    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm mb-10">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Tabel Data Inventaris (Dinamis)</h3>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="border border-gray-200 p-2 text-left">Nama Obat</th>
                        <th class="border border-gray-200 p-2 text-left">Kategori</th>
                        <th class="border border-gray-200 p-2 text-left">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listObat as $obat)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $obat->nama_obat }}</td>
                            <td class="border border-gray-200 p-2">{{ $obat->kategori }}</td>
                            <td class="border border-gray-200 p-2">{{ $obat->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border border-gray-200 p-4 text-center text-gray-500">Belum ada data inventaris di database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Filter & Opsi Tabel Mutasi Stok -->
     
    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
        <h3 class="text-lg font-bold text-gray-800 text-center mb-2">Opsi Tabel Mutasi Stok</h3>
        <p class="text-xs text-gray-500 text-center mb-6">Pilih data yang akan ditampilkan pada tabel mendetail di bawah ini.</p>
        
        <form method="GET" action="">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kategori Obat</label>
                    <select name="kategori" class="w-full border border-gray-300 rounded p-2 text-sm bg-white focus:outline-none focus:ring-1 focus:ring-red-700">
                        <option value="">Semua Kategori</option>
                    </select>
                    <span class="text-[10px] text-gray-400 mt-1 block">Filter tabel berdasarkan kategori</span>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Jenis Mutasi Stok</label>
                    <select name="jenis_mutasi" class="w-full border border-gray-300 rounded p-2 text-sm bg-white focus:outline-none focus:ring-1 focus:ring-red-700">
                        <option value="">Semua</option>
                    </select>
                    <span class="text-[10px] text-gray-400 mt-1 block">Penerimaan, Pengeluaran, Transfer, Penyesuaian</span>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Mode Tampilan</label>
                    <select name="mode_tampilan" class="w-full border border-gray-300 rounded p-2 text-sm bg-white focus:outline-none focus:ring-1 focus:ring-red-700">
                        <option value="">Penilaian Saat Ini</option>
                    </select>
                    <span class="text-[10px] text-gray-400 mt-1 block">Beralih antara Saat Ini / Rerata Bulanan</span>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Urutkan Berdasarkan</label>
                    <select name="sort" class="w-full border border-gray-300 rounded p-2 text-sm bg-white focus:outline-none focus:ring-1 focus:ring-red-700">
                        <option value="">Nilai Tertinggi</option>
                    </select>
                    <span class="text-[10px] text-gray-400 mt-1 block">Penilaian, Nama, atau Tanggal Mutasi Terakhir</span>
                </div>
            </div>

            <div class="flex justify-center gap-4 pt-4 border-t border-gray-100">
                <button type="reset" class="px-6 py-2 border border-red-700 text-red-700 text-sm font-medium rounded hover:bg-red-50 transition">
                    Atur Ulang
                </button>
                <button type="submit" class="px-6 py-2 bg-red-800 text-white text-sm font-medium rounded hover:bg-red-900 transition">
                    Perbarui Tabel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection