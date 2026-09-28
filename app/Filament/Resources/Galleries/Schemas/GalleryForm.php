<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, \Filament\Schemas\Components\Utilities\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->hidden()
                            ->dehydrated(),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),

                        \Filament\Forms\Components\FileUpload::make('images')
                            ->label('Foto')
                            ->image()
                            ->multiple()
                            ->directory(fn($get) => 'galleries/' . ($get('slug') ? \Illuminate\Support\Str::slug($get('slug')) : \Illuminate\Support\Str::ulid()))
                            ->reorderable()
                            ->appendFiles()
                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->helperText('Upload foto (max 5MB). Format: JPEG, JPG, PNG, WEBP. Akan dikonversi ke WebP.')
                            ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file, $get) {
                                $dir = 'galleries/' . ($get('slug') ? \Illuminate\Support\Str::slug($get('slug')) : \Illuminate\Support\Str::ulid());
                                return \App\Helpers\ImageHelper::convertToWebp($file, $dir, 1024);
                            })
                            ->columnSpanFull(),

                        DatePicker::make('published_at')
                            ->label('Tanggal Publish')
                            ->default(now()),
                    ])
            ]);
    }
}
