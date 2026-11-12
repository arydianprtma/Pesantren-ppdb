<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'email'    => 'nullable|email|max:255',
            'pesan'    => 'required|string',
        ]);

        if (!app()->environment('local')) {
            $turnstileToken = $request->input('cf-turnstile-response') ?? $request->input('turnstile_token');
            $secret = config('services.cloudflare.turnstile_secret_key') ?? env('TURNSTILE_SECRET_KEY');

            if ($secret) {
                if (!$turnstileToken) {
                    return back()->withErrors([
                        'turnstile_token' => 'Verifikasi keamanan Turnstile wajib diselesaikan.',
                    ])->withInput();
                }

                $response = \Illuminate\Support\Facades\Http::asForm()->timeout(10)->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => $secret,
                    'response' => $turnstileToken,
                    'remoteip' => $request->ip(),
                ]);

                $data = $response->json();
                $allowedHostnames = [
                    'ppdb.riyadussalikin.ponpes.id',
                    'riyadussalikin.ponpes.id',
                    'www.riyadussalikin.ponpes.id',
                    'localhost',
                    '127.0.0.1',
                ];

                if (
                    !$response->successful() ||
                    !($data['success'] ?? false) ||
                    (!empty($data['action']) && $data['action'] !== 'contact') ||
                    (!empty($data['hostname']) && !in_array($data['hostname'], $allowedHostnames, true))
                ) {
                    return back()->withErrors([
                        'turnstile_token' => 'Verifikasi keamanan Turnstile gagal. Silakan coba lagi.',
                    ])->withInput();
                }
            }
        }

        $message = ContactMessage::create($validated);

        // Kirim notifikasi Filament ke semua admin
        $admins = User::all();

        Notification::make()
            ->title('Pesan Baru dari ' . $message->nama)
            ->body(str($message->pesan)->limit(80))
            ->icon('heroicon-o-envelope')
            ->iconColor('danger')
            ->sendToDatabase($admins);

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}
