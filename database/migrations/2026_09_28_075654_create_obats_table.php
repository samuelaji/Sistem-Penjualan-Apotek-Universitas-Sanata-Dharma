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
        Schema::create('obat', function (Blueprint $table) {
            $table->string('id_obat')->primary(); // String & Primary Key
            $table->string('nama_obat');          // String
            $table->string('kategori');           // String
            $table->integer('stok');              // Integer
            $table->double('harga');              // Double
            $table->date('tgl_kadaluwarsa');      // Date
            $table->timestamps();                 // created_at & updated_at bawaan laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }


};
