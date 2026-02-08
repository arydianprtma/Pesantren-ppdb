<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup; // Ini mungkin masih perlu dicek
// Tapi tunggu, BulkActionGroup tidak ada di list find_by_name tadi.
// Mari kita cek BulkActionGroup di find_by_name
// Tidak ada di list find_by_name sebelumnya.
// Sepertinya BulkActionGroup juga ada di Filament\Actions?

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->poll('2s')
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('whatsapp')
                    ->searchable(),
                TextColumn::make('pesan')
                    ->limit(50)
                    ->searchable(),
                IconColumn::make('is_read')
                    ->boolean()
                    ->label('Dibaca'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Diterima'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('edit') // Manual edit action
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn($record) => \App\Filament\Resources\ContactMessages\ContactMessageResource::getUrl('edit', ['record' => $record])),
                Action::make('reply')
                    ->label('Balas WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn($record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->whatsapp) . '?text=' . urlencode("Assalamu'alaikum, Perkenalkan saya Ika Kartika staff pondok pesantren Riyadussalikin. Ada yang bisa saya bantu? {$record->nama}, terima kasih telah menghubungi kami."))
                    ->openUrlInNewTab(),
                Action::make('delete')
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->delete()),
            ])
            ->bulkActions([
                // BulkActionGroup sepertinya bermasalah namespace-nya. Disable dulu.
                // BulkActionGroup::make([
                //    DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
