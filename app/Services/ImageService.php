<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageService
{
    /**
     * Memproses upload gambar dengan resize dan optimasi.
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param int $maxWidth
     * @param int $quality
     * @return string Path file yang disimpan
     */
    public static function processUpload(UploadedFile $file, string $directory, int $maxWidth = 1200, int $quality = 80): string
    {
        // Buat nama file unik
        $filename = time() . '_' . uniqid() . '.webp'; // Gunakan WebP untuk ukuran lebih kecil
        $path = $directory . '/' . $filename;

        // Proses gambar dengan Intervention Image
        $img = Image::make($file->getRealPath());

        // Resize jika lebih lebar dari maxWidth (tetap jaga aspek rasio)
        $img->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize(); // Jangan perbesar jika gambar aslinya kecil
        });

        // Simpan ke disk (default: public)
        $content = (string) $img->encode('webp', $quality);
        Storage::disk('public')->put($path, $content);

        return $path;
    }
}
