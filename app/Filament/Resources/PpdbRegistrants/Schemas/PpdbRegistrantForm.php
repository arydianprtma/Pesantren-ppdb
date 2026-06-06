<?php

namespace App\Filament\Resources\PpdbRegistrants\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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

                        // TAB 1: DATA DIRI SANTRI
                        Tab::make('Data Diri Santri')
                            ->icon('heroicon-m-user')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('no_reg')
                                            ->label('No. Registrasi')
                                            ->disabled(),

                                        Select::make('tingkat')
                                            ->label('Tingkat')
                                            ->options(['smp' => 'SMP', 'sma' => 'SMA'])
                                            ->disabled(),
                                    ]),

                                TextInput::make('siswa_nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->disabled()
                                    ->formatStateUsing(fn ($record) => $record?->siswa?->nama_lengkap),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('siswa_nisn')
                                            ->label('NISN')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->nisn),
                                        TextInput::make('siswa_nik')
                                            ->label('NIK')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->nik),
                                    ]),

                                TextInput::make('siswa_asal_sekolah')
                                    ->label('Asal Sekolah')
                                    ->disabled()
                                    ->formatStateUsing(fn ($record) => $record?->siswa?->asal_sekolah),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('siswa_jenis_kelamin')
                                            ->label('Jenis Kelamin')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => match ($record?->siswa?->jenis_kelamin) {
                                                'L' => 'Laki-laki',
                                                'P' => 'Perempuan',
                                                default => '-',
                                            }),
                                        TextInput::make('siswa_agama')
                                            ->label('Agama')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->agama),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('siswa_tempat_lahir')
                                            ->label('Tempat Lahir')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->tempat_lahir),
                                        TextInput::make('siswa_tanggal_lahir')
                                            ->label('Tanggal Lahir')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->tanggal_lahir),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('siswa_no_hp')
                                            ->label('No. HP / WhatsApp')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->no_hp),
                                        TextInput::make('siswa_email')
                                            ->label('Email')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->email_pribadi),
                                    ]),
                            ]),

                        // TAB 2: ALAMAT
                        Tab::make('Alamat')
                            ->icon('heroicon-m-map-pin')
                            ->schema([
                                Textarea::make('siswa_alamat')
                                    ->label('Alamat Lengkap')
                                    ->disabled()
                                    ->formatStateUsing(fn ($record) => $record?->siswa?->alamat)
                                    ->columnSpanFull(),

                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('siswa_kelurahan')
                                            ->label('Desa/Kelurahan')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->kelurahan_desa),
                                        TextInput::make('siswa_kecamatan')
                                            ->label('Kecamatan')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->kecamatan),
                                        TextInput::make('siswa_kabupaten')
                                            ->label('Kabupaten/Kota')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->siswa?->kabupaten_kota),
                                    ]),

                                TextInput::make('siswa_provinsi')
                                    ->label('Provinsi')
                                    ->disabled()
                                    ->formatStateUsing(fn ($record) => $record?->siswa?->provinsi),
                            ]),

                        // TAB 3: DATA ORANG TUA
                        Tab::make('Data Orang Tua')
                            ->icon('heroicon-m-users')
                            ->schema([
                                Section::make('Ayah Kandung')
                                    ->schema([
                                        TextInput::make('ayah_nama')
                                            ->label('Nama Ayah')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->ayah?->nama),
                                        TextInput::make('ayah_pekerjaan')
                                            ->label('Pekerjaan')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->ayah?->pekerjaan),
                                        TextInput::make('ayah_pendidikan')
                                            ->label('Pendidikan')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->ayah?->pendidikan),
                                    ])->columns(3),

                                Section::make('Ibu Kandung')
                                    ->schema([
                                        TextInput::make('ibu_nama')
                                            ->label('Nama Ibu')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->ibu?->nama),
                                        TextInput::make('ibu_pekerjaan')
                                            ->label('Pekerjaan')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->ibu?->pekerjaan),
                                        TextInput::make('ibu_pendidikan')
                                            ->label('Pendidikan')
                                            ->disabled()
                                            ->formatStateUsing(fn ($record) => $record?->ibu?->pendidikan),
                                    ])->columns(3),
                            ]),

                        // TAB 4: PRESTASI & BEASISWA
                        Tab::make('Prestasi & Beasiswa')
                            ->icon('heroicon-m-academic-cap')
                            ->schema([
                                Section::make('Data Prestasi')
                                    ->schema([
                                        Repeater::make('prestasi')
                                            ->relationship('prestasi')
                                            ->schema([
                                                Grid::make(2)->schema([
                                                    TextInput::make('jenis_prestasi')->label('Jenis (Sains/Seni/Olahraga/Lainnya)'),
                                                    TextInput::make('tingkat')->label('Tingkat (Nasional/Provinsi/Kota)'),
                                                ]),
                                                TextInput::make('nama_prestasi')->label('Nama Prestasi / Juara Ke-'),
                                                Grid::make(2)->schema([
                                                    TextInput::make('tahun')->label('Tahun'),
                                                    TextInput::make('penyelenggara')->label('Penyelenggara'),
                                                ]),
                                            ])
                                            ->columns(1)
                                            ->itemLabel(fn (array $state): ?string => $state['nama_prestasi'] ?? 'Prestasi Baru')
                                            ->collapsed()
                                            ->collapsible()
                                            ->cloneable()
                                            ->addActionLabel('Tambah Prestasi'),
                                    ]),

                                Section::make('Data Beasiswa')
                                    ->schema([
                                        Repeater::make('beasiswa')
                                            ->relationship('beasiswa')
                                            ->schema([
                                                TextInput::make('jenis_beasiswa')->label('Jenis Beasiswa'),
                                                TextInput::make('penyelenggara_sumber')->label('Penyelenggara / Sumber'),
                                                Grid::make(2)->schema([
                                                    TextInput::make('tahun_mulai')->label('Tahun Mulai'),
                                                    TextInput::make('tahun_selesai')->label('Tahun Selesai'),
                                                ]),
                                            ])
                                            ->columns(1)
                                            ->itemLabel(fn (array $state): ?string => $state['jenis_beasiswa'] ?? 'Beasiswa Baru')
                                            ->collapsed()
                                            ->collapsible()
                                            ->cloneable()
                                            ->addActionLabel('Tambah Beasiswa'),
                                    ]),
                            ]),

                        // TAB 5: BERKAS
                        Tab::make('Berkas Pendaftaran')
                            ->icon('heroicon-m-document-duplicate')
                            ->schema([
                                \Filament\Schemas\Components\Group::make()
                                    ->relationship('berkas')
                                    ->schema([
                                        Section::make('Berkas Wajib')
                                            ->schema([
                                                \Filament\Forms\Components\FileUpload::make('ijazah_skhu')
                                                    ->label('Ijazah / SKHU')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('akte_kelahiran')
                                                    ->label('Akte Kelahiran')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('ktp_orang_tua')
                                                    ->label('KTP Orang Tua')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('kartu_keluarga')
                                                    ->label('Kartu Keluarga')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('surat_sehat')
                                                    ->label('Surat Sehat')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('surat_kelakuan_baik')
                                                    ->label('Surat Kelakuan Baik')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                            ])->columns(2),

                                        Section::make('Berkas Opsional')
                                            ->schema([
                                                \Filament\Forms\Components\FileUpload::make('kartu_kks_pkh')
                                                    ->label('Kartu KKS/PKH')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('kartu_kps')
                                                    ->label('Kartu KPS')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('kartu_kip')
                                                    ->label('Kartu KIP')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('kartu_kis_bpjs')
                                                    ->label('Kartu KIS/BPJS Kesehatan')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                                \Filament\Forms\Components\FileUpload::make('kartu_nisn')
                                                    ->label('Kartu NISN')
                                                    ->disk('ppdb')
                                                    ->disabled()->openable()->downloadable(),
                                            ])->columns(2),
                                    ]),
                            ]),

                        // TAB 5: STATUS VERIFIKASI (editable)
                        Tab::make('Status Verifikasi')
                            ->icon('heroicon-m-check-badge')
                            ->schema([
                                Select::make('status')
                                    ->label('Status Pendaftaran')
                                    ->options([
                                        'pending'          => 'Menunggu Verifikasi',
                                        'jadwal_tes'       => 'Jadwal Tes Sudah Ditentukan',
                                        'tes_berlangsung'  => 'Tes Sedang Berlangsung',
                                        'wawancara'        => 'Tahap Wawancara',
                                        'diterima_ula'      => 'Diterima - Kelas Ula (Dasar)',
                                        'diterima_idadiyah' => 'Diterima - Kelas Idadiyah (Persiapan)',
                                        'diterima_wustho'   => 'Diterima - Kelas Wustho (Menengah)',
                                        'diterima_ulya'     => 'Diterima - Kelas Ulya (Lanjutan)',
                                        'ditolak'          => 'Tidak Diterima',
                                        'mengundurkan_diri' => 'Mengundurkan Diri',
                                    ])
                                    ->required()
                                    ->default('pending')
                                    ->selectablePlaceholder(false)
                                    ->native(false)
                                    ->live(),

                                Select::make('kelas_id')
                                    ->label('Kelas Siswa')
                                    ->relationship('kelas', 'nama', function ($query, $get) {
                                        $tingkat = $get('tingkat');
                                        $query->where('is_active', true);
                                        if ($tingkat) {
                                            $query->where('tingkat', $tingkat);
                                        }
                                        return $query;
                                    })
                                    ->nullable()
                                    ->placeholder('Belum Masuk Kelas')
                                    ->helperText('Pilih kelas untuk siswa yang sudah diterima/lulus.')
                                    ->native(false),

                                // Jadwal Tes section
                                Section::make('Jadwal Ujian Masuk')
                                    ->description('Isi informasi jadwal ujian yang akan ditampilkan ke calon santri.')
                                    ->icon('heroicon-m-calendar-days')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            DatePicker::make('jadwal_tes_tanggal')
                                                ->label('Tanggal Ujian')
                                                ->required()
                                                ->native(false)
                                                ->displayFormat('d M Y'),
                                            Select::make('jadwal_tes_jam')
                                                ->label('Jam Mulai (WIB)')
                                                ->required()
                                                ->native(false)
                                                ->options(collect(range(6, 21))->flatMap(function ($hour) {
                                                    return [
                                                        sprintf('%02d:00:00', $hour) => sprintf('%02d:00 WIB', $hour),
                                                        sprintf('%02d:30:00', $hour) => sprintf('%02d:30 WIB', $hour),
                                                    ];
                                                })->all()),
                                        ]),
                                        CheckboxList::make('jadwal_tes_jenis')
                                            ->label('Jenis Ujian yang Dilaksanakan')
                                            ->options([
                                                'psikotes'   => 'Psikotes',
                                                'akademik'   => 'Tes Akademik',
                                                'baca_quran' => 'Tes Baca Al-Quran',
                                                'sholat'     => 'Tes Ibadah',
                                            ])
                                            ->columns(2)
                                            ->required()
                                            ->columnSpanFull(),
                                        TextInput::make('jadwal_tes_lokasi')
                                            ->label('Lokasi / Ruang Ujian')
                                            ->placeholder('Contoh: Aula Utama Pesantren')
                                            ->columnSpanFull(),
                                    ])
                                    ->visible(fn ($get) => in_array($get('status'), ['jadwal_tes', 'tes_berlangsung']))
                                    ->columnSpanFull(),

                                Textarea::make('catatan_admin')
                                    ->label('Catatan Admin (Opsional)')
                                    ->placeholder('Tambahkan catatan untuk pendaftar...')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),

                    ])->columnSpanFull()
        ]);
    }
}
