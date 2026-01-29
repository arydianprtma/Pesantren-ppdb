<?php

namespace App\Observers;

use App\Models\ContactMessage;

use Filament\Notifications\Notification;
use App\Models\User;

class ContactMessageObserver
{
    /**
     * Handle the ContactMessage "created" event.
     */
    public function created(ContactMessage $contactMessage): void
    {
        \Illuminate\Support\Facades\Log::info('Observer Created terpanggil untuk message ID: ' . $contactMessage->id);

        $admin = User::first();

        if (!$admin) {
            return;
        }

        $notifId = \Illuminate\Support\Str::uuid()->toString();
        $data = [
            'actions' => [],
            'body' => "Dari: {$contactMessage->nama}",
            'duration' => 'persistent',
            'format' => 'filament',
            'icon' => 'heroicon-o-check-circle',
            'iconColor' => 'success',
            'status' => 'success',
            'title' => 'Pesan Baru Masuk',
            'view' => 'filament-notifications::notification',
            'viewData' => [],
        ];

        \Illuminate\Support\Facades\DB::table('notifications')->insert([
            'id' => $notifId,
            'type' => 'Filament\Notifications\DatabaseNotification',
            'notifiable_type' => get_class($admin),
            'notifiable_id' => $admin->id,
            'data' => json_encode($data),
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \Illuminate\Support\Facades\Log::info('Manual DB Insert Notification Success.');
    }

    /**
     * Handle the ContactMessage "updated" event.
     */
    public function updated(ContactMessage $contactMessage): void
    {
        //
    }

    /**
     * Handle the ContactMessage "deleted" event.
     */
    public function deleted(ContactMessage $contactMessage): void
    {
        //
    }

    /**
     * Handle the ContactMessage "restored" event.
     */
    public function restored(ContactMessage $contactMessage): void
    {
        //
    }

    /**
     * Handle the ContactMessage "force deleted" event.
     */
    public function forceDeleted(ContactMessage $contactMessage): void
    {
        //
    }
}
