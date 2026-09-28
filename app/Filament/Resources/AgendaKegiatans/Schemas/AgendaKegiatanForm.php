<?php

namespace App\Filament\Resources\AgendaKegiatans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AgendaKegiatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1: Informasi Dasar
                Section::make('Informasi Dasar')
                    ->schema([
                        TextInput::make('nama_agenda')
                            ->label('Nama Agenda')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Rapat Koordinasi Bulanan')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->hidden()
                            ->dehydrated(),
                        Textarea::make('uraian_agenda')
                            ->label('Uraian Kegiatan')
                            ->required()
                            ->placeholder('Deskripsi lengkap agenda kegiatan')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                // Section 2: Detail Pelaksanaan
                Section::make('Detail Pelaksanaan')
                    ->schema([
                        TextInput::make('penyelenggara')
                            ->label('Penyelenggara')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Dinas Komunikasi dan Informatika'),
                        TextInput::make('tempat')
                            ->label('Tempat')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Ruang Rapat Lt. 3'),
                    ])
                    ->columns(2),

                // Section 3: Waktu Pelaksanaan
                Section::make('Waktu Pelaksanaan')
                    ->schema([
                        // Tanggal dan Waktu Mulai
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('dari_tanggal')
                                    ->label('Tanggal Mulai')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d F Y')
                                    ->default(now()),
                                TimePicker::make('waktu_mulai')
                                    ->label('Waktu Mulai')
                                    ->seconds(false)
                                    ->default(now()->format('H:00')),
                            ]),

                        // Tanggal dan Waktu Selesai
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('sampai_tanggal')
                                    ->label('Tanggal Selesai')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d F Y')
                                    ->afterOrEqual('dari_tanggal')
                                    ->default(fn(callable $get) => $get('dari_tanggal') ?? now()),
                                TimePicker::make('waktu_selesai')
                                    ->label('Waktu Selesai')
                                    ->seconds(false)
                                    ->default(now()->addHour()->format('H:00')),
                            ]),
                    ])
                    ->columns(1),

                // Section 4: Media
                Section::make('Media')
                    ->description('Upload foto agenda kegiatan')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('foto')
                            ->label('Foto Agenda')
                            ->image()
                            ->disk('public')
                            ->directory('agendas')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->helperText('Upload foto agenda (max 5MB). Format: JPEG, JPG, PNG, WEBP. Akan dikonversi ke WebP.')
                            ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                                return \App\Helpers\ImageHelper::convertToWebp($file, 'agendas', 1024);
                            })
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
