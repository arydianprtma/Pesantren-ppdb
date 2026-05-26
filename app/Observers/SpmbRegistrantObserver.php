<?php

namespace App\Observers;

use App\Models\SpmbPendaftaran;
use App\Models\User;
use App\Services\WhatsappService;
use Filament\Notifications\Notification;

class SpmbRegistrantObserver
{
    public function __construct(
        protected WhatsappService $whatsapp
    ) {}

    /**
     * Kirim notifikasi WA saat status pendaftaran berubah.
     */
    public function updated(SpmbPendaftaran $pendaftaran): void
    {
        if (! $pendaftaran->isDirty('status')) {
            return;
        }

        $siswa = $pendaftaran->siswa;

        if (! $siswa?->no_hp) {
            return;
        }

        $message = $this->buildMessage(
            nama:   $siswa->nama_lengkap,
            status: $pendaftaran->status,
            tingkat: strtoupper($pendaftaran->tingkat),
            noReg:  $pendaftaran->no_reg,
        );

        if ($message) {
            $this->whatsapp->sendMessage($siswa->no_hp, $message);
        }
    }

    /**
     * Kirim notifikasi database ke admin saat ada pendaftaran baru.
     */
    public function created(SpmbPendaftaran $pendaftaran): void
    {
        $admins = User::role(['admin', 'super_admin'])->get();

        if ($admins->isEmpty()) {
            return;
        }

        Notification::make()
            ->title('Pendaftaran SPMB Baru')
            ->body("Siswa baru: {$pendaftaran->siswa?->nama_lengkap} telah mendaftar.")
            ->icon('heroicon-o-user-plus')
            ->iconColor('success')
            ->sendToDatabase($admins);
    }

    /**
     * Buat isi pesan WA sesuai status.
     */
    protected function buildMessage(string $nama, string $status, string $tingkat, string $noReg): ?string
    {
        $body = match ($status) {
            'jadwal_tes' => "Halo *{$nama}*, pendaftaran Anda (No: {$noReg}) untuk tingkat *{$tingkat}* telah diverifikasi. Silakan cek dashboard untuk melihat *Jadwal Tes* Anda.",

            'tes_berlangsung' => "Halo *{$nama}*, saat ini Anda sedang dalam tahap *Tes Seleksi*. Semangat dan berikan yang terbaik!",

            'wawancara' => "Selamat *{$nama}*! Anda telah lolos tahap tes dan dijadwalkan untuk *Wawancara*. Silakan cek dashboard untuk detail waktunya.",

            'diterima_ula',
            'diterima_wustho',
            'diterima_ulya' => sprintf(
                "ALHAMDULILLAH! Selamat *%s*, Anda dinyatakan *DITERIMA* di Pondok Pesantren Riyadussalikin (Tingkat: %s - %s). Silakan segera lakukan daftar ulang melalui dashboard pendaftaran.",
                $nama,
                $tingkat,
                ucfirst(str_replace('diterima_', '', $status)),
            ),

            'ditolak' => "Mohon maaf *{$nama}*, berdasarkan hasil seleksi, pendaftaran Anda belum dapat kami terima saat ini. Tetap semangat!",

            default => null,
        };

        if ($body === null) {
            return null;
        }

        return implode("\n", [
            "*PENGUMUMAN SPMB*",
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
     * URL portal SPMB (port terpisah dari app utama).
     */
    protected function portalUrl(): string
    {
        $parts = parse_url(config('app.url') ?? 'http://localhost');

        return sprintf('%s://%s:8081', (string) ($parts['scheme'] ?? 'http'), (string) ($parts['host'] ?? 'localhost'));
    }
}