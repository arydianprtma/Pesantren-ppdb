<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', function() { return "Home Work"; });
// Route::get('/test-route', function() { return "Laravel is working"; });
Route::get('/tentang-pondok', [HomeController::class, 'tentangPondok'])->name('tentang-pondok');
Route::get('/fasilitas', [HomeController::class, 'fasilitas'])->name('fasilitas');
Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('visi-misi');
Route::get('/jadwal', [HomeController::class, 'jadwal'])->name('jadwal');

// Berita Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Prestasi Routes
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');

// Sekolah Routes (Placeholders)
Route::get('/sma', function () { return Inertia::render('ComingSoon'); })->name('sekolah.sma');
Route::get('/smp-dharma-ksatria', [HomeController::class, 'smp'])->name('sekolah.smp');
Route::get('/smp-dharma-ksatria/profil', [HomeController::class, 'smpProfil'])->name('sekolah.smp.profil');

// Contact Routes
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Sitemap Dinamis
Route::get('/sitemap.xml', function () {
    $baseUrl = 'https://www.riyadussalikin.ponpes.id';
    $now = now()->toAtomString();

    // Halaman statis
    $staticPages = [
        ['url' => $baseUrl,                         'priority' => '1.0', 'freq' => 'weekly'],
        ['url' => $baseUrl . '/berita',             'priority' => '0.9', 'freq' => 'daily'],
        ['url' => $baseUrl . '/prestasi',           'priority' => '0.8', 'freq' => 'weekly'],
        ['url' => $baseUrl . '/jadwal',             'priority' => '0.7', 'freq' => 'weekly'],
        ['url' => $baseUrl . '/tentang-pondok',     'priority' => '0.6', 'freq' => 'monthly'],
        ['url' => $baseUrl . '/visi-misi',          'priority' => '0.6', 'freq' => 'monthly'],
        ['url' => $baseUrl . '/fasilitas',          'priority' => '0.6', 'freq' => 'monthly'],
        ['url' => $baseUrl . '/kontak',             'priority' => '0.5', 'freq' => 'monthly'],
        ['url' => $baseUrl . '/smp-dharma-ksatria', 'priority' => '0.5', 'freq' => 'monthly'],
        ['url' => $baseUrl . '/smp-dharma-ksatria/profil', 'priority' => '0.5', 'freq' => 'monthly'],
    ];

    // Halaman berita dinamis
    $beritaPages = \App\Models\Berita::select('slug', 'updated_at')
        ->latest('updated_at')
        ->get()
        ->map(fn($b) => [
            'url'      => $baseUrl . '/berita/' . $b->slug,
            'lastmod'  => $b->updated_at->toAtomString(),
            'priority' => '0.7',
            'freq'     => 'monthly',
        ]);

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($staticPages as $page) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$page['url']}</loc>\n";
        $xml .= "    <lastmod>{$now}</lastmod>\n";
        $xml .= "    <changefreq>{$page['freq']}</changefreq>\n";
        $xml .= "    <priority>{$page['priority']}</priority>\n";
        $xml .= "  </url>\n";
    }

    foreach ($beritaPages as $page) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$page['url']}</loc>\n";
        $xml .= "    <lastmod>{$page['lastmod']}</lastmod>\n";
        $xml .= "    <changefreq>{$page['freq']}</changefreq>\n";
        $xml .= "    <priority>{$page['priority']}</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

// Proxy route for PPDB storage to avoid CORS issues
Route::get('/ppdb-storage/{path}', function ($path) {
    $root = config('filesystems.disks.ppdb.root');
    if (!$root) {
        abort(404);
    }
    
    $fullPath = $root . '/' . $path;

    if (!file_exists($fullPath)) {
        abort(404);
    }

    $file = file_get_contents($fullPath);
    $type = mime_content_type($fullPath);

    return response($file)->header('Content-Type', $type);
})->where('path', '.*');

// Proxy route for PPDB public storage to avoid CORS issues
Route::get('/ppdb-public-storage/{path}', function ($path) {
    $root = config('filesystems.disks.ppdb_public.root');
    if (!$root) {
        abort(404);
    }
    
    $fullPath = $root . '/' . $path;

    if (!file_exists($fullPath)) {
        abort(404);
    }

    $file = file_get_contents($fullPath);
    $type = mime_content_type($fullPath);

    return response($file)->header('Content-Type', $type);
})->where('path', '.*');

// Login Route (for Admin access)
// Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
// Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Scan QR Route untuk Admin
    Route::get('/scan-qr', function () {
        return Inertia::render('ScanQR');
    })->name('scan.qr');
});

// Export Routes (Admin Only)
Route::middleware('auth')->prefix('export')->name('export.')->group(function () {
    Route::get('/pendaftar/excel', [\App\Http\Controllers\ExportController::class, 'pendaftarExcel'])->name('pendaftar.excel');
    Route::get('/pendaftar/pdf',   [\App\Http\Controllers\ExportController::class, 'pendaftarPdf'])->name('pendaftar.pdf');
    Route::get('/guru/excel',      [\App\Http\Controllers\ExportController::class, 'guruExcel'])->name('guru.excel');
    Route::get('/guru/pdf',        [\App\Http\Controllers\ExportController::class, 'guruPdf'])->name('guru.pdf');
    Route::get('/siswa/excel',     [\App\Http\Controllers\ExportController::class, 'siswaExcel'])->name('siswa.excel');
    Route::get('/siswa/pdf',       [\App\Http\Controllers\ExportController::class, 'siswaPdf'])->name('siswa.pdf');
    Route::get('/siswa/template',  [\App\Http\Controllers\ExportController::class, 'downloadSiswaTemplate'])->name('siswa.template');
});

use App\Http\Controllers\VerificationController;

// Verification Route (Portal Utama - Port 8000)
// Hapus middleware auth sementara untuk debugging atau gunakan pengecekan manual di controller
Route::get('/verifikasi/{no_reg}', [VerificationController::class, 'verify'])
    ->name('verifikasi.publik');

// Fallback login route to redirect to Filament login page and satisfy named route requirements
Route::get('/login', fn () => redirect('/portal/login'))->name('login');

require __DIR__.'/auth.php';
