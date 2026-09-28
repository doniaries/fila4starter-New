<?php

namespace App\Filament\Resources\ExternalLinks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExternalLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_link')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
                    ->url()
                    ->maxLength(255),
                FileUpload::make('logo')
                    ->label('Logo Link')
                    ->image()
                    ->disk('public')
                    ->directory('external-links')
                    ->visibility('public')
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->helperText('Upload logo link (max 2MB). Format: JPEG, JPG, PNG, WEBP. Akan dikonversi ke WebP.')
                    ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                        return \App\Helpers\ImageHelper::convertToWebp($file, 'external-links', 512);
                    }),
            ]);
    }
}
