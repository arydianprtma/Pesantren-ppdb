<?php

namespace Database\Seeders;

use App\Models\PpdbRegistrant;
use Illuminate\Database\Seeder;

class PpdbSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_lengkap' => 'Ahmad Fulan',
                'nisn' => '1234567890',
                'jenjang' => 'MTS',
                'asal_sekolah' => 'SDN 1 Pagi',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2012-05-15',
                'alamat' => 'Jl. Merpati No. 1',
                'no_hp' => '081234567890',
                'nama_ayah' => 'Budi Fulan',
                'nama_ibu' => 'Siti Fulan',
                'status' => 'pending',
                'created_at' => now(),
            ],
            [
                'nama_lengkap' => 'Siti Aminah',
                'nisn' => '0987654321',
                'jenjang' => 'MA',
                'asal_sekolah' => 'SMPN 1 Kota',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2009-08-20',
                'alamat' => 'Jl. Kutilang No. 5',
                'no_hp' => '085678901234',
                'nama_ayah' => 'Joko',
                'nama_ibu' => 'Ani',
                'status' => 'verified',
                'created_at' => now()->subHours(2),
            ],
            [
                'nama_lengkap' => 'Budi Santoso',
                'nisn' => '1122334455',
                'jenjang' => 'MTS',
                'asal_sekolah' => 'SDN 2 Sore',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2012-01-10',
                'alamat' => 'Jl. Elang No. 3',
                'no_hp' => '081122334455',
                'nama_ayah' => 'Santoso',
                'nama_ibu' => 'Sri',
                'status' => 'accepted',
                'created_at' => now()->subDays(1),
            ],
            [
                'nama_lengkap' => 'Dewi Sartika',
                'nisn' => '5544332211',
                'jenjang' => 'MA',
                'asal_sekolah' => 'MTS Nurul Huda',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2009-12-05',
                'alamat' => 'Jl. Kenari No. 10',
                'no_hp' => '089988776655',
                'nama_ayah' => 'Sartono',
                'nama_ibu' => 'Dewi',
                'status' => 'rejected',
                'created_at' => now()->subDays(2),
            ]
        ];

        foreach ($data as $item) {
            PpdbRegistrant::create($item);
        }
    }
}
