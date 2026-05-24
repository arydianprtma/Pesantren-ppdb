<?php

namespace App\Filament\Resources\Kontaks\Pages;

use App\Filament\Resources\Kontaks\KontakResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditKontak extends EditRecord
{
    protected static string $resource = KontakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /**
     * Konversi otomatis berbagai format Google Maps ke embed URL
     * sebelum disimpan ke database.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['maps_link'])) {
            $data['maps_link'] = $this->convertToEmbedUrl($data['maps_link']);
        }

        return $data;
    }

    private function convertToEmbedUrl(string $input): string
    {
        $input = trim($input);

        if (empty($input)) {
            return '';
        }

        // 1. Jika berupa tag iframe, ekstrak src-nya saja
        if (str_contains($input, '<iframe')) {
            if (preg_match('/src=["\']([^"\']+)["\']/', $input, $matches)) {
                return $matches[1];
            }
        }

        // 2. Sudah berupa link embed google maps langsung
        if (str_contains($input, 'maps/embed') || str_contains($input, 'google.com/maps/embed')) {
            return $input;
        }

        // 3. Jika berupa short link, lakukan request curl untuk follow redirect
        if (str_contains($input, 'maps.app.goo.gl') || str_contains($input, 'goo.gl/maps')) {
            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $input);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
                $response = curl_exec($ch);
                $effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                curl_close($ch);

                if (!empty($effectiveUrl) && $effectiveUrl !== $input) {
                    $input = $effectiveUrl;
                }
            } catch (\Exception $e) {
                // Abaikan error, gunakan input asli
            }
        }

        // 4. Deteksi URL Google Maps panjang setelah redirect atau input langsung
        if (str_contains($input, 'google.com/maps') || str_contains($input, 'google.co.id/maps')) {
            // Coba cari koordinat @lat,lng
            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $input, $m)) {
                $lat = $m[1];
                $lng = $m[2];
                
                // Cari nama tempat jika ada di URL path (antara /place/ dan /@)
                if (preg_match('/\/maps\/place\/([^\/@]+)/', $input, $placeMatches)) {
                    $placeName = urldecode($placeMatches[1]);
                    return "https://maps.google.com/maps?q=" . urlencode($placeName) . "&z=15&output=embed";
                }

                return "https://maps.google.com/maps?q={$lat},{$lng}&z=15&output=embed";
            }
            
            // Coba cari parameter q=
            $query = parse_url($input, PHP_URL_QUERY);
            if ($query) {
                parse_str($query, $queryParams);
                if (isset($queryParams['q'])) {
                    return "https://maps.google.com/maps?q=" . urlencode($queryParams['q']) . "&z=15&output=embed";
                }
            }
        }

        // 5. Jika berupa URL lain (bukan Google Maps), biarkan apa adanya
        if (filter_var($input, FILTER_VALIDATE_URL)) {
            return $input;
        }

        // 6. Jika berupa teks alamat/pencarian biasa, bungkus ke query search embed
        return "https://maps.google.com/maps?q=" . urlencode($input) . "&z=15&output=embed";
    }

    protected function afterSave(): void
    {
        Cache::forget('global_kontak');
    }
}
