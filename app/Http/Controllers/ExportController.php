<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\PpdbPendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    /**
     * Pastikan hanya admin yang bisa export
     */
    private function authorizeAdmin()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }
    }

    // ─────────────────────────────────────────
    // EXPORT PENDAFTAR PPDB
    // ─────────────────────────────────────────

    public function pendaftarExcel(Request $request)
    {
        $this->authorizeAdmin();

        $query = PpdbPendaftaran::with(['siswa', 'ayah', 'ibu', 'user'])
            ->when($request->tingkat, fn($q) => $q->where('tingkat', $request->tingkat))
            ->when($request->status,  fn($q) => $q->where('status',  $request->status))
            ->orderBy('tanggal_daftar', 'desc')
            ->get();

        $filename = 'pendaftar_ppdb_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($query) {
            $file = fopen('php://output', 'w');
            // BOM agar Excel bisa baca UTF-8
            fputs($file, "\xEF\xBB\xBF");

            // Header kolom
            fputcsv($file, [
                'No. Registrasi', 'Nama Lengkap', 'Tingkat', 'Jenis Kelamin',
                'NIK', 'NISN', 'Tempat Lahir', 'Tanggal Lahir',
                'Alamat', 'No. WhatsApp', 'Email Pendaftar',
                'Nama Ayah', 'No. HP Ayah',
                'Nama Ibu',  'No. HP Ibu',
                'Status', 'Tanggal Daftar',
            ]);

            foreach ($query as $row) {
                $siswa = $row->siswa;
                $ayah  = $row->ayah;
                $ibu   = $row->ibu;

                fputcsv($file, [
                    $row->no_reg,
                    $siswa?->nama_lengkap,
                    strtoupper($row->tingkat),
                    $siswa?->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                    $siswa?->nik,
                    $siswa?->nisn,
                    $siswa?->tempat_lahir,
                    $siswa?->tanggal_lahir,
                    $siswa?->alamat,
                    $siswa?->no_hp,
                    $row->user?->email,
                    $ayah?->nama,
                    $ayah?->no_hp,
                    $ibu?->nama,
                    $ibu?->no_hp,
                    self::statusLabel($row->status),
                    $row->tanggal_daftar,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function pendaftarPdf(Request $request)
    {
        $this->authorizeAdmin();

        $data = PpdbPendaftaran::with(['siswa', 'user'])
            ->when($request->tingkat, fn($q) => $q->where('tingkat', $request->tingkat))
            ->when($request->status,  fn($q) => $q->where('status',  $request->status))
            ->orderBy('tanggal_daftar', 'desc')
            ->get();

        $filter = [
            'tingkat' => $request->tingkat ? strtoupper($request->tingkat) : 'Semua',
            'status'  => $request->status  ? self::statusLabel($request->status) : 'Semua',
        ];

        return view('exports.pendaftar-pdf', compact('data', 'filter'));
    }

    // ─────────────────────────────────────────
    // EXPORT DATA GURU
    // ─────────────────────────────────────────

    public function guruExcel()
    {
        $this->authorizeAdmin();

        $data     = Guru::orderBy('nama')->get();
        $filename = 'data_guru_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, [
                'Nama Lengkap', 'NIP / NIK', 'Jabatan', 'Mata Pelajaran',
                'Pendidikan Terakhir', 'No. HP', 'Email', 'Tanggal Bergabung',
            ]);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->nama,
                    $row->nip ?? $row->nik ?? '-',
                    $row->jabatan,
                    $row->mata_pelajaran,
                    $row->pendidikan_terakhir,
                    $row->no_hp,
                    $row->email,
                    $row->tanggal_bergabung,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function guruPdf()
    {
        $this->authorizeAdmin();
        $data = Guru::orderBy('nama')->get();
        return view('exports.guru-pdf', compact('data'));
    }

    // ─────────────────────────────────────────
    // EXPORT DATA SISWA (Users dengan role siswa)
    // ─────────────────────────────────────────

    public function siswaExcel()
    {
        $this->authorizeAdmin();

        $data     = User::where('role', 'siswa')->orderBy('name')->get();
        $filename = 'data_siswa_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, ['Nama', 'Email', 'No. WhatsApp', 'Tanggal Daftar']);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->name,
                    $row->email,
                    $row->whatsapp ?? '-',
                    $row->created_at->format('d/m/Y'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function siswaPdf()
    {
        $this->authorizeAdmin();
        $data = User::where('role', 'siswa')->orderBy('name')->get();
        return view('exports.siswa-pdf', compact('data'));
    }

    public function downloadSiswaTemplate()
    {
        $this->authorizeAdmin();

        $filename = 'template_impor_siswa.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // BOM

            // Header kolom template
            fputcsv($file, [
                'nama_lengkap', 'jenis_kelamin', 'nik', 'nisn', 'nis', 
                'no_hp', 'email', 'tempat_lahir', 'tanggal_lahir', 
                'alamat', 'kelurahan_desa', 'kecamatan', 'kabupaten_kota', 
                'provinsi', 'tingkat', 'status_penerimaan', 'asal_sekolah'
            ]);

            // Tambahkan baris contoh (dummy data)
            fputcsv($file, [
                'Ahmad Fauzi', 'L', '3202151212990001', '0123456789', '', 
                '081234567890', 'ahmad.fauzi@gmail.com', 'Pangandaran', '2012-08-15', 
                'Jl. Raya Padaherang No. 12', 'Padaherang', 'Padaherang', 'Pangandaran', 
                'Jawa Barat', 'smp', 'diterima_ula', 'SDN 1 Padaherang'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ─────────────────────────────────────────
    // HELPER
    // ─────────────────────────────────────────

    private static function statusLabel(string $status): string
    {
        return match ($status) {
            'pending'         => 'Menunggu Verifikasi',
            'jadwal_tes'      => 'Jadwal Tes Ditentukan',
            'tes_berlangsung' => 'Tes Berlangsung',
            'wawancara'       => 'Wawancara',
            'diterima_ula'    => 'Diterima - Ula',
            'diterima_idadiyah' => 'Diterima - Idadiyah',
            'diterima_wustho' => 'Diterima - Wustho',
            'diterima_ulya'   => 'Diterima - Ulya',
            'ditolak'         => 'Tidak Diterima',
            'mengundurkan_diri' => 'Mengundurkan Diri',
            default           => ucfirst($status),
        };
    }
}
