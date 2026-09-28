<?php

namespace App\Filament\Resources\Bidangs\Schemas;

use App\Models\Bidang;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BidangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Bidang')
                            ->schema([

                                Select::make('parent_id')
                                    ->label('Induk Bidang (Pilih jika ini adalah Sub Bidang)')
                                    ->relationship('parent', 'name')
                                    ->searchable()
                                    ->preload(),

                                TextInput::make('name')
                                    ->label('Nama Bidang')
                                    ->required()
                                    ->extraInputAttributes(['style' => 'text-transform: uppercase;'])
                                    ->dehydrateStateUsing(fn(?string $state) => $state ? mb_strtoupper($state) : null)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                                TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Bidang::class, 'slug', ignoreRecord: true),

                            ])->columns(1),
                    ])->columnSpan('full')
            ]);
    }
}
