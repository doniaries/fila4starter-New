<?php

namespace App\Filament\Resources\Data\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Group::make()
                    ->columnSpan(2)
                    ->schema([
                        Section::make('Informasi Data')
                            ->schema([
                                TextInput::make('nama_data')
                                    ->label('Nama Data / Judul')
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
                                Select::make('kategori_data_id')
                                    ->relationship('kategoriData', 'nama')
                                    ->label('Kategori')
                                    ->required()
                                    ->createOptionForm([
                                        TextInput::make('nama')
                                            ->label('Nama Kategori')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                                Select::make('struktur_organisasi_id')
                                    ->relationship('strukturOrganisasi', 'name')
                                    ->label('Asal Data / Bidang')
                                    ->placeholder('Pilih Bidang/Unit')
                                    ->searchable()
                                    ->preload(),
                                Textarea::make('deskripsi')
                                    ->label('Deskripsi Singkat')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Section::make('Lampiran File')
                            ->schema([
                                FileUpload::make('file')
                                    ->label('Upload Data')
                                    ->disk('public')
                                    ->directory('bank-data/files')
                                    ->acceptedFileTypes(['application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                                    ->maxSize(5012) // 5 MB
                                    ->helperText('Format PDF, DOC, XLS. Maks: 5MB'),
                            ])->columns(1),
                    ]),
                Group::make()
                    ->columnSpan(1)
                    ->schema([
                        Section::make('Pengaturan Pribadi')
                            ->schema([
                                FileUpload::make('cover')
                                    ->label('Cover / Thumbnail')
                                    ->image()
                                    ->disk('public')
                                    ->directory('bank-data/covers')
                                    ->optimize('webp')
                                    ->imageResizeTargetWidth('800')
                                    ->maxSize(5120),
                                TextInput::make('tahun_terbit')
                                    ->label('Tahun Data')
                                    ->numeric()
                                    ->required()
                                    ->default(now()->year)
                                    ->maxLength(4),
                                Toggle::make('is_public')
                                    ->label('Bisa Diakses Publik')
                                    ->helperText('Jika OFF, data ini hanya rahasia admin aplikasi.')
                                    ->default(true),
                                \Filament\Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now())
                                    ->native(false)
                                    ->displayFormat('d F Y H:i')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                    ]),
            ]);
    }
}
