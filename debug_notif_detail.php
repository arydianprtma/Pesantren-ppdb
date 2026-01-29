<?php

use Illuminate\Support\Facades\DB;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "--- DEBUG NOTIFICATIONS ---\n";

$user = User::first();
echo "Test User: ID={$user->id}, Name={$user->name}\n";

$notifs = DB::table('notifications')->orderBy('created_at', 'desc')->limit(5)->get();

echo "Jumlah Notifikasi ditemukan: " . $notifs->count() . "\n";

foreach ($notifs as $n) {
    echo "\n[ID: {$n->id}]\n";
    echo "Type: {$n->type}\n";
    echo "Notifiable Type: {$n->notifiable_type}\n";
    echo "Notifiable ID: {$n->notifiable_id}\n";
    echo "Read At: " . ($n->read_at ?? 'BELUM DIBACA') . "\n";
    echo "Created At: {$n->created_at}\n";
    echo "Data JSON: " . $n->data . "\n";
}

echo "\n--- END DEBUG ---\n";
