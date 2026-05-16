<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Prestasi;
use App\Models\Sejarah;
use App\Models\WebSetting;
use App\Models\SpmbPendaftaran;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
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
        $webSetting = WebSetting::first();
        
        $ekstrakurikuler = Ekstrakurikuler::where('is_active', true)->get();

        // Calculate statistics
        $stats = [
            'santri_aktif' => ($webSetting->base_santri_aktif ?? 0) + SpmbPendaftaran::whereIn('status', ['diterima', 'diterima_ula', 'diterima_wustho', 'diterima_ulya'])->count(),
            'ekstrakurikuler' => Ekstrakurikuler::where('is_active', true)->count(),
            'akreditasi' => $webSetting->akreditasi ?? 'A',
            'kelulusan' => $webSetting->persentase_kelulusan ?? '100%',
            'tenaga_pengajar' => Guru::where('is_active', true)->count(),
            'unit_sekolah' => $webSetting->jml_unit_sekolah ?? 0,
        ];

        // Check if current date is within range for status info
        if ($spmbSetting) {
            $now = now()->startOfDay();
            $tglBuka = \Illuminate\Support\Carbon::parse($spmbSetting->tgl_buka)->startOfDay();
            $tglTutup = \Illuminate\Support\Carbon::parse($spmbSetting->tgl_tutup)->endOfDay();
            
            $spmbSetting->is_open = $now->between($tglBuka, $tglTutup);
        }

        return Inertia::render('Home', [
            'prestasi' => $prestasi,
            'visiMisi' => $visiMisi,
            'beritaTerbaru' => $beritaTerbaru,
            'spmbSetting' => $spmbSetting,
            'stats' => $stats,
            'ekstrakurikuler' => $ekstrakurikuler,
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

        $webSetting = WebSetting::first();
        $stats = [
            'santri_aktif' => ($webSetting->base_santri_aktif ?? 0) + SpmbPendaftaran::whereIn('status', ['diterima', 'diterima_ula', 'diterima_wustho', 'diterima_ulya'])->count(),
            'ekstrakurikuler' => Ekstrakurikuler::where('is_active', true)->count(),
            'akreditasi' => $webSetting->akreditasi ?? 'A',
            'kelulusan' => $webSetting->persentase_kelulusan ?? '100%',
            'tenaga_pengajar' => Guru::where('is_active', true)->count(),
            'unit_sekolah' => $webSetting->jml_unit_sekolah ?? 0,
        ];

        return Inertia::render('TentangPondok', [
            'fasilitasList' => $fasilitasList,
            'sejarahList'   => $sejarahList,
            'stats'         => $stats,
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
