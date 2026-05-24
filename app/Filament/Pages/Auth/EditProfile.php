<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->inlineLabel(false) // Disable inline labels for a cleaner stacked design
            ->components([
                Section::make('Profil Pengguna')
                    ->description('Perbarui foto profil, nama lengkap, dan alamat email Anda.')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->avatar()
                            ->imageResizeTargetWidth(300)
                            ->imageResizeTargetHeight(300)
                            ->directory('avatars')
                            ->maxSize(4096) // 4MB
                            ->helperText('Maksimal 4MB. Foto akan di-resize otomatis.')
                            ->columnSpanFull(),
                        
                        $this->getNameFormComponent(),
                        
                        $this->getEmailFormComponent(),
                    ])
                    ->columns(2),

                Section::make('Keamanan & Password')
                    ->description('Ganti password Anda jika diperlukan.')
                    ->schema([
                        $this->getPasswordFormComponent(),
                        
                        $this->getPasswordConfirmationFormComponent(),
                        
                        $this->getCurrentPasswordFormComponent()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
