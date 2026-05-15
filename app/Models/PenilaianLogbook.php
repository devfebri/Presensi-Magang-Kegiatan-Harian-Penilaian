<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianLogbook extends Model
{
    protected $table = 'penilaian_logbooks';

    protected $fillable = [
        'pembimbing_id',
        'nik',
        'nilai',
        'catatan',
    ];

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class);
    }

    public function pemagang()
    {
        return $this->belongsTo(Pemagang::class, 'nik', 'nik');
    }

    /**
     * Label predikat berdasarkan nilai.
     */
    public function getPredikatAttribute(): string
    {
        return match(true) {
            $this->nilai >= 90 => 'A (Sangat Baik)',
            $this->nilai >= 80 => 'B (Baik)',
            $this->nilai >= 70 => 'C (Cukup)',
            $this->nilai >= 60 => 'D (Kurang)',
            default            => 'E (Sangat Kurang)',
        };
    }

    /**
     * Warna Tailwind untuk predikat.
     */
    public function getWarnaNilaiAttribute(): string
    {
        return match(true) {
            $this->nilai >= 90 => 'emerald',
            $this->nilai >= 80 => 'blue',
            $this->nilai >= 70 => 'amber',
            $this->nilai >= 60 => 'orange',
            default            => 'red',
        };
    }
}
