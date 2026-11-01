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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id('id_barang_masuk');
            $table->foreignId('id_obat')->constrained('obat', 'id_obat')->onDelete('cascade');
            $table->foreignId('id_supplier')->constrained('supplier', 'id_supplier')->onDelete('cascade');
            $table->foreignId('id_pengguna')->constrained('staff', 'id_pengguna')->onDelete('cascade');
            $table->integer('jumlah_masuk');
            $table->date('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
