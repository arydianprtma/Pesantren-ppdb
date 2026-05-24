<?php

namespace Tests\Feature;

use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JadwalPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the public jadwal page can be rendered.
     */
    public function test_jadwal_page_is_accessible(): void
    {
        $response = $this->get('/jadwal');

        $response->assertStatus(200);
    }

    /**
     * Test if agenda data is loaded on the page.
     */
    public function test_jadwal_page_receives_agendas(): void
    {
        Agenda::create([
            'judul' => 'Ujian Seleksi SPMB Gelombang 1',
            'deskripsi' => 'Ujian seleksi akademik dan wawancara',
            'tgl_mulai' => now()->addDays(5)->format('Y-m-d'),
            'kategori' => 'spmb',
            'lokasi' => 'Gedung Madrasah Utama',
            'is_active' => true,
        ]);

        $response = $this->get('/jadwal');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page
            ->component('Jadwal')
            ->has('agendas')
        );
    }
}
