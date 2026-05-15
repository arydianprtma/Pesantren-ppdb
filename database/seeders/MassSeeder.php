<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class MassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Disable query log to save memory
        DB::disableQueryLog();

        $this->command->info('Mulai melakukan seeding 50.000 data dummy...');

        // 1. Contact Messages (15.000)
        $this->command->info('Seeding 15.000 Contact Messages...');
        for ($batch = 0; $batch < 15; $batch++) {
            $data = [];
            for ($i = 0; $i < 1000; $i++) {
                $data[] = [
                    'nama' => $faker->name,
                    'whatsapp' => '08' . $faker->numerify('##########'),
                    'pesan' => $faker->text(200),
                    'is_read' => $faker->boolean(40),
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ];
            }
            DB::table('contact_messages')->insert($data);
        }

        // 2. Spmb Registrants (15.000)
        $this->command->info('Seeding 15.000 Spmb Registrants...');
        $jenjangOptions = ['MTS', 'MA'];
        $jkOptions = ['L', 'P'];
        $statusOptions = ['pending', 'verified', 'accepted', 'rejected'];
        $pendidikanOptions = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
        $penghasilanOptions = ['<1jt', '1-3jt', '3-5jt', '>5jt'];
        $statusOrtuOptions = ['lengkap', 'ayah_saja', 'ibu_saja', 'wali'];

        for ($batch = 0; $batch < 15; $batch++) {
            $data = [];
            for ($i = 0; $i < 1000; $i++) {
                $data[] = [
                    'nama_lengkap' => $faker->name,
                    'nisn' => $faker->unique()->numerify('##########'),
                    'jenjang' => $faker->randomElement($jenjangOptions),
                    'asal_sekolah' => 'SD Negeri ' . $faker->numberBetween(1, 20) . ' ' . $faker->city,
                    'jenis_kelamin' => $faker->randomElement($jkOptions),
                    'tempat_lahir' => $faker->city,
                    'tanggal_lahir' => $faker->date('Y-m-d', '-13 years'),
                    'alamat' => $faker->address,
                    'no_hp' => '08' . $faker->numerify('##########'),
                    'nama_ayah' => $faker->name('male'),
                    'pekerjaan_ayah' => $faker->jobTitle,
                    'pendidikan_ayah' => $faker->randomElement($pendidikanOptions),
                    'nama_ibu' => $faker->name('female'),
                    'pekerjaan_ibu' => $faker->jobTitle,
                    'pendidikan_ibu' => $faker->randomElement($pendidikanOptions),
                    'no_hp_ortu' => '08' . $faker->numerify('##########'),
                    'penghasilan_ortu' => $faker->randomElement($penghasilanOptions),
                    'alamat_ortu_sama' => $faker->boolean(90),
                    'alamat_ortu' => $faker->address,
                    'status_ortu' => $faker->randomElement($statusOrtuOptions),
                    'status' => $faker->randomElement($statusOptions),
                    'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ];
            }
            DB::table('Spmb_registrants')->insert($data);
        }

        // 3. Berita (10.000)
        $this->command->info('Seeding 10.000 Berita...');
        $kategoriBerita = ['pengumuman', 'berita', 'kegiatan'];
        for ($batch = 0; $batch < 10; $batch++) {
            $data = [];
            for ($i = 0; $i < 1000; $i++) {
                $judul = $faker->sentence(6);
                $data[] = [
                    'user_id' => 1,
                    'judul' => $judul,
                    'slug' => Str::slug($judul) . '-' . Str::random(5) . '-' . uniqid(),
                    'konten' => $faker->paragraphs(4, true),
                    'kategori' => $faker->randomElement($kategoriBerita),
                    'is_published' => $faker->boolean(80),
                    'published_at' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
                    'created_at' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ];
            }
            DB::table('beritas')->insert($data);
        }

        // 4. Prestasi (10.000)
        $this->command->info('Seeding 10.000 Prestasi...');
        $kategoriPrestasi = ['akademik', 'non_akademik', 'keagamaan'];
        $tingkatPrestasi = ['Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'];
        for ($batch = 0; $batch < 10; $batch++) {
            $data = [];
            for ($i = 0; $i < 1000; $i++) {
                $data[] = [
                    'judul' => 'Juara ' . rand(1, 3) . ' ' . $faker->words(3, true),
                    'kategori' => $faker->randomElement($kategoriPrestasi),
                    'tingkat' => $faker->randomElement($tingkatPrestasi),
                    'tahun' => $faker->numberBetween(2015, date('Y')),
                    'deskripsi' => $faker->paragraph(2),
                    'created_at' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ];
            }
            DB::table('prestasis')->insert($data);
        }

        $this->command->info('Selesai! 50.000 data telah berhasil dimasukkan ke database.');
    }
}
