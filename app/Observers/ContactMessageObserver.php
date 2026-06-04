<?php

namespace App\Observers;

use App\Models\ContactMessage;

use Filament\Notifications\Notification;
use Filament\Actions\Action;
use App\Models\User;

class ContactMessageObserver
{
    /**
     * Handle the ContactMessage "created" event.
     */
    public function created(ContactMessage $contactMessage): void
    {
        $admins = User::role(['admin', 'super_admin'])->get();

        if ($admins->isEmpty()) {
            $admins = User::whereIn('role', ['admin', 'super_admin'])->get();
        }

        if ($admins->isEmpty()) {
            return;
        }

        Notification::make()
            ->title('Pesan Baru Masuk')
            ->body("Dari: {$contactMessage->nama}")
            ->icon('heroicon-o-envelope')
            ->iconColor('success')
            ->actions([
                Action::make('lihat')
                    ->label('Lihat Pesan')
                    ->url(route('filament.portal.resources.pesan-masuk.index'))
                    ->button(),
            ])
            ->sendToDatabase($admins)
            ->broadcast($admins);
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
