<?php

namespace App\Events;

use App\Models\SpmbPendaftaran;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpmbPendaftaranUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pendaftaran;

    public function __construct(SpmbPendaftaran $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran->load(['siswa', 'berkas']);
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('pendaftaran.' . $this->pendaftaran->id),
            new Channel('pendaftaran'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'updated';
    }
}
