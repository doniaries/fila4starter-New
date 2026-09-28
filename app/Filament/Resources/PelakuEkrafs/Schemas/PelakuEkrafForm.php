<?php

namespace App\Filament\Resources\PelakuEkrafs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PelakuEkrafForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Group::make()
                    ->columnSpan(['default' => 3, 'lg' => 2])
                    ->schema([
                        Section::make('Data Utama')
                            ->schema([
                                TextInput::make('nama_pelaku')
                                    ->label('Nama Usaha / Pelaku Ekraf')
                                    ->required()
                                    ->maxLength(200)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(200)
                                    ->unique(ignoreRecord: true)
                                    ->hidden()
                                    ->dehydrated(),

                                Select::make('bidang_ekraf_id')
                                    ->label('Bidang Ekraf')
                                    ->relationship('KategoriEkraf', 'nama')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        \Filament\Forms\Components\TextInput::make('nama')
                                            ->label('Nama Bidang')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                                        \Filament\Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique('bidang_ekrafs', 'slug'),
                                        \Filament\Forms\Components\Toggle::make('is_active')
                                            ->label('Status Aktif')
                                            ->default(true),
                                    ]),
                                TextInput::make('kategori_usaha')
                                    ->label('Sub Kategori Usaha')
                                    ->required()
                                    ->placeholder('Contoh: Seni Pertunjukan, Kuliner, Kriya, Fotografer,radio')
                                    ->maxLength(255),


                                Select::make('user_id')
                                    ->label('User (Opsional)')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload(),


                            ])->columns(2),

                        Section::make('Data Pribadi')
                            ->schema([
                                TextInput::make('tempat_lahir')
                                    ->label('Tempat Lahir')
                                    ->placeholder('Contoh: Sijunjung')
                                    ->maxLength(100),

                                DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->displayFormat('d F Y')
                                    ->placeholder('Contoh: 01 Januari 2004')
                                    ->native(false),

                                Select::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'L' => 'Laki-Laki',
                                        'P' => 'Perempuan',
                                    ]),

                                TextInput::make('agama')
                                    ->label('Agama')
                                    ->maxLength(255),

                                TextInput::make('pendidikan_terakhir')
                                    ->label('Pendidikan Terakhir')
                                    ->maxLength(255),

                                TextInput::make('no_hp')
                                    ->label('No. HP')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->tel(),
                            ])->columns(2),

                        Section::make('Legalitas & Usaha')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('no_haki')
                                    ->label('No HAKI')
                                    ->maxLength(255),

                                \Filament\Forms\Components\DatePicker::make('tanggal_haki')
                                    ->label('Tanggal HAKI')
                                    ->native(false),

                                \Filament\Forms\Components\TextInput::make('no_izin_usaha')
                                    ->label('No Izin Usaha')
                                    ->placeholder('Akta Pendirian/ P-IRT/ NIB/ HALAL')
                                    ->maxLength(255),

                                \Filament\Forms\Components\Select::make('status_akte_pendirian')
                                    ->label('Status Akte Pendirian')
                                    ->options([
                                        'Ada' => 'Ada',
                                        'Tidak Ada' => 'Tidak Ada',
                                    ]),

                                \Filament\Forms\Components\TextInput::make('jumlah_investasi')
                                    ->label('Jumlah Investasi')
                                    ->numeric()
                                    ->default(0)
                                    ->prefix('Rp'),
                            ])->columns(2),

                        \Filament\Schemas\Components\Section::make('Tenaga Kerja & Lokasi')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('jumlah_pekerja_pria')
                                    ->label('Pekerja Pria')
                                    ->numeric()
                                    ->default(0),

                                \Filament\Forms\Components\TextInput::make('jumlah_pekerja_wanita')
                                    ->label('Pekerja Wanita')
                                    ->numeric()
                                    ->default(0),

                                \Filament\Forms\Components\TextInput::make('kecamatan')
                                    ->label('Kecamatan')
                                    ->maxLength(255),

                                \Filament\Forms\Components\TextInput::make('nagari')
                                    ->label('Nagari')
                                    ->maxLength(255),

                                \Filament\Forms\Components\Textarea::make('alamat')
                                    ->label('Alamat Lengkap')
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ]),

                \Filament\Schemas\Components\Group::make()
                    ->columnSpan(['default' => 3, 'lg' => 1])
                    ->schema([
                        \Filament\Schemas\Components\Section::make('Status & Media')
                            ->schema([
                                \Filament\Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true),

                                \Filament\Forms\Components\FileUpload::make('gambar')
                                    ->label('Foto Utama')
                                    ->image()
                                    ->directory('pelaku-ekraf')
                                    ->disk('public'),

                                \Filament\Forms\Components\FileUpload::make('gallery')
                                    ->label('Gallery Foto')
                                    ->image()
                                    ->multiple()
                                    ->directory('pelaku-ekraf/gallery')
                                    ->disk('public'),
                            ]),
                    ]),
            ]);
    }
}
