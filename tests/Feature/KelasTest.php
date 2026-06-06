<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KelasTest extends TestCase
{
    use RefreshDatabase;

    public function test_kelas_database_operations(): void
    {
        $kelas = Kelas::create([
            'nama' => 'SMP Kelas 7',
            'tingkat' => 'smp',
            'kapasitas' => 32,
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('kelas', [
            'nama' => 'SMP Kelas 7',
            'tingkat' => 'smp',
            'kapasitas' => 32,
        ]);
    }
}
