<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Activity;

class LatestActivitiesWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Latest Activities';

    public static function canView(): bool
    {
        // Opsi 1: Menggunakan nama permission langsung (jika pakai Spatie/Shield)
        // Biasanya formatnya: 'view_any_resource_name'
        return auth()->user()->can('view_any_activity');

        // Opsi 2: Menggunakan Policy (Best Practice)
        // Pastikan Model Activity sudah di-import
        return auth()->user()->can('viewAny', Activity::class);
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Activity::query()->latest()->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('Pengguna')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Subjek')
                    ->formatStateUsing(function ($state) {
                        return class_basename($state);
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('event')
                    ->label('Aktivitas')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        'login' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'created' => 'Dibuat',
                        'updated' => 'Diubah',
                        'deleted' => 'Dihapus',
                        'login' => 'Login',
                        default => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->formatStateUsing(fn($state, $record) => match ($record->event) {
                        'updated' => 'Mengubah data ' . class_basename($record->subject_type),
                        'created' => 'Menambahkan data ' . class_basename($record->subject_type),
                        'deleted' => 'Menghapus data ' . class_basename($record->subject_type),
                        default => $state,
                    })
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
