<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected $token;
    protected $baseUrl = 'https://api.fonnte.com';

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    /**
     * Kirim pesan WhatsApp menggunakan Fonnte
     *
     * @param string $target Nomor tujuan (format: 08... atau 628...)
     * @param string $message Isi pesan
     * @return array
     */
    public function sendMessage(string $target, string $message)
    {
        if (!$this->token) {
            Log::error('Fonnte Token tidak ditemukan di konfigurasi.');
            return ['status' => false, 'reason' => 'Token missing'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post("{$this->baseUrl}/send", [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Default Indonesia
            ]);

            $result = $response->json();

            if ($response->successful() && ($result['status'] ?? false)) {
                Log::info("WA Terkirim ke {$target}: " . substr($message, 0, 50) . "...");
                return ['status' => true, 'data' => $result];
            }

            Log::error("Gagal kirim WA ke {$target}: " . json_encode($result));
            return ['status' => false, 'data' => $result];

        } catch (\Exception $e) {
            Log::error("Error saat kirim WA ke {$target}: " . $e->getMessage());
            return ['status' => false, 'reason' => $e->getMessage()];
        }
    }
}
