<?php

namespace App\Filament\Resources\Pengumumen\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PengumumanForm
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
                RichEditor::make('isi')
                    ->columnSpanFull(),
                FileUpload::make('file')
                    ->label('Lampiran')
                    ->disk('public')
                    ->directory('pengumuman')
                    ->visibility('public')
                    ->maxSize(5120)
                    ->helperText('Upload lampiran (max 5MB). Format: PDF, DOC, DOCX, atau gambar'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
