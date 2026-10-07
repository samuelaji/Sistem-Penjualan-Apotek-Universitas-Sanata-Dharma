<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'nama_pasien',
        'tipe_pasien',
        'no_identitas',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pasien', 'id_pasien');
    }
}
