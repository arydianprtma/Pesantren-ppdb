<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ImageController;
use App\Models\ContactMessage;
use App\Models\PpdbRegistrant;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('visi-misi');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Berita (News) Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Optimized Image Routes
Route::get('/img/{size}/{path}', [ImageController::class, 'show'])
    ->where('path', '.*')
    ->name('image.optimized');


// School Routes
Route::get('/sma-ksatria-nusantara', function () {
    return inertia('ComingSoon', ['title' => 'SMA Ksatria Nusantara']);
})->name('sekolah.sma');

Route::get('/smp-dharma-ksatria', function () {
    return inertia('ComingSoon', ['title' => 'SMP Dharma Ksatria']);
})->name('sekolah.smp');

// API for Realtime Sidebar
Route::get('/api/sidebar-counts', function () {
    // Hanya hitung jika user login (opsional, tapi lebih aman)
    if (!auth()->check()) {
        return response()->json(['ppdb' => 0, 'messages' => 0]);
    }

    return response()->json([
        'ppdb' => PpdbRegistrant::where('status', 'pending')->count(),
        'messages' => ContactMessage::where('is_read', false)->count(),
    ]);
});
