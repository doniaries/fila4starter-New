<?php

namespace App\Filament\Resources\SambutanPimpinans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SambutanPimpinanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto_pimpinan')
                    ->label('Foto Pimpinan')
                    ->disk('public')
                    ->circular()
                    ->width(50)
                    ->height(50),
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(fn($state) => $state),
                TextColumn::make('nama_pimpinan')
                    ->label('Nama Pimpinan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
