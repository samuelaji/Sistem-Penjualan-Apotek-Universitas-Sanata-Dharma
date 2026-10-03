<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    public $incrementing = false;
    protected $primaryKey = ['id_transaksi', 'id_obat'];

    protected $fillable = [
        'id_transaksi',
        'id_obat',
        'jumlah_beli',
        'subtotal',
    ];
}
