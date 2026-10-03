<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_shift')->constrained('shift', 'id_shift')->onDelete('cascade');
            $table->foreignId('id_pasien')->constrained('pasien', 'id_pasien')->onDelete('cascade');
            $table->foreignId('id_resep')->constrained('resep', 'id_resep')->onDelete('cascade');
            $table->dateTime('tgl_transaksi');
            $table->decimal('total_harga', 15, 2);
            $table->decimal('nominal_bayar', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
