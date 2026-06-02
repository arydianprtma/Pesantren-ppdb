<?php

namespace App\Events;

use App\Models\PpdbPendaftaran;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PpdbPendaftaranCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pendaftaran;

    public function __construct(PpdbPendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran->load(['siswa']);
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('pendaftaran'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'created';
    }
}
