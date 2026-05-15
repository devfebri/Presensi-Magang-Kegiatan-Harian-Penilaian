<?php

namespace Database\Seeders;

use App\Models\Pemagang;
use App\Models\LokasiKantor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // LokasiKantor::create([
        //     'kota' => 'Blora Florist',
        //     'alamat' => 'Bakung Jaya',
        //     'latitude' => -1.639256738208176,
        //     'longitude' => 103.66542735535934,
        //     'radius' => 300,
        //     'is_used' => true,
        // ]);
        LokasiKantor::create([
            'kota' => 'Jambi',
            'alamat' => 'Universitas Nurdin Hamzah',
            'latitude' => -1.639256738208176,
            'longitude' => 103.592547983955,
            'radius' => 300,
            'is_used' => true,
        ]);

        $this->call([
            InstansiSeeder::class,
            PemagangSeeder::class,
            PresensiSeeder::class,
            PengajuanPresensiSeeder::class,
            PembimbingSeeder::class,
        ]);
    }
}
