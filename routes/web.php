<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BeritaController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('visi-misi');
Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Berita (News) Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

