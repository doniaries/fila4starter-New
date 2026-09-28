<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;

class PostTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['user', 'tags']))
            ->columns([
                ImageColumn::make('foto_utama')
                    ->label('Foto Utama')
                    ->disk('public')
                    ->width(100),
                TextColumn::make('title')
                    ->label('Judul Berita')
                    ->searchable()
                    ->wrap()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(fn($state) => $state),
                TextColumn::make('tags.name')
                    ->wrap()
                    ->label('Kategori')
                    ->badge()
                    ->separator(','),
                TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'warning',
                    }),
                TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                ToggleColumn::make('is_featured')
                    ->label('Slider'),
                (function () {
                    /** @var \App\Models\User|null $user */
                    $user = auth()->user();
                    return $user?->hasRole('super_admin')
                        ? TextInputColumn::make('views')
                        ->label('Dilihat')
                        ->type('number')
                        ->sortable()
                        : TextColumn::make('views')
                        ->label('Dilihat')
                        ->sortable();
                })(),
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
            ])
            ->defaultSort('published_at', 'desc');
    }
}
