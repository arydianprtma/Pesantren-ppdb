<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\WebSetting::updateOrCreate(
            ['id' => 1],
            [
                'is_virtual_tour_active' => true,
                'virtual_tour_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // Placeholder
            ]
        );
    }
}
