<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Sejarah;
use App\Models\User;
use App\Models\VisiMisi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManajemenWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Visi Misi
        VisiMisi::truncate();
        VisiMisi::create([
            'visi' => "Terwujudnya Generasi Qur'ani, Berakhlak Mulia, Unggul dalam Prestasi, dan Berwawasan Global.",
            'misi' => "1. Menyelenggarakan pendidikan tahfidz Al-Qur'an dan ilmu syar'i secara intensif.\n2. Membina akhlakul karimah dan kemandirian santri melalui keteladanan dan pembiasaan.\n3. Menyelenggarakan pendidikan formal yang berkualitas berbasis iptek.\n4. Membekali santri dengan kecakapan hidup (life skills) dan penguasaan bahasa asing.",
            'nama_pengasuh' => "KH. Ahmad Rofi'i, Lc., M.A.",
            'foto_pengasuh' => null,
            'kata_sambutan' => "Assalamu'alaikum Wr. Wb. Selamat datang di portal resmi Pondok Pesantren Riyadussalikin. Kami berkomitmen untuk mendidik putra-putri Anda menjadi generasi yang berilmu, bertakwa, dan siap menghadapi tantangan zaman dengan tetap berpegang teguh pada nilai-nilai luhur kepesantrenan.",
            'is_active' => true,
        ]);

        // 2. Seed Sejarah
        Sejarah::truncate();
        $sejarahs = [
            [
                'judul' => "Awal Mula Berdirinya Pondok Pesantren",
                'periode' => "1998",
                'konten' => "Pondok Pesantren Riyadussalikin didirikan pada tahun 1998 oleh KH. Ahmad Rofi'i di atas lahan wakaf seluas 1 hektar. Awalnya, pesantren ini hanya menampung 15 santri mukim yang belajar mengaji kitab kuning di surau kecil.",
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => "Pembangunan Sekolah Formal",
                'periode' => "2005",
                'konten' => "Seiring bertambahnya minat masyarakat, pesantren mendirikan Sekolah Menengah Pertama (SMP) Islam Riyadussalikin untuk mengintegrasikan pendidikan agama dengan kurikulum nasional.",
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => "Era Digitalisasi & Ekspansi",
                'periode' => "2018 - Kini",
                'konten' => "Kini Riyadussalikin telah berkembang pesat dengan memiliki unit SMP, SMA, serta program khusus Tahfidzul Qur'an 30 Juz. Seluruh sarana dan administrasi telah mengadopsi sistem digital modern.",
                'urutan' => 3,
                'is_active' => true,
            ]
        ];
        foreach ($sejarahs as $sej) {
            Sejarah::create($sej);
        }

        // 3. Seed Fasilitas
        Fasilitas::truncate();
        $fasilitases = [
            [
                'nama' => "Masjid Jami' Riyadussalikin",
                'kategori' => "Ibadah",
                'deskripsi' => "Masjid megah dua lantai dengan kapasitas 1.500 jamaah, berfungsi sebagai pusat ibadah dan kajian kitab kuning harian.",
                'ikon' => "masjid",
                'urutan' => 1,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ],
            [
                'nama' => "Asrama Santri Modern",
                'kategori' => "Hunian",
                'deskripsi' => "Asrama bersih dan nyaman yang dilengkapi dengan ranjang bertingkat, kasur busa berkualitas, lemari pribadi, serta sirkulasi udara yang baik.",
                'ikon' => "home",
                'urutan' => 2,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ],
            [
                'nama' => "Laboratorium Komputer & Bahasa",
                'kategori' => "Pendidikan",
                'deskripsi' => "Fasilitas lab komputer ber-AC dengan koneksi internet fiber optik untuk praktik informatika dan pembelajaran bahasa asing interaktif.",
                'ikon' => "computer",
                'urutan' => 3,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ],
            [
                'nama' => "Perpustakaan Digital",
                'kategori' => "Pendidikan",
                'deskripsi' => "Perpustakaan dengan koleksi ribuan kitab kuning klasik, buku teks umum, serta akses ke e-book ilmiah nasional.",
                'ikon' => "book-open",
                'urutan' => 4,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ]
        ];
        foreach ($fasilitases as $fas) {
            Fasilitas::create($fas);
        }

        // 4. Seed Ekstrakurikuler
        Ekstrakurikuler::truncate();
        $ekskuls = [
            [
                'nama' => "Pramuka & Kepanduan",
                'deskripsi' => "Membentuk karakter disiplin, tangguh, mandiri, dan berjiwa kepemimpinan melalui kegiatan kepanduan yang rutin dilaksanakan setiap pekan.",
                'gambar' => null,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ],
            [
                'nama' => "Seni Kaligrafi Islam",
                'deskripsi' => "Pelatihan menulis indah Al-Qur'an (khat) menggunakan berbagai media kertas, kanvas, hingga dekorasi dinding masjid.",
                'gambar' => null,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ],
            [
                'nama' => "Klub Bahasa Arab & Inggris",
                'deskripsi' => "Pembiasaan percakapan harian (muhadatsah/conversation) serta kompetisi pidato dan debat bahasa asing.",
                'gambar' => null,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ],
            [
                'nama' => "Hadrah & Rebana",
                'deskripsi' => "Seni musik islami selawat hadrah khas pesantren untuk melestarikan kebudayaan dan menumbuhkan kecintaan kepada Rasulullah.",
                'gambar' => null,
                'is_active' => true,
                'tampil_di' => "keduanya",
            ]
        ];
        foreach ($ekskuls as $ekskul) {
            Ekstrakurikuler::create($ekskul);
        }

        // 5. Seed Prestasi
        Prestasi::truncate();
        $prestasis = [
            [
                'judul' => "Juara 1 Lomba Pidato Bahasa Arab",
                'kategori' => "akademik",
                'tingkat' => "Provinsi",
                'tahun' => 2025,
                'deskripsi' => "Santri Riyadussalikin meraih juara pertama dalam ajang Pekan Olahraga dan Seni Antar Pondok Pesantren (POSPEDA) tingkat Provinsi.",
                'gambar' => null,
            ],
            [
                'judul' => "Juara 3 MHQ (Musabaqah Hifzhil Qur'an) 10 Juz",
                'kategori' => "keagamaan",
                'tingkat' => "Nasional",
                'tahun' => 2025,
                'deskripsi' => "Prestasi gemilang di tingkat nasional dalam cabang hafalan Al-Qur'an 10 juz putra yang diselenggarakan oleh Kementerian Agama.",
                'gambar' => null,
            ],
            [
                'judul' => "Medali Emas Kejuaraan Pencak Silat Pagar Nusa",
                'kategori' => "non_akademik",
                'tingkat' => "Kabupaten",
                'tahun' => 2026,
                'deskripsi' => "Membawa pulang medali emas kelas tanding remaja dalam Kejuaraan Pencak Silat antar pelajar se-Kabupaten.",
                'gambar' => null,
            ]
        ];
        foreach ($prestasis as $pres) {
            Prestasi::create($pres);
        }

        // 6. Seed Berita
        Berita::truncate();
        $adminUser = User::whereIn('role', ['super_admin', 'admin'])->first();
        $userId = $adminUser ? $adminUser->id : 1;

        $beritas = [
            [
                'user_id' => $userId,
                'judul' => "Pembukaan Tahun Ajaran Baru 2026/2027 dan Khutbah Ta'aruf",
                'slug' => Str::slug("Pembukaan Tahun Ajaran Baru 2026/2027 dan Khutbah Ta'aruf"),
                'konten' => "Pondok Pesantren Riyadussalikin resmi membuka kegiatan belajar mengajar tahun ajaran 2026/2027. Acara ini diawali dengan Khutbah Ta'aruf yang dipimpin langsung oleh Pengasuh Pondok, KH. Ahmad Rofi'i, Lc., M.A. Dalam sambutannya, beliau menekankan pentingnya meluruskan niat dalam menuntut ilmu di pesantren...",
                'gambar' => null,
                'kategori' => "kegiatan",
                'is_published' => true,
                'published_at' => now(),
                'views' => 152,
            ],
            [
                'user_id' => $userId,
                'judul' => "Pengumuman Hasil Seleksi Calon Santri Baru Gelombang 1",
                'slug' => Str::slug("Pengumuman Hasil Seleksi Calon Santri Baru Gelombang 1"),
                'konten' => "Panitia Penerimaan Santri Baru (PSB) Riyadussalikin resmi merilis hasil ujian seleksi Gelombang 1. Bagi para pendaftar yang dinyatakan lulus seleksi, diwajibkan melakukan daftar ulang secara administratif mulai tanggal 20 hingga 25 Juli 2026 melalui portal admin masing-masing...",
                'gambar' => null,
                'kategori' => "pengumuman",
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views' => 342,
            ],
            [
                'user_id' => $userId,
                'judul' => "Kunjungan Studi Banding dari Pondok Pesantren Darussalam",
                'slug' => Str::slug("Kunjungan Studi Banding dari Pondok Pesantren Darussalam"),
                'konten' => "Pondok Pesantren Riyadussalikin mendapat kehormatan menerima kunjungan silaturahmi sekaligus studi banding dari jajaran pengurus Pondok Pesantren Darussalam. Kunjungan ini berfokus pada diskusi seputar manajemen pengelolaan kurikulum tahfidz dan digitalisasi administrasi pesantren...",
                'gambar' => null,
                'kategori' => "berita",
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views' => 98,
            ]
        ];
        foreach ($beritas as $ber) {
            Berita::create($ber);
        }

        // 7. Seed Agenda
        Agenda::truncate();
        $agendas = [
            [
                'judul' => "Ujian Akhir Semester Ganjil",
                'deskripsi' => "Ujian tertulis dan lisan (syafahi) untuk seluruh santri jenjang SMP dan SMA.",
                'tgl_mulai' => now()->addDays(5)->format('Y-m-d'),
                'tgl_selesai' => now()->addDays(12)->format('Y-m-d'),
                'jam_mulai' => "07:30:00",
                'jam_selesai' => "12:30:00",
                'kategori' => "akademik",
                'lokasi' => "Gedung Sekolah Utama",
                'is_active' => true,
            ],
            [
                'judul' => "Peringatan Hari Santri Nasional",
                'deskripsi' => "Upacara bendera bersama dilanjutkan dengan festival selawat dan perlombaan antar kamar.",
                'tgl_mulai' => now()->addDays(20)->format('Y-m-d'),
                'tgl_selesai' => now()->addDays(20)->format('Y-m-d'),
                'jam_mulai' => "08:00:00",
                'jam_selesai' => "16:00:00",
                'kategori' => "umum",
                'lokasi' => "Lapangan Utama Pondok",
                'is_active' => true,
            ],
            [
                'judul' => "Sosialisasi Alur Pendaftaran Santri Baru (PPDB)",
                'deskripsi' => "Live streaming dan tanya jawab interaktif mengenai tata cara pendaftaran santri baru jalur online.",
                'tgl_mulai' => now()->addDays(2)->format('Y-m-d'),
                'tgl_selesai' => now()->addDays(2)->format('Y-m-d'),
                'jam_mulai' => "09:00:00",
                'jam_selesai' => "11:00:00",
                'kategori' => "ppdb",
                'lokasi' => "Aula Pertemuan & YouTube Live",
                'is_active' => true,
            ]
        ];
        foreach ($agendas as $age) {
            Agenda::create($age);
        }
    }
}
