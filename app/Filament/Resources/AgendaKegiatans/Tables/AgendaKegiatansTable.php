<?php

namespace App\Filament\Resources\AgendaKegiatans\Tables;

use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AgendaKegiatansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_agenda')
                    ->label('Nama Agenda')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_penyelenggara')
                    ->label('Penyelenggara')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tempat')
                    ->label('Tempat')
                    ->searchable(),
                TextColumn::make('dari_tanggal')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('waktu_mulai')
                    ->label('Waktu')
                    ->time('H:i'),
                TextColumn::make('sampai_tanggal')
                    ->label('Sampai')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('waktu_selesai')
                    ->label('Selesai')
                    ->time('H:i'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => static fn($state) => $state === 'Mendatang',
                        'success' => static fn($state) => $state === 'Berlangsung',
                        'gray' => static fn($state) => $state === 'Selesai',
                    ])
                    ->formatStateUsing(fn($state) => $state),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Mendatang' => 'Mendatang',
                        'Berlangsung' => 'Berlangsung',
                        'Selesai' => 'Selesai',
                    ])
                    ->query(function (Builder $query, array $data) {
                        $value = $data['value'] ?? null;
                        if (!$value) return;

                        $today = Carbon::today();
                        $now = Carbon::now();

                        if ($value === 'Mendatang') {
                            // Belum mulai: sebelum dari_tanggal (awal hari)
                            $query->whereDate('dari_tanggal', '>', $today);
                        } elseif ($value === 'Selesai') {
                            // Sudah lewat tanggal selesai, atau hari ini sama dengan sampai_tanggal namun waktu_selesai sudah lewat
                            $query->where(function ($q) use ($today, $now) {
                                $q->whereDate('sampai_tanggal', '<', $today)
                                    ->orWhere(function ($q2) use ($today, $now) {
                                        $q2->whereDate('sampai_tanggal', '=', $today)
                                            ->whereNotNull('waktu_selesai')
                                            ->whereTime('waktu_selesai', '<', $now->format('H:i:s'));
                                    });
                            });
                        } elseif ($value === 'Berlangsung') {
                            // Sedang berlangsung: (today between start and end) AND tidak selesai berdasarkan waktu di hari terakhir
                            $query->whereDate('dari_tanggal', '<=', $today)
                                ->whereDate('sampai_tanggal', '>=', $today)
                                ->where(function ($q) use ($today, $now) {
                                    $q->whereDate('sampai_tanggal', '>', $today)
                                        ->orWhereNull('waktu_selesai')
                                        ->orWhereTime('waktu_selesai', '>=', $now->format('H:i:s'));
                                });
                        }
                    }),
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
