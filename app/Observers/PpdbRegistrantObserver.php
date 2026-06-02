<?php

namespace App\Observers;

use App\Models\PpdbPendaftaran;
use App\Models\PpdbSiswa;
use App\Models\User;
use App\Services\WhatsappService;
use Filament\Notifications\Notification;
use Carbon\Carbon;

class PpdbRegistrantObserver
{
    public function __construct(
        protected WhatsappService $whatsapp
    ) {}

    /**
     * Kirim notifikasi WA saat status pendaftaran berubah.
     */
    public function updated(PpdbPendaftaran $pendaftaran): void
    {
        if (! $pendaftaran->isDirty('status')) {
            return;
        }

        $siswa = $pendaftaran->siswa;

        if (! $siswa?->no_hp) {
            return;
        }

        // --- AUTOMATIC NIS GENERATION ---
        $acceptedStatuses = ['diterima_ula', 'diterima_wustho', 'diterima_ulya'];
        if (in_array($pendaftaran->status, $acceptedStatuses)) {
            if ($siswa && !$siswa->nis) {
                // Determine kode jenjang
                $kodeJenjang = match ($pendaftaran->status) {
                    'diterima_ula' => '1',
                    'diterima_wustho' => '2',
                    'diterima_ulya' => '3',
                    default => '0',
                };
                
                $year = Carbon::parse($pendaftaran->tanggal_daftar ?? now())->format('y');
                $prefix = $year . $kodeJenjang; // e.g., '261' for 2026 Ula
                
                // Find the latest NIS with this prefix
                $lastSiswa = PpdbSiswa::where('nis', 'like', $prefix . '%')
                    ->orderBy('nis', 'desc')
                    ->first();
                
                $nextSeq = 1;
                if ($lastSiswa && $lastSiswa->nis) {
                    $lastSeq = (int) substr($lastSiswa->nis, strlen($prefix));
                    $nextSeq = $lastSeq + 1;
                }
                
                $siswa->nis = $prefix . sprintf('%04d', $nextSeq);
                $siswa->save();
            }
        }
        // --------------------------------

        $message = $this->buildMessage(
            nama:   $siswa->nama_lengkap,
            status: $pendaftaran->status,
            tingkat: strtoupper($pendaftaran->tingkat),
            noReg:  $pendaftaran->no_reg,
            nis:    $siswa->nis,
        );

        if ($message) {
            $this->whatsapp->sendMessage($siswa->no_hp, $message);
        }
    }

    /**
     * Kirim notifikasi database ke admin saat ada pendaftaran baru.
     */
    public function created(PpdbPendaftaran $pendaftaran): void
    {
        $admins = User::role(['admin', 'super_admin'])->get();

        if ($admins->isEmpty()) {
            return;
        }

        Notification::make()
            ->title('Pendaftaran PPDB Baru')
            ->body("Siswa baru: {$pendaftaran->siswa?->nama_lengkap} telah mendaftar.")
            ->icon('heroicon-o-user-plus')
            ->iconColor('success')
            ->sendToDatabase($admins);
    }

    /**
     * Buat isi pesan WA sesuai status.
     */
    protected function buildMessage(string $nama, string $status, string $tingkat, string $noReg, ?string $nis = null): ?string
    {
        $body = match ($status) {
            'jadwal_tes' => "Halo *{$nama}*, pendaftaran Anda (No: {$noReg}) untuk tingkat *{$tingkat}* telah diverifikasi. Silakan cek dashboard untuk melihat *Jadwal Tes* Anda.",

            'tes_berlangsung' => "Halo *{$nama}*, saat ini Anda sedang dalam tahap *Tes Seleksi*. Semangat dan berikan yang terbaik!",

            'wawancara' => "Selamat *{$nama}*! Anda telah lolos tahap tes dan dijadwalkan untuk *Wawancara*. Silakan cek dashboard untuk detail waktunya.",

            'diterima_ula',
            'diterima_wustho',
            'diterima_ulya' => sprintf(
                "ALHAMDULILLAH! Selamat *%s*, Anda dinyatakan *DITERIMA* di Pondok Pesantren Riyadussalikin (Tingkat: %s - %s).\n\n*Nomor Induk Siswa (NIS) Anda:* %s\n\nSilakan segera lakukan daftar ulang melalui dashboard pendaftaran.",
                $nama,
                $tingkat,
                ucfirst(str_replace('diterima_', '', $status)),
                $nis ?? '-',
            ),

            'ditolak' => "Mohon maaf *{$nama}*, berdasarkan hasil seleksi, pendaftaran Anda belum dapat kami terima saat ini. Tetap semangat!",

            default => null,
        };

        if ($body === null) {
            return null;
        }

        return implode("\n", [
            "*PENGUMUMAN PPDB*",
            "*Pondok Pesantren Riyadussalikin*",
            "",
            "Assalamu'alaikum wr. wb.,",
            "",
            $body,
            "",
            "Cek status pendaftaran Anda di:",
            $this->portalUrl(),
            "",
            "_Pesan ini dikirim otomatis oleh sistem. Mohon tidak membalas._",
        ]);
    }

    /**
     * URL portal PPDB (port terpisah dari app utama).
     */
    protected function portalUrl(): string
    {
        $parts = parse_url(config('app.url') ?? 'http://192.168.1.8');

        return sprintf('%s://%s:8001', (string) ($parts['scheme'] ?? 'http'), (string) ($parts['host'] ?? '192.168.1.8'));
    }
}