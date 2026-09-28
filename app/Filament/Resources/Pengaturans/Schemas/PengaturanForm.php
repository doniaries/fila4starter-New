<?php

namespace App\Filament\Resources\Pengaturans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PengaturanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(68)
                            ->minLength(4)
                            ->helperText('Maksimal 68 karakter.')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->hidden()
                            ->dehydrated(),
                        FileUpload::make('logo')
                            ->label('Logo Instansi')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                            ->maxSize(2048)
                            ->helperText('Upload logo instansi (max 2MB). Format: JPEG, JPG, PNG, WEBP. Akan dikonversi ke WebP.')
                            ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                                return \App\Helpers\ImageHelper::convertToWebp($file, 'settings', 512);
                            }),
                        // FileUpload::make('favicon')
                        //     ->label('Favicon')
                        //     ->image()
                        //     ->disk('public')
                        //     ->directory('settings')
                        //     ->visibility('public')
                        //     ->imageEditor()
                        //     ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                        //     ->maxSize(2048)
                        //     ->helperText('Upload favicon (max 2MB). Format: JPEG, JPG, PNG'),
                    ]),
                Section::make('Contact Details')
                    ->schema([
                        \Filament\Forms\Components\Select::make('jabatan_pimpinan')
                            ->label('Jabatan Pimpinan (Unit Struktur)')
                            ->options(\App\Models\StrukturOrganisasi::pluck('name', 'name'))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function (callable $set, ?string $state) {
                                if ($state) {
                                    $struktur = \App\Models\StrukturOrganisasi::query()->where('name', $state)->first();
                                    if ($struktur) {
                                        if ($struktur->pimpinan) {
                                            $set('kepala_instansi', $struktur->pimpinan);
                                        }
                                        if ($struktur->foto) {
                                            $set('foto_pimpinan', $struktur->foto);
                                        }
                                    }
                                }
                            }),
                        \Filament\Forms\Components\Select::make('kepala_instansi')
                            ->label('Nama Pimpinan')
                            ->options(\App\Models\StrukturOrganisasi::query()->where('pimpinan', '!=', null)->pluck('pimpinan', 'pimpinan'))
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function (callable $set, ?string $state) {
                                if ($state) {
                                    $struktur = \App\Models\StrukturOrganisasi::query()->where('pimpinan', $state)->first();
                                    if ($struktur) {
                                        $set('jabatan_pimpinan', $struktur->name);
                                        if ($struktur->foto) {
                                            $set('foto_pimpinan', $struktur->foto);
                                        }
                                    }
                                }
                            }),
                        FileUpload::make('foto_pimpinan')
                            ->label('Foto Pimpinan')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->helperText('Upload foto pimpinan (max 5MB). Format: JPEG, JPG, PNG, WEBP. Akan dikonversi ke WebP.')
                            ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                                return \App\Helpers\ImageHelper::convertToWebp($file, 'settings', 1024);
                            }),
                        Textarea::make('alamat_instansi')
                            ->columnSpanFull(),
                        TextInput::make('no_telp_instansi')
                            ->tel()
                            ->maxLength(20),
                        TextInput::make('email_instansi')
                            ->email()
                            ->maxLength(255),
                    ]),
                Section::make('Social Media')
                    ->schema([
                        TextInput::make('facebook')
                            ->maxLength(255),
                        TextInput::make('twitter')
                            ->maxLength(255),
                        TextInput::make('instagram')
                            ->maxLength(255),
                        TextInput::make('youtube')
                            ->maxLength(255),
                    ]),
                Section::make('Map Coordinates')
                    ->schema([
                        TextInput::make('latitude')
                            ->numeric(),
                        TextInput::make('longitude')
                            ->numeric(),
                    ]),
            ]);
    }
}
