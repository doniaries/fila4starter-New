<?php

namespace App\Filament\Resources\SambutanPimpinans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use App\Models\StrukturOrganisasi; // Added import

class SambutanPimpinanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->hidden()
                    ->dehydrated(),
                Select::make('nama_pimpinan')
                    ->label('Nama Pimpinan')
                    ->options(fn() => StrukturOrganisasi::query()->where('pimpinan', '!=', null)->pluck('pimpinan', 'pimpinan'))
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (callable $set, ?string $state) {
                        if ($state) {
                            $struktur = StrukturOrganisasi::query()->where('pimpinan', $state)->first();
                            if ($struktur && $struktur->foto) {
                                $set('foto_pimpinan', $struktur->foto);
                            }
                        }
                    })
                    ->preload(),
                FileUpload::make('foto_pimpinan')
                    ->label('Foto Pimpinan')
                    ->image()
                    ->disk('public')
                    ->directory('foto-pimpinan')
                    ->visibility('public')
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                    ->maxSize(5120)
                    ->helperText('Format: JPEG, JPG, PNG, WEBP. Max 5MB. Akan dikonversi ke WebP.')
                    ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                        return \App\Helpers\ImageHelper::convertToWebp($file, 'foto-pimpinan', 1024);
                    }),
                RichEditor::make('isi_sambutan')
                    ->columnSpanFull(),
            ]);
    }
}
