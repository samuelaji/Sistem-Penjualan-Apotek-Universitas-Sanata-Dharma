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

    public function staff()
    {
        return $this->belongsTo(related: staff::class, foreignKey:'id_pengguna', ownerKey:'id_pengguna');
    }
    
    public function detailTransaksi()
    {
        return $this->hasMany(related: DetailTransaksi::class, foreignKey:'id_transaksi', ownerKey: 'id_transaksi');


}       
         }
