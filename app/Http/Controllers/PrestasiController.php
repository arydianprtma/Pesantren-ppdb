<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Prestasi::query();

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Filter berdasarkan tahun jika ada
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        // Generate cache key berdasarkan filter
        $cacheKey = 'prestasi_list_' . serialize($request->only(['kategori', 'tahun']));

        $prestasi = \Illuminate\Support\Facades\Cache::remember($cacheKey, 60 * 60, function () use ($query) {
            return $query->latest('tahun')
                ->latest('created_at')
                ->get()
                ->groupBy('kategori');
        });

        // Ambil daftar tahun unik untuk filter (cached)
        $tahunList = \Illuminate\Support\Facades\Cache::remember('prestasi_tahun_list', 60 * 60, function () {
            return Prestasi::select('tahun')
                ->distinct()
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');
        });

        return Inertia::render('Prestasi', [
            'prestasi' => $prestasi,
            'tahunList' => $tahunList,
            'filters' => [
                'kategori' => $request->kategori ?? 'semua',
                'tahun' => $request->tahun ?? '',
            ],
        ]);
    }
}
