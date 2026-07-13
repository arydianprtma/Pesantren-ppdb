<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Agenda & Jadwal')
                ->description('Kelola data agenda, jadwal seleksi, wawancara, atau pengumuman.')
                ->schema([
                    TextInput::make('judul')
                        ->label('Judul Agenda')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Tes Seleksi Akademik Gelombang 1'),

                    Select::make('kategori')
                        ->label('Kategori')
                        ->options([
                            'ppdb' => 'Penerimaan Santri Baru (SPMB)',
                            'akademik' => 'Akademik & Sekolah',
                            'umum' => 'Kegiatan Umum / Pondok',
                        ])
                        ->required()
                        ->default('umum'),

                    DatePicker::make('tgl_mulai')
                        ->label('Tanggal Mulai')
                        ->required()
                        ->native(false)
                        ->displayFormat('d M Y'),

                    DatePicker::make('tgl_selesai')
                        ->label('Tanggal Selesai')
                        ->helperText('Kosongkan jika hanya berlangsung 1 hari.')
                        ->native(false)
                        ->displayFormat('d M Y')
                        ->nullable(),

                    TimePicker::make('jam_mulai')
                        ->label('Jam Mulai')
                        ->native(false)
                        ->nullable()
                        ->seconds(false),

                    TimePicker::make('jam_selesai')
                        ->label('Jam Selesai')
                        ->native(false)
                        ->nullable()
                        ->seconds(false),

                    TextInput::make('lokasi')
                        ->label('Lokasi / Tempat')
                        ->maxLength(255)
                        ->placeholder('Contoh: Aula Masjid Raya Pondok')
                        ->columnSpanFull(),

                    Textarea::make('deskripsi')
                        ->label('Keterangan / Deskripsi')
                        ->rows(4)
                        ->placeholder('Jelaskan rincian agenda di sini...')
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]),
        ]);
    }
}
