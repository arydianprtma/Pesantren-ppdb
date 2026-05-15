<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Berita;
use App\Models\Prestasi;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghasilkan sitemap XML untuk website Pesantren';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pembuatan sitemap...');

        $sitemap = Sitemap::create();

        // 1. Halaman Statis
        $sitemap->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
        $sitemap->add(Url::create('/berita')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
        $sitemap->add(Url::create('/prestasi')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
        $sitemap->add(Url::create('/fasilitas')->setPriority(0.6)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
        $sitemap->add(Url::create('/sejarah')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create('/visi-misi')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create('/tentang-pondok')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));
        $sitemap->add(Url::create('/contact')->setPriority(0.4)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        // 2. Halaman Berita Dinamis
        Berita::where('is_published', true)->get()->each(function (Berita $berita) use ($sitemap) {
            $sitemap->add(
                Url::create("/berita/{$berita->slug}")
                    ->setLastModificationDate($berita->updated_at)
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // 3. Simpan ke file public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap berhasil dibuat di public/sitemap.xml');
    }
}
