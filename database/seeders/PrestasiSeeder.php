<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $prestasi = [
            [
                'judul' => 'Juara 1 Lomba Tahfidz Al-Qur\'an 30 Juz',
                'kategori' => 'keagamaan',
                'tingkat' => 'Provinsi',
                'tahun' => 2024,
                'deskripsi' => 'Santri kami berhasil meraih juara 1 dalam lomba tahfidz Al-Qur\'an 30 juz tingkat provinsi Jawa Barat',
            ],
            [
                'judul' => 'Juara 2 Olimpiade Matematika',
                'kategori' => 'akademik',
                'tingkat' => 'Kabupaten',
                'tahun' => 2024,
                'deskripsi' => 'Prestasi gemilang dalam bidang matematika tingkat kabupaten Pangandaran',
            ],
            [
                'judul' => 'Juara 1 Lomba Pidato Bahasa Arab',
                'kategori' => 'keagamaan',
                'tingkat' => 'Nasional',
                'tahun' => 2024,
                'deskripsi' => 'Santri kami menjadi juara 1 lomba pidato bahasa Arab tingkat nasional',
            ],
            [
                'judul' => 'Juara 3 Lomba Cerdas Cermat Agama Islam',
                'kategori' => 'keagamaan',
                'tingkat' => 'Provinsi',
                'tahun' => 2023,
                'deskripsi' => 'Tim cerdas cermat pesantren meraih juara 3 tingkat provinsi',
            ],
            [
                'judul' => 'Juara 1 Lomba Kaligrafi',
                'kategori' => 'non_akademik',
                'tingkat' => 'Kabupaten',
                'tahun' => 2023,
                'deskripsi' => 'Karya kaligrafi santri menjadi yang terbaik di tingkat kabupaten',
            ],
            [
                'judul' => 'Juara 2 Lomba Qiroah',
                'kategori' => 'keagamaan',
                'tingkat' => 'Provinsi',
                'tahun' => 2023,
                'deskripsi' => 'Santri putri meraih juara 2 lomba qiroah tingkat provinsi',
            ],
            [
                'judul' => 'Juara 1 Lomba Karya Tulis Ilmiah',
                'kategori' => 'akademik',
                'tingkat' => 'Nasional',
                'tahun' => 2023,
                'deskripsi' => 'Karya tulis ilmiah tentang pendidikan Islam modern meraih juara 1 nasional',
            ],
            [
                'judul' => 'Juara 3 Lomba Futsal Antar Pesantren',
                'kategori' => 'non_akademik',
                'tingkat' => 'Provinsi',
                'tahun' => 2024,
                'deskripsi' => 'Tim futsal pesantren berhasil meraih juara 3 di ajang provinsi',
            ],
        ];

        foreach ($prestasi as $item) {
            Prestasi::create($item);
        }
    }
}
