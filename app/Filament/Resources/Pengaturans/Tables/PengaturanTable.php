<?php

namespace App\Filament\Resources\Pengaturans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengaturanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\Layout\Split::make([
                    \Filament\Tables\Columns\Layout\Stack::make([
                        ImageColumn::make('logo')
                            ->disk('public')
                            ->visibility('public')
                            ->circular()
                            ->imageWidth(80)
                            ->imageHeight(80),
                    ])->grow(false)->alignment(\Filament\Support\Enums\Alignment::Center),

                    \Filament\Tables\Columns\Layout\Stack::make([
                        // Institutional Identity
                        TextColumn::make('name')
                            ->weight('bold')
                            ->size('xl')
                            ->wrap()
                            ->searchable(),
                        TextColumn::make('kepala_instansi')
                            ->icon('heroicon-m-user')
                            ->size('sm')
                            ->color('gray'),
                        TextColumn::make('alamat_instansi')
                            ->icon('heroicon-m-map-pin')
                            ->size('xs')
                            ->color('gray')
                            ->wrap(),

                        // Spacing
                        TextColumn::make('spacer')->label('')->default('')->size('xs'),

                        // Contact Info
                        TextColumn::make('email_instansi')
                            ->icon('heroicon-m-envelope')
                            ->size('sm')
                            ->copyable()
                            ->url(fn($record) => $record?->email_instansi ? 'mailto:' . $record->email_instansi : null),
                        TextColumn::make('no_telp_instansi')
                            ->icon('heroicon-m-phone')
                            ->size('sm')
                            ->copyable(),

                        \Filament\Tables\Columns\Layout\Split::make([
                            TextColumn::make('facebook')
                                ->label('FB')
                                ->icon('heroicon-m-globe-alt')
                                ->url(fn($record) => $record?->facebook)
                                ->openUrlInNewTab()
                                ->badge()
                                ->color('info')
                                ->visible(fn($record) => filled($record?->facebook)),
                            TextColumn::make('instagram')
                                ->label('IG')
                                ->icon('heroicon-m-globe-alt')
                                ->url(fn($record) => $record?->instagram)
                                ->openUrlInNewTab()
                                ->badge()
                                ->color('danger')
                                ->visible(fn($record) => filled($record?->instagram)),
                        ])->grow(false),
                    ])->grow(true)->space(1),

                    \Filament\Tables\Columns\ViewColumn::make('map')
                        ->label('Lokasi Instansi')
                        ->view('filament.resources.pengaturans.columns.pengaturan-map')
                        ->grow(true),
                ])->from('md'),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 1,
                'xl' => 1,
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit Pengaturan'),
            ])
            ->paginated(false)
            ->toolbarActions([]);
    }
}
