<?php

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "--- TEST OBSERVER START ---\n";

try {
    echo "Creating Contact Message...\n";
    $msg = ContactMessage::create([
        'nama' => 'Observer Test Script',
        'whatsapp' => '08123456789',
        'pesan' => 'Testing observer trigger from script',
    ]);
    echo "Contact Message Created with ID: " . $msg->id . "\n";
    echo "Check laravel.log for 'Observer Created terpanggil'.\n";
} catch (\Exception $e) {
    echo "Error creating message: " . $e->getMessage() . "\n";
}

echo "--- TEST OBSERVER END ---\n";
