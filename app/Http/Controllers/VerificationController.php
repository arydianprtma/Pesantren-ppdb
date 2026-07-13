<?php

namespace App\Http\Controllers;

use App\Models\PpdbPendaftaran;
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
        
        // Jika belum login, arahkan ke halaman login admin
        if (!$user) {
            return redirect()->guest('/portal/login');
        }

        // Cek apakah user memiliki role admin atau super_admin
        if (!$user->hasAnyRole(['admin', 'super_admin']) && ($user->role ?? null) !== 'admin' && ($user->role ?? null) !== 'super_admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya dapat diakses oleh Administrator.');
        }

        $token = $request->query('token');
        
        $pendaftaran = PpdbPendaftaran::with(['siswa', 'ayah', 'ibu', 'user'])
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
