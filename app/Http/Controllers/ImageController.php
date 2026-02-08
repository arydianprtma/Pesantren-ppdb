<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{
    protected ImageManager $imageManager;

    public function __construct()
    {
        // Use GD driver (atau 'imagick' jika tersedia)
        $this->imageManager = new ImageManager(['driver' => 'gd']);
    }

    /**
     * Serve optimized image with caching
     * 
     * @param string $size - thumbnail, medium, large, or original
     * @param string $path - the image path in storage
     */
    public function show(string $size, string $path)
    {
        // Decode the path (karena ada encoding di URL)
        $fullPath = storage_path('app/public/' . $path);

        // Check if original file exists
        if (!file_exists($fullPath)) {
            abort(404, 'Image not found');
        }

        // Define sizes
        $sizes = [
            'thumbnail' => ['width' => 300, 'height' => 200, 'quality' => 70],
            'medium' => ['width' => 600, 'height' => 400, 'quality' => 80],
            'large' => ['width' => 1200, 'height' => 800, 'quality' => 85],
            'original' => null, // No resize, but still optimize
        ];

        if (!isset($sizes[$size])) {
            $size = 'medium';
        }

        // Generate cache key based on file path, size, and modification time
        $fileModTime = filemtime($fullPath);
        $cacheKey = 'img_' . md5($path . $size . $fileModTime);

        // Check if cached version exists
        $cachedPath = storage_path('app/cache/images/' . $cacheKey . '.webp');

        if (file_exists($cachedPath)) {
            return response()->file($cachedPath, [
                'Content-Type' => 'image/webp',
                'Cache-Control' => 'public, max-age=31536000', // 1 year cache
            ]);
        }

        // Create cache directory if not exists
        $cacheDir = storage_path('app/cache/images');
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }

        try {
            // Load and process image
            $image = $this->imageManager->make($fullPath);

            // Get original dimensions
            $originalWidth = $image->width();
            $originalHeight = $image->height();

            if ($sizes[$size] !== null) {
                $targetWidth = $sizes[$size]['width'];
                $targetHeight = $sizes[$size]['height'];
                $quality = $sizes[$size]['quality'];

                // Only resize if the original is larger
                if ($originalWidth > $targetWidth || $originalHeight > $targetHeight) {
                    // Fit image within bounds, maintaining aspect ratio
                    $image->fit($targetWidth, $targetHeight, function ($constraint) {
                        $constraint->upsize(); // Prevent upsizing
                    });
                }
            } else {
                // Original size but still optimize
                $quality = 85;
            }

            // Encode to WebP format for better compression
            $encoded = $image->encode('webp', $quality ?? 85);

            // Save to cache
            file_put_contents($cachedPath, $encoded);

            return response($encoded, 200, [
                'Content-Type' => 'image/webp',
                'Cache-Control' => 'public, max-age=31536000', // 1 year cache
            ]);

        } catch (\Exception $e) {
            // If image processing fails, serve original
            return response()->file($fullPath, [
                'Cache-Control' => 'public, max-age=86400',
            ]);
        }
    }

    /**
     * Clear image cache
     */
    public function clearCache()
    {
        $cacheDir = storage_path('app/cache/images');

        if (is_dir($cacheDir)) {
            $files = glob($cacheDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }

        return response()->json(['message' => 'Image cache cleared successfully']);
    }
}
