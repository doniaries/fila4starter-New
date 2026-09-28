<?php

namespace App\Filament\Resources\Layanans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LayananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_layanan')
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
                Section::make('Details')
                    ->schema([
                        RichEditor::make('deskripsi')
                            ->columnSpanFull(),
                        RichEditor::make('persyaratan')
                            ->columnSpanFull(),
                        RichEditor::make('biaya')
                            ->columnSpanFull(),
                        RichEditor::make('waktu_penyelesaian')
                            ->columnSpanFull(),
                    ]),
                FileUpload::make('file')
                    ->label('File Layanan')
                    ->disk('public')
                    ->directory('layanans')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->helperText('Upload file layanan (max 5MB)'),
            ]);
    }
}
