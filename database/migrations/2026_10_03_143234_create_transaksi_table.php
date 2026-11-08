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
            $table->unsignedBigInteger('id_pasien')->nullable();
            $table->unsignedBigInteger('id_resep')->nullable();
            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('set null');
            $table->foreign('id_resep')->references('id_resep')->on('resep')->onDelete('set null');
            $table->dateTime('tanggal_transaksi');
            $table->decimal('total_harga', 15, 2);
            $table->decimal('nominal_bayar', 15, 2);
            $table->decimal('nominal_kembalian', 15, 2)->default(0);
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris'])->default('cash');
            $table->enum('status_transaksi', ['Selesai', 'Pending', 'Dibatalkan'])->default('Selesai');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
