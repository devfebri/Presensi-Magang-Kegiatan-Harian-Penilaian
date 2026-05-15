<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pemagang extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "pemagang";
    protected $primaryKey = "nik";
    protected $guard = "pemagang";

    protected $fillable = [
        'nik',
        'instansi_id',
        'nama_lengkap',
        'jabatan',
        'telepon',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'nik', 'nik');
    }

    public function penilaianLogbook()
    {
        return $this->hasMany(PenilaianLogbook::class, 'nik', 'nik');
    }
}
