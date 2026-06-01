<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__.'/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            'livewire/*',
        ]);

        $middleware->web(append: [
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);

        $middleware->redirectGuestsTo(fn ($request) => url('/portal/login'));

        // Trust proxies for production environment
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            if ($e instanceof \Illuminate\Auth\AuthenticationException ||
                $e instanceof \Illuminate\Validation\ValidationException ||
                $e instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
                return null;
            }

            $code = 500;
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface) {
                $code = $e->getStatusCode();
            }

            if (($code >= 400 && $code <= 429) || ($code >= 500 && $code <= 504)) {
                // 1. Detailed Logging
                \Illuminate\Support\Facades\Log::error("HTTP Error $code: " . $e->getMessage(), [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referer' => $request->header('referer'),
                    'input' => $request->except(['password', 'password_confirmation']),
                    'exception_class' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => config('app.debug') ? $e->getTraceAsString() : 'Trace hidden',
                ]);

                // 2. Map Error Messages
                $messages = [
                    400 => ['title' => 'Bad Request', 'message' => 'Permintaan tidak valid.', 'desc' => 'Sistem tidak dapat memproses permintaan Anda karena format yang salah.'],
                    401 => ['title' => 'Unauthorized', 'message' => 'Akses tidak diizinkan.', 'desc' => 'Anda harus masuk terlebih dahulu untuk mengakses halaman ini.'],
                    403 => ['title' => 'Forbidden', 'message' => 'Akses ditolak.', 'desc' => 'Anda tidak memiliki otoritas yang cukup untuk melihat konten ini.'],
                    404 => ['title' => 'Not Found', 'message' => 'Halaman tidak ditemukan.', 'desc' => 'Alamat yang Anda tuju mungkin sudah dihapus atau dipindahkan.'],
                    405 => ['title' => 'Method Not Allowed', 'message' => 'Metode tidak didukung.', 'desc' => 'Metode permintaan HTTP yang digunakan tidak diizinkan untuk endpoint ini.'],
                    408 => ['title' => 'Request Timeout', 'message' => 'Waktu permintaan habis.', 'desc' => 'Server terlalu lama menunggu respon, silakan coba lagi.'],
                    419 => ['title' => 'Page Expired', 'message' => 'Halaman kedaluwarsa.', 'desc' => 'Sesi Anda telah berakhir karena terlalu lama tidak ada aktivitas.'],
                    422 => ['title' => 'Unprocessable Entity', 'message' => 'Data tidak valid.', 'desc' => 'Input yang Anda berikan tidak dapat diproses oleh sistem kami.'],
                    429 => ['title' => 'Too Many Requests', 'message' => 'Terlalu banyak permintaan.', 'desc' => 'Anda melakukan terlalu banyak aktivitas dalam waktu singkat.'],
                    500 => ['title' => 'Internal Server Error', 'message' => 'Gangguan sistem internal.', 'desc' => 'Terjadi kesalahan pada server kami. Teknisi kami sedang memperbaikinya.'],
                    503 => ['title' => 'Service Unavailable', 'message' => 'Layanan tidak tersedia.', 'desc' => 'Server sedang dalam pemeliharaan rutin. Silakan kembali beberapa saat lagi.'],
                    504 => ['title' => 'Gateway Timeout', 'message' => 'Gateway habis waktu.', 'desc' => 'Server perantara tidak mendapatkan respon tepat waktu dari server utama.'],
                ];

                $error = $messages[$code] ?? [
                    'title' => 'Unknown Error',
                    'message' => 'Terjadi kesalahan sistem.',
                    'desc' => 'Silakan hubungi administrator jika masalah ini terus berlanjut.'
                ];

                // 3. API Support (JSON)
                if ($request->is('api/*') || $request->expectsJson()) {
                    $jsonResponse = [
                        'success' => false,
                        'code' => $code,
                        'error' => $error['title'],
                        'message' => (config('app.debug') || $code < 500) ? ($e->getMessage() ?: $error['message']) : $error['message'],
                    ];

                    if (config('app.debug')) {
                        $jsonResponse['debug'] = [
                            'exception' => get_class($e),
                            'file' => $e->getFile(),
                            'line' => $e->getLine(),
                        ];
                    }

                    return response()->json($jsonResponse, $code);
                }

                // 4. HTML Response
                return response()->view('errors.error', [
                    'code' => $code,
                    'title' => $error['title'],
                    'message' => (config('app.debug') || $code < 500) ? ($e->getMessage() ?: $error['message']) : $error['message'],
                    'description' => $error['desc'],
                    'is_client_error' => $code < 500,
                    'debug' => [
                        'message' => $e->getMessage(),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'class' => get_class($e),
                    ]
                ], $code);
            }
        });
    })->create();
