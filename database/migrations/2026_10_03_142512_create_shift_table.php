<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shift', function (Blueprint $table) {
            $table->id('id_shift');
            $table->foreignId('id_pengguna')->constrained('staff', 'id_pengguna')->onDelete('cascade');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai')->nullable();
            $table->decimal('saldo_awal', 15, 2);
            $table->decimal('saldo_akhir', 15, 2)->nullable();
            $table->decimal('total_penjualan', 15, 2)->nullable();
            $table->decimal('selisih', 15, 2)->default(0);
            $table->enum('status',['Buka','Tutup'])->default('Tutup');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shift');
    }
};
