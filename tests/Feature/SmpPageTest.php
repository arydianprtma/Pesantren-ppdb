<?php

namespace Tests\Feature;

use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmpPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the public smp page can be rendered.
     */
    public function test_smp_page_is_accessible(): void
    {
        $response = $this->get(route('sekolah.smp'));

        $response->assertStatus(200);
    }

    /**
     * Test if smp page receives agendas of kategori ppdb.
     */
    public function test_smp_page_receives_agendas(): void
    {
        Agenda::create([
            'judul' => 'Ujian Seleksi PPDB Gelombang 1',
            'deskripsi' => 'Ujian seleksi akademik dan wawancara',
            'tgl_mulai' => now()->addDays(5)->format('Y-m-d'),
            'kategori' => 'ppdb',
            'lokasi' => 'Gedung Madrasah Utama',
            'is_active' => true,
        ]);

        Agenda::create([
            'judul' => 'Ujian Seleksi Akademik Umum',
            'deskripsi' => 'Ujian akademik umum',
            'tgl_mulai' => now()->addDays(5)->format('Y-m-d'),
            'kategori' => 'akademik',
            'lokasi' => 'Gedung Madrasah Utama',
            'is_active' => true,
        ]);

        \App\Models\Ekstrakurikuler::create([
            'nama' => 'Pramuka',
            'deskripsi' => 'Klub Pramuka',
            'is_active' => true,
            'tampil_di' => 'keduanya',
        ]);

        \App\Models\Ekstrakurikuler::create([
            'nama' => 'Paskibra',
            'deskripsi' => 'Klub Paskibra',
            'is_active' => true,
            'tampil_di' => 'pesantren',
        ]);

        \App\Models\Fasilitas::create([
            'nama' => 'Lapangan Olahraga',
            'kategori' => 'Olahraga',
            'ikon' => 'olahraga',
            'is_active' => true,
            'tampil_di' => 'keduanya',
        ]);

        \App\Models\Fasilitas::create([
            'nama' => 'Asrama Putra',
            'kategori' => 'Asrama',
            'ikon' => 'asrama',
            'is_active' => true,
            'tampil_di' => 'pesantren',
        ]);

        $response = $this->get(route('sekolah.smp'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Smp')
            ->has('agendas', 1) // Only category 'ppdb' agenda is passed
            ->has('ekstrakurikuler', 1) // Only tampil_di = sekolah/keduanya is passed
            ->has('fasilitas', 1) // Only tampil_di = sekolah/keduanya is passed
        );
    }

    /**
     * Test if the public smp profil page can be rendered.
     */
    public function test_smp_profil_page_is_accessible(): void
    {
        \App\Models\SekolahProfil::create([
            'profil' => 'SMP Dharma Ksatria adalah...',
            'visi' => 'Visi sekolah',
            'misi' => 'Misi sekolah',
            'nama_kepsek' => 'Drs. H. Ahmad Dahlan, M.Pd.',
            'is_active' => true,
        ]);

        $response = $this->get(route('sekolah.smp.profil'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('SmpProfil')
            ->has('profil')
        );
    }
}
