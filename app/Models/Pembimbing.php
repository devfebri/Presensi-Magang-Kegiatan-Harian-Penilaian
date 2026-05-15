<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pembimbing extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pembimbing';
    protected $guard = 'pembimbing';

    protected $fillable = [
        'instansi_id',
        'nama_lengkap',
        'nip',
        'email',
        'password',
        'telepon',
        'jabatan',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }
}
