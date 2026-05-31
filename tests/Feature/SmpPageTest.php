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
     * Test if smp page receives agendas of kategori spmb.
     */
    public function test_smp_page_receives_agendas(): void
    {
        Agenda::create([
            'judul' => 'Ujian Seleksi SPMB Gelombang 1',
            'deskripsi' => 'Ujian seleksi akademik dan wawancara',
            'tgl_mulai' => now()->addDays(5)->format('Y-m-d'),
            'kategori' => 'spmb',
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
            'is_unggulan' => true,
        ]);

        \App\Models\Ekstrakurikuler::create([
            'nama' => 'Paskibra',
            'deskripsi' => 'Klub Paskibra',
            'is_active' => true,
            'is_unggulan' => false,
        ]);

        $response = $this->get(route('sekolah.smp'));

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Smp')
            ->has('agendas', 1) // Only category 'spmb' agenda is passed
            ->has('ekstrakurikuler', 1) // Only is_unggulan=true is passed
        );
    }
}
