<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    // Hapus baris ini jika migration memakai $table->timestamps()
    public $timestamps = false;

    protected $fillable = [
        'id_shift',
        'id_pasien',
        'id_resep',
        'tanggal_transaksi',
        'total_harga',
        'nominal_bayar',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];

    public function shift(){


        return $this->belongsTo(Shift::class, 'id_shift', 'id_shift');
    }

    public function pasien(){
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function resep(){
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }

    public function detail_transaksi(){
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }

}
