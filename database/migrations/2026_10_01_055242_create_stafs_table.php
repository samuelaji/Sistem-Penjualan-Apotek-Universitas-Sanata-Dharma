<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stafs', function (Blueprint $table) {
            $table->string('id_staf')->primary();
            $table->string('nama_staf');
            $table->enum('role_akses', ['kasir', 'apoteker', 'manajemen']); // Membedakan hak akses di 1 kolom
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stafs');
    }
};