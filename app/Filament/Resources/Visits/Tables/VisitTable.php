<?php

namespace App\Filament\Resources\Visits\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VisitTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ip')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('visited_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('user_agent')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Read-only
            ])
            ->bulkActions([
                // Read-only
            ])
            ->defaultSort('visited_at', 'desc');
    }
}
