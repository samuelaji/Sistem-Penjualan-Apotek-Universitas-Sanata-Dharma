<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id(); // Primary Key bawaan Laravel (Auto Increment)
            $table->integer('id_transaksi'); // Relasi ke tabel transaksi
            $table->integer('id_obat');      // Relasi ke tabel obat
            $table->integer('jumlah_beli');
            $table->double('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};