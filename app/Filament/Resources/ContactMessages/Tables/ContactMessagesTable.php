<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
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
            ->actions([ // Using standard actions() method name if possible, or sticking to structure if generator used recordActions
                EditAction::make(),
                Action::make('reply')
                    ->label('Balas WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn($record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->whatsapp) . '?text=' . urlencode("Assalamu'alaikum {$record->nama}, terima kasih telah menghubungi kami."))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
