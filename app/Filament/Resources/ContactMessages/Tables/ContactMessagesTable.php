<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

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
            ->recordActions([
                Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading('Detail Pesan Masuk')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->infolist([
                        Section::make()
                            ->schema([
                                TextEntry::make('nama')
                                    ->label('Nama Pengirim'),
                                TextEntry::make('whatsapp')
                                    ->label('Nomor WhatsApp'),
                                TextEntry::make('email')
                                    ->label('Email'),
                                TextEntry::make('pesan')
                                    ->label('Isi Pesan')
                                    ->columnSpanFull(),
                                TextEntry::make('created_at')
                                    ->label('Diterima Pada')
                                    ->dateTime(),
                            ])
                            ->columns(2),
                    ])
                    ->mountUsing(function ($record) {
                        if (!$record->is_read) {
                            $record->update(['is_read' => true]);
                        }
                    }),

                Action::make('reply')
                    ->label('Balas WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn($record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->whatsapp) . '?text=' . urlencode("Assalamu'alaikum, Perkenalkan saya admin pondok pesantren Riyadussalikin. Ada yang bisa saya bantu? {$record->nama}, terima kasih telah menghubungi kami."))
                    ->openUrlInNewTab(),

                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->recordAction('view')
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
