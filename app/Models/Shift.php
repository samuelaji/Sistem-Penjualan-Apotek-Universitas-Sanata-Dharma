<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shift';
    protected $primaryKey = 'id_shift';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'waktu_mulai',
        'waktu_selesai',
        'saldo_awal',
        'saldo_akhir',
    ];
    protected $casts = [
        'waktu_mulai'   => 'datetime',
        'waktu_selesai' => 'datetime',
    ];
}
