<?php

namespace App\Filament\Resources\DataSiswa\Pages;

use App\Filament\Resources\DataSiswa\DataSiswaResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class ViewDataSiswa extends ViewRecord
{
    protected static string $resource = DataSiswaResource::class;

    public function infolist(Schema $infolist): Schema
    {
        return $infolist->components([
            Section::make()
                ->schema([
                    Grid::make(3)->schema([
                        TextEntry::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->weight('bold')
                            ->columnSpan(2),
                        TextEntry::make('pendaftaran.status')
                            ->label('Status Pendaftaran')
                            ->badge()
                            ->color(fn($state) => match($state) {
                                'diterima_ula', 'diterima_idadiyah', 'diterima_wustho', 'diterima_ulya' => 'success',
                                'ditolak' => 'danger',
                                'wawancara' => 'warning',
                                'jadwal_tes', 'tes_berlangsung' => 'info',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn($state) => match($state) {
                                'pending'           => 'Menunggu Verifikasi',
                                'jadwal_tes'        => 'Jadwal Tes',
                                'tes_berlangsung'   => 'Tes Berlangsung',
                                'wawancara'         => 'Wawancara',
                                'diterima_ula'      => 'Diterima - Ula',
                                'diterima_idadiyah'  => 'Diterima - Idadiyah',
                                'diterima_wustho'   => 'Diterima - Wustho',
                                'diterima_ulya'     => 'Diterima - Ulya',
                                'ditolak'           => 'Tidak Diterima',
                                default             => ucfirst($state ?? ''),
                            }),
                    ]),
                ])->compact(),

            Tabs::make('Detail Informasi')
                ->tabs([
                    Tab::make('Biodata & Alamat')
                        ->icon('heroicon-m-user')
                        ->schema([
                            Grid::make(3)->schema([
                                TextEntry::make('nis')->label('NIS (Nomor Induk Siswa)')->placeholder('-'),
                                TextEntry::make('nisn')->label('NISN')->placeholder('-'),
                                TextEntry::make('nik')->label('NIK')->placeholder('-'),
                                TextEntry::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->formatStateUsing(fn($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),
                                TextEntry::make('tempat_lahir')->label('Tempat Lahir'),
                                TextEntry::make('tanggal_lahir')->label('Tanggal Lahir')->date('d M Y'),
                                TextEntry::make('berkebutuhan_khusus')->label('Berkebutuhan Khusus')->placeholder('Tidak Ada'),
                            ]),
                            Section::make('Kontak & Alamat')
                                ->compact()
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextEntry::make('no_hp')->label('WhatsApp')->placeholder('-'),
                                        TextEntry::make('email_pribadi')->label('Email')->placeholder('-'),
                                        TextEntry::make('alamat')->label('Alamat')->columnSpan(3),
                                        TextEntry::make('kelurahan_desa')->label('Desa/Kel'),
                                        TextEntry::make('kecamatan')->label('Kecamatan'),
                                        TextEntry::make('kabupaten_kota')->label('Kota/Kab'),
                                    ]),
                                ]),
                        ]),

                    Tab::make('Data SPMB & Bantuan')
                        ->icon('heroicon-m-academic-cap')
                        ->schema([
                            Grid::make(3)->schema([
                                TextEntry::make('pendaftaran.no_reg')->label('No. Registrasi')->fontFamily('mono'),
                                TextEntry::make('pendaftaran.tingkat')
                                    ->label('Tingkat')
                                    ->formatStateUsing(fn($state) => strtoupper($state ?? ''))
                                    ->badge(),
                                TextEntry::make('pendaftaran.tanggal_daftar')->label('Tgl Daftar')->date('d M Y'),
                            ]),
                            Section::make('Bantuan Sosial (KIP/KPS)')
                                ->compact()
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextEntry::make('no_kps_pkh')->label('No. KPS/PKH')->placeholder('-'),
                                        TextEntry::make('no_kks')->label('No. KKS')->placeholder('-'),
                                        TextEntry::make('no_kip')->label('No. KIP')->placeholder('-'),
                                        TextEntry::make('nama_tertera_kip')->label('Nama di KIP')->placeholder('-'),
                                        TextEntry::make('no_rek_bank')->label('No. Rekening')->placeholder('-'),
                                        TextEntry::make('rekening_atas_nama')->label('Atas Nama')->placeholder('-'),
                                    ]),
                                ]),
                        ]),

                    Tab::make('Prestasi & Beasiswa')
                        ->icon('heroicon-m-trophy')
                        ->schema([
                            RepeatableEntry::make('pendaftaran.prestasi')
                                ->label('Daftar Prestasi')
                                ->schema([
                                    Grid::make(4)->schema([
                                        TextEntry::make('nama_prestasi')->label('Prestasi'),
                                        TextEntry::make('tingkat')->label('Tingkat'),
                                        TextEntry::make('tahun')->label('Tahun'),
                                        TextEntry::make('penyelenggara')->label('Penyelenggara'),
                                    ]),
                                ])->placeholder('Tidak ada data prestasi'),
                            
                            RepeatableEntry::make('pendaftaran.beasiswa')
                                ->label('Daftar Beasiswa')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextEntry::make('jenis_beasiswa')->label('Beasiswa'),
                                        TextEntry::make('penyelenggara_sumber')->label('Sumber'),
                                        TextEntry::make('tahun_mulai')->label('Mulai'),
                                    ]),
                                ])->placeholder('Tidak ada data beasiswa'),
                        ]),

                    Tab::make('Lainnya')
                        ->icon('heroicon-m-cog')
                        ->schema([
                            Grid::make(3)->schema([
                                TextEntry::make('ukuran_pakaian')->label('Ukuran Pakaian'),
                                TextEntry::make('no_sepatu')->label('No. Sepatu'),
                                TextEntry::make('no_kopiyah')->label('No. Kopiyah'),
                                TextEntry::make('no_ijazah')->label('No. Ijazah'),
                                TextEntry::make('no_skhun')->label('No. SKHUN'),
                                TextEntry::make('no_un')->label('No. UN'),
                            ]),
                        ]),
                ])->columnSpanFull(),
        ]);
    }
}
