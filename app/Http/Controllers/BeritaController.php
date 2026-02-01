<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Inertia\Inertia;
use Inertia\Response;

class BeritaController extends Controller
{
    /**
     * Display a listing of news
     */
    public function index(): Response
    {
        $beritas = Berita::published()
            ->latest('published_at')
            ->paginate(9);

        return Inertia::render('Berita/Index', [
            'beritas' => $beritas,
        ]);
    }

    /**
     * Display a single news article
     */
    public function show(string $slug): Response
    {
        $berita = Berita::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related news (same category, excluding current)
        $relatedBeritas = Berita::published()
            ->where('id', '!=', $berita->id)
            ->where('kategori', $berita->kategori)
            ->latest('published_at')
            ->take(3)
            ->get();

        return Inertia::render('Berita/Show', [
            'berita' => $berita,
            'relatedBeritas' => $relatedBeritas,
        ]);
    }
}
