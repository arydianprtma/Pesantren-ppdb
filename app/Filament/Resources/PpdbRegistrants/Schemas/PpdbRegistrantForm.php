<?php

namespace App\Filament\Resources\PpdbRegistrants\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PpdbRegistrantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Data Pendaftaran')
                    ->tabs([
                        // TAB 1: DATA DIRI
                        Tab::make('Data Diri')
                            ->icon('heroicon-m-user')
                            ->schema([
                                TextInput::make('nama_lengkap')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('nisn')
                                    ->label('NISN')
                                    ->maxLength(20),
                                Select::make('jenjang')
                                    ->options([
                                        'MTS' => 'MTS (Setingkat SMP)',
                                        'MA' => 'MA (Setingkat SMA)',
                                    ])
                                    ->required(),
                                TextInput::make('asal_sekolah')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('jenis_kelamin')
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                    ])
                                    ->required(),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('tempat_lahir'),
                                        DatePicker::make('tanggal_lahir'),
                                    ]),
                                Textarea::make('alamat')
                                    ->label('Alamat Siswa')
                                    ->columnSpanFull(),
                                TextInput::make('no_hp')
                                    ->label('Nomor WhatsApp')
                                    ->tel(),
                            ]),

                        // TAB 2: DATA ORANG TUA
                        Tab::make('Data Orang Tua')
                            ->icon('heroicon-m-users')
                            ->schema([
                                Select::make('status_ortu')
                                    ->label('Status Orang Tua')
                                    ->options([
                                        'lengkap' => 'Lengkap (Ayah & Ibu)',
                                        'ayah_saja' => 'Ayah Saja',
                                        'ibu_saja' => 'Ibu Saja',
                                        'wali' => 'Wali',
                                    ])
                                    ->native(false),
                                Section::make('Data Ayah')
                                    ->schema([
                                        TextInput::make('nama_ayah'),
                                        TextInput::make('pekerjaan_ayah'),
                                        Select::make('pendidikan_ayah')
                                            ->label('Pendidikan Terakhir Ayah')
                                            ->options([
                                                'SD' => 'SD',
                                                'SMP' => 'SMP',
                                                'SMA' => 'SMA/SMK',
                                                'D3' => 'D3',
                                                'S1' => 'S1',
                                                'S2' => 'S2',
                                                'S3' => 'S3',
                                            ])
                                            ->native(false),
                                    ])->columns(3),
                                Section::make('Data Ibu')
                                    ->schema([
                                        TextInput::make('nama_ibu'),
                                        TextInput::make('pekerjaan_ibu'),
                                        Select::make('pendidikan_ibu')
                                            ->label('Pendidikan Terakhir Ibu')
                                            ->options([
                                                'SD' => 'SD',
                                                'SMP' => 'SMP',
                                                'SMA' => 'SMA/SMK',
                                                'D3' => 'D3',
                                                'S1' => 'S1',
                                                'S2' => 'S2',
                                                'S3' => 'S3',
                                            ])
                                            ->native(false),
                                    ])->columns(3),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('no_hp_ortu')
                                            ->label('No HP Orang Tua'),
                                        Select::make('penghasilan_ortu')
                                            ->label('Penghasilan Orang Tua')
                                            ->options([
                                                '<1jt' => '< Rp 1.000.000',
                                                '1-3jt' => 'Rp 1.000.000 - Rp 3.000.000',
                                                '3-5jt' => 'Rp 3.000.000 - Rp 5.000.000',
                                                '>5jt' => '> Rp 5.000.000',
                                            ])
                                            ->native(false),
                                    ]),
                                Section::make('Alamat Orang Tua')
                                    ->schema([
                                        Checkbox::make('alamat_ortu_sama')
                                            ->label('Sama dengan alamat siswa')
                                            ->live(),
                                        Textarea::make('alamat_ortu')
                                            ->label('Alamat Orang Tua')
                                            ->hidden(fn($get) => $get('alamat_ortu_sama'))
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // TAB 3: BERKAS
                        Tab::make('Berkas Pendaftaran')
                            ->icon('heroicon-m-document-duplicate')
                            ->schema([
                                FileUpload::make('file_ijazah')
                                    ->disk('public')->directory('ppdb/ijazah')->openable()->downloadable(),
                                FileUpload::make('file_skhu')
                                    ->disk('public')->directory('ppdb/skhu')->openable()->downloadable(),
                                FileUpload::make('file_raport')
                                    ->disk('public')->directory('ppdb/raport')->openable()->downloadable(),
                                FileUpload::make('file_kk')
                                    ->disk('public')->directory('ppdb/kk')->openable()->downloadable(),
                                FileUpload::make('file_akta')
                                    ->disk('public')->directory('ppdb/akta')->openable()->downloadable(),
                            ])->columns(2),

                        // TAB 4: STATUS
                        Tab::make('Status Verifikasi')
                            ->icon('heroicon-m-check-badge')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'pending' => 'Pending (Menunggu)',
                                        'verified' => 'Verified (Berkas Lengkap)',
                                        'accepted' => 'Accepted (Diterima)',
                                        'rejected' => 'Rejected (Ditolak)',
                                    ])
                                    ->required()
                                    ->default('pending')
                                    ->selectablePlaceholder(false),
                            ]),
                    ])->columnSpanFull()
            ]);
    }
}
