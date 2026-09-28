<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource\ActivityResource;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('clearLogs')
                ->label('Hapus Semua Log')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(fn() => \App\Models\Activity::query()->delete())
                ->successNotificationTitle('Semua log aktivitas telah dihapus'),
        ];
    }
}
