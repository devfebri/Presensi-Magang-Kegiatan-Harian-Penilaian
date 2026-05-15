<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instansi::create([
            'kode' => 'D001',
            'nama' => 'SMKN 1 Kota Jambi',
        ]);
        Instansi::create([
            'kode' => 'D002',
            'nama' => 'Universitas Budidaya',
        ]);
        Instansi::create([
            'kode' => 'D003',
            'nama' => 'SMKN 2 Kota Jambi',
        ]);
    }
}
