<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Contact Messages (1000 data)
        $contactMessages = [];
        for ($i = 0; $i < 1000; $i++) {
            $contactMessages[] = [
                'nama' => $faker->name,
                'whatsapp' => '08' . $faker->numerify('##########'),
                'pesan' => $faker->paragraph(rand(1, 3)),
                'is_read' => $faker->boolean(30),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ];

            // Insert in chunks of 500
            if (count($contactMessages) === 500) {
                DB::table('pesan_kontak')->insert($contactMessages);
                $contactMessages = [];
            }
        }

        // Spmb Registrants (1000 data)
        $Spmb = [];
        $jenjangOptions = ['MTS', 'MA'];
        $jkOptions = ['L', 'P'];
        $statusOptions = ['pending', 'verified', 'accepted', 'rejected'];
        $pendidikanOptions = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
        $penghasilanOptions = ['<1jt', '1-3jt', '3-5jt', '>5jt'];
        $statusOrtuOptions = ['lengkap', 'ayah_saja', 'ibu_saja', 'wali'];

        for ($i = 0; $i < 1000; $i++) {
            $Spmb[] = [
                'nama_lengkap' => $faker->name,
                'nisn' => $faker->unique()->numerify('##########'),
                'jenjang' => $faker->randomElement($jenjangOptions),
                'asal_sekolah' => 'SD Negeri ' . $faker->numberBetween(1, 10) . ' ' . $faker->city,
                'jenis_kelamin' => $faker->randomElement($jkOptions),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '-12 years'),
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

                'alamat_ortu_sama' => $faker->boolean(80),
                'alamat_ortu' => $faker->address,
                'status_ortu' => $faker->randomElement($statusOrtuOptions),

                'status' => $faker->randomElement($statusOptions),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ];

            // Insert in chunks of 500
            if (count($Spmb) === 500) {
                DB::table('pendaftar_spmb')->insert($Spmb);
                $Spmb = [];
            }
        }
    }
}
