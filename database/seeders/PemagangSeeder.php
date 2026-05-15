<?php

namespace Database\Seeders;

use App\Models\Pemagang;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PemagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemagang::create([
            'nik' => '12345',
            'instansi_id' => '1',
            'nama_lengkap' => 'Ucup',
            'foto' => '12345.jpg',
            'jabatan' => 'Pemagang',
            'telepon' => '08123456789',
            'email' => 'ucup@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Pemagang::create([
            'nik' => '12346',
            'instansi_id' => '2',
            'nama_lengkap' => 'Wati',
            'jabatan' => 'Pemagang',
            'telepon' => '08123456780',
            'email' => 'wati@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Pemagang::create([
            'nik' => '12347',
            'instansi_id' => '3',
            'nama_lengkap' => 'Mawar',
            'jabatan' => 'Pemagang',
            'telepon' => '08123456781',
            'email' => 'mawar@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
