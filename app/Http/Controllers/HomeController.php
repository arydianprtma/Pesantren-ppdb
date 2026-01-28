<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        // Ambil 6 prestasi terbaru untuk ditampilkan di homepage
        $prestasi = \Illuminate\Support\Facades\Cache::remember('home_prestasi', 60 * 60, function () {
            return Prestasi::latest()
                ->take(6)
                ->get();
        });

        return Inertia::render('Home', [
            'prestasi' => $prestasi,
        ]);
    }

    public function visiMisi(): Response
    {
        return Inertia::render('VisiMisi');
    }
}
