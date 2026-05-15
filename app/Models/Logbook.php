<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $table = 'logbooks';

    protected $fillable = [
        'nik',
        'instansi_id',
        'tanggal',
        'kegiatann_hari_ini',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pemagang()
    {
        return $this->belongsTo(Pemagang::class, 'nik', 'nik');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }
}
