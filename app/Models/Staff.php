<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staff';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'nama_pengguna',
        'username',
        'password',
        'role_akses',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function shifts()
    {
        return $this->hasMany(Shift::class, 'id_pengguna', 'id_pengguna');
    }
}
