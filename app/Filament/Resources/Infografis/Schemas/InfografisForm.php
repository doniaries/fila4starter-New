<?php

namespace App\Filament\Resources\Infografis\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InfografisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->maxLength(255),
                FileUpload::make('gambar')
                    ->label('Gambar Infografis')
                    ->image()
                    ->disk('public')
                    ->directory('infografis')
                    ->visibility('public')
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                    ->maxSize(5120)
                    ->helperText('Upload gambar infografis (max 5MB). Format: JPEG, JPG, PNG, WEBP. Akan dikonversi ke WebP.')
                    ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                        return \App\Helpers\ImageHelper::convertToWebp($file, 'infografis', 1024);
                    }),
                \Filament\Forms\Components\Select::make('kategori')
                    ->searchable()
                    ->options(\App\Models\Tag::pluck('name', 'name'))
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return \App\Models\Tag::create($data)->name;
                    }),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
