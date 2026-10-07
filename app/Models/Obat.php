<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'id_pengguna',
        'nama_obat',
        'kategori',
        'stok',
        'harga',
        'tanggal_kadaluwarsa',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_obat', 'id_obat');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_pengguna', 'id_pengguna');
    }
}
