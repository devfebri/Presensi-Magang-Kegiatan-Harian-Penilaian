<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = "instansi";

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function pemagang()
    {
        return $this->hasMany(Pemagang::class);
    }
}
