<?php

use App\Models\User;
use App\Models\ContactMessage;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "--- DEBUG START ---\n";

// 1. Cek User
$users = User::all();
echo "Jumlah User: " . $users->count() . "\n";
foreach ($users as $user) {
    echo "User ID: {$user->id}, Name: {$user->name}, Email: {$user->email}\n";
}

// 2. Cek Tabel Notifikasi
try {
    $notifCount = DB::table('notifications')->count();
    echo "Jumlah Notifikasi di Database: " . $notifCount . "\n";

    if ($notifCount > 0) {
        $latest = DB::table('notifications')->latest()->first();
        echo "Notifikasi Terakhir untuk tipe: " . $latest->notifiable_type . " ID: " . $latest->notifiable_id . "\n";
    }
} catch (\Exception $e) {
    echo "Error cek notifikasi: " . $e->getMessage() . "\n";
}

// 3. Test Kirim Notifikasi Manual
echo "Mencoba kirim notifikasi test...\n";
if ($users->count() > 0) {
    try {
        Notification::make()
            ->title('Test Notifikasi Debug')
            ->body('Ini adalah notifikasi test dari script debug.')
            ->success()
            ->sendToDatabase($users);
        echo "Notifikasi test BERHASIL dikirim (cek database lagi).\n";
    } catch (\Exception $e) {
        echo "GAGAL kirim notifikasi: " . $e->getMessage() . "\n";
    }
} else {
    echo "User kosong, tidak bisa kirim notifikasi.\n";
}

echo "--- DEBUG END ---\n";
