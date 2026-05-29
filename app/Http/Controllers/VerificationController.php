<?php

namespace App\Http\Controllers;

use App\Models\SpmbPendaftaran;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Tampilkan halaman verifikasi (Admin/Super Admin dari Portal Utama)
     */
    public function verify(Request $request, string $no_reg)
    {
        // Debugging manual untuk memastikan user terdeteksi
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if (!$user) {
            // Jika tidak terdeteksi, coba cek session via request
            if ($request->user()) {
                $user = $request->user();
            }
        }
        
        // Jika masih tidak login, arahkan ke login portal admin yang benar
        if (!$user) {
            return redirect('http://192.168.1.8:8000/portal/login');
        }

        // Cek apakah user memiliki role admin atau super_admin
        if (!$user->hasAnyRole(['admin', 'super_admin']) && ($user->role ?? null) !== 'admin' && ($user->role ?? null) !== 'super_admin') {
            return response()->view('errors.403', [
                'exception' => new \Exception('Hanya Admin atau Super Admin yang dapat melakukan verifikasi data pendaftar.')
            ], 403);
        }

        $token = $request->query('token');
        
        $pendaftaran = SpmbPendaftaran::with(['siswa', 'ayah', 'ibu'])
            ->where('no_reg', $no_reg)
            ->where('verification_token', $token)
            ->first();

        if (!$pendaftaran) {
            return view('verifikasi.show', [
                'pendaftaran' => null,
                'isValid' => false,
                'no_reg' => $no_reg
            ]);
        }

        // Gunakan view yang sama (show.blade.php) namun di project Root
        return view('verifikasi.show', [
            'pendaftaran' => $pendaftaran,
            'isValid' => !is_null($pendaftaran),
            'no_reg' => $no_reg
        ]);
    }
}
