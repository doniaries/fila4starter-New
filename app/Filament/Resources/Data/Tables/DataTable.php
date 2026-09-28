<?php

namespace App\Filament\Resources\Data\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class DataTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Sampul')
                    ->square(),
                TextColumn::make('nama_data')
                    ->label('Nama Data')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('kategoriData.nama')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pariwisata' => 'success',
                        'Pemuda' => 'warning',
                        'Olahraga' => 'danger',
                        'Regulasi' => 'primary',
                        'Kepegawaian' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('strukturOrganisasi.name')
                    ->label('Asal Data')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('tahun_terbit')
                    ->label('Tahun')
                    ->sortable(),
                IconColumn::make('is_public')
                    ->label('Publik')
                    ->boolean(),
                TextColumn::make('views')
                    ->label('Dilihat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('downloads')
                    ->label('Diunduh')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('kategori_data_id')
                    ->relationship('kategoriData', 'nama')
                    ->label('Kategori'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
