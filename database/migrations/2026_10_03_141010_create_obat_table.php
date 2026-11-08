<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id('id_obat');
            $table->foreignId('id_pengguna')->constrained('staff', 'id_pengguna')->onDelete('cascade');
            $table->string('sku');
            $table->string('nama_obat', 100);
            $table->string('kategori', 50);
            $table->string('jenis_obat', 100);
            $table->integer('stok');
            $table->integer('batas_minimum');
            $table->decimal('harga_obat', 15, 2);
            $table->date('tanggal_kadaluwarsa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
