<?php

namespace Database\Seeders;

use App\Models\Pembimbing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pembimbings = [
            [
                'nama_lengkap' => 'Ahmad Fauzi, S.H.',
                'nip'          => '197801012006041001',
                'instansi_id'  => '1',
                'email'        => 'pembimbing@gmail.com',
                'password'     => Hash::make('password'),
                'telepon'      => '081234567890',
                'jabatan'      => 'Kepala Seksi Pembinaan',
            ]
        ];

        foreach ($pembimbings as $data) {
            Pembimbing::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }

        // $this->command->info('✅ Akun Pembimbing berhasil dibuat:');
        // $this->command->table(
        //     ['Nama', 'Email', 'Password'],
        //     collect($pembimbings)->map(fn($p) => [
        //         $p['nama_lengkap'],
        //         $p['email'],
        //         'pembimbing123',
        //     ])->toArray()
        // );
    }
}
