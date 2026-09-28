<?php

namespace App\Filament\Resources\StrukturOrganisasis\Schemas;


use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class StrukturOrganisasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Jabatan & Pegawai')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Select::make('bidang_id')
                                    ->label('Bidang / Sub Bidang')
                                    ->relationship('bidang', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('name')
                                    ->label('Nama Jabatan (Misal: Kepala Bidang, Kasi)')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                                    ->extraInputAttributes(['style' => 'text-transform: uppercase;'])
                                    ->dehydrateStateUsing(fn(?string $state) => $state ? mb_strtoupper($state) : null),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->hidden()
                                    ->dehydrated(),

                                TextInput::make('pimpinan')
                                    ->label('Nama Pegawai / Pejabat')
                                    ->required()
                                    ->maxLength(255)
                                    ->extraInputAttributes(['style' => 'text-transform: uppercase;'])
                                    ->dehydrateStateUsing(fn(?string $state) => $state ? mb_strtoupper($state) : null),
                                    
                                Select::make('user_id')
                                    ->label('Akun Pegawai (Opsional)')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload(),

                                FileUpload::make('foto')
                                    ->label('Foto Profil')
                                    ->avatar()
                                    ->imageEditor()
                                    ->circleCropper()
                                    ->directory('struktur-organisasi/pimpinan')
                                    ->disk('public'),
                            ]),

                    ]),
            ]);
    }
}
