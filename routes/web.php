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
Route::get('/smp', [HomeController::class, 'smp'])->name('sekolah.smp');

// Contact Routes
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Proxy route for SPMB storage to avoid CORS issues
Route::get('/spmb-storage/{path}', function ($path) {
    $fullPath = config('filesystems.disks.spmb.root') . '/' . $path;

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
});

use App\Http\Controllers\VerificationController;

// Verification Route (Portal Utama - Port 8000)
// Hapus middleware auth sementara untuk debugging atau gunakan pengecekan manual di controller
Route::get('/verifikasi/{no_reg}', [VerificationController::class, 'verify'])
    ->name('verifikasi.publik');

require __DIR__.'/auth.php';
