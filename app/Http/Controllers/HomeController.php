<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Sejarah;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $prestasi = Cache::remember('home_prestasi', 60 * 60, function () {
            return Prestasi::latest()->take(6)->get();
        });

        $visiMisi = Cache::remember('home_visi_misi', 60 * 60, function () {
            return \App\Models\VisiMisi::where('is_active', true)->latest()->first();
        });

        $beritaTerbaru = Cache::remember('home_berita', 60 * 60, function () {
            return \App\Models\Berita::with('user')
                ->published()
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        $spmbSetting = \App\Models\SpmbSetting::where('is_active', true)->first();

        // Check if current date is within range
        if ($spmbSetting) {
            $now = now();
            if (!$now->between($spmbSetting->tgl_buka, $spmbSetting->tgl_tutup)) {
                $spmbSetting = null;
            }
        }

        return Inertia::render('Home', [
            'prestasi' => $prestasi,
            'visiMisi' => $visiMisi,
            'beritaTerbaru' => $beritaTerbaru,
            'spmbSetting' => $spmbSetting,
        ]);
    }

    public function tentangPondok(): Response
    {
        $fasilitasList = Cache::remember('fasilitas', 60 * 60, function () {
            return Fasilitas::where('is_active', true)->orderBy('urutan')->get();
        });

        $sejarahList = Cache::remember('sejarah', 60 * 60, function () {
            return Sejarah::where('is_active', true)->orderBy('urutan')->get();
        });

        return Inertia::render('TentangPondok', [
            'fasilitasList' => $fasilitasList,
            'sejarahList'   => $sejarahList,
        ]);
    }

    public function fasilitas(): Response
    {
        $fasilitasList = Cache::remember('fasilitas', 60 * 60, function () {
            return Fasilitas::where('is_active', true)->orderBy('urutan')->get();
        });

        $webSetting = \App\Models\WebSetting::first();

        return Inertia::render('Fasilitas', [
            'fasilitasList' => $fasilitasList,
            'webSetting'    => $webSetting,
        ]);
    }

    public function sejarah(): Response
    {
        $sejarahList = Cache::remember('sejarah', 60 * 60, function () {
            return Sejarah::where('is_active', true)->orderBy('urutan')->get();
        });

        return Inertia::render('Sejarah', [
            'sejarahList' => $sejarahList,
        ]);
    }

    public function visiMisi(): Response
    {
        $visiMisi = Cache::remember('home_visi_misi', 60 * 60, function () {
            return \App\Models\VisiMisi::where('is_active', true)->latest()->first();
        });

        return Inertia::render('VisiMisi', [
            'visiMisi' => $visiMisi,
        ]);
    }
}
