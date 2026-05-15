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
            'pesan'    => 'required|string',
        ]);

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
