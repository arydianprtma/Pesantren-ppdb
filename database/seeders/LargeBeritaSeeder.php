<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LargeBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $total = 100000;
        $chunkSize = 5000;
        $userId = \App\Models\User::first()?->id ?? 1;

        $this->command->info("Memulai pembuatan $total data berita...");

        for ($i = 0; $i < $total; $i += $chunkSize) {
            $data = [];
            for ($j = 0; $j < $chunkSize; $j++) {
                $judul = $faker->sentence(rand(6, 12));
                $data[] = [
                    'user_id'      => $userId,
                    'judul'        => $judul,
                    'slug'         => \Illuminate\Support\Str::slug($judul) . '-' . uniqid(),
                    'konten'       => '<p>' . implode('</p><p>', $faker->paragraphs(rand(3, 8))) . '</p>',
                    'gambar'       => null,
                    'kategori'     => $faker->randomElement(['pengumuman', 'berita', 'kegiatan']),
                    'is_published' => true,
                    'published_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }
            \App\Models\Berita::insert($data);
            $this->command->comment("Berhasil memasukkan " . ($i + $chunkSize) . " data...");
        }

        $this->command->info("Selesai! 100.000 data berita berhasil dibuat.");
    }
}
