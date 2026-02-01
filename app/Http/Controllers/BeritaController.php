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
        $beritas = Berita::with('user')
            ->published()
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
        $berita = Berita::with('user')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related news (same category, excluding current) - more items for carousel
        $relatedBeritas = Berita::with('user')
            ->published()
            ->where('id', '!=', $berita->id)
            ->where('kategori', $berita->kategori)
            ->latest('published_at')
            ->take(10)
            ->get();

        // If not enough related by category, get latest news
        if ($relatedBeritas->count() < 6) {
            $relatedBeritas = Berita::with('user')
                ->published()
                ->where('id', '!=', $berita->id)
                ->latest('published_at')
                ->take(10)
                ->get();
        }

        return Inertia::render('Berita/Show', [
            'berita' => $berita,
            'relatedBeritas' => $relatedBeritas,
        ]);
    }
}
