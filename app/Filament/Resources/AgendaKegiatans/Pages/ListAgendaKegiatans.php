<?php

namespace App\Filament\Resources\AgendaKegiatans\Pages;

use App\Filament\Resources\AgendaKegiatans\AgendaKegiatanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAgendaKegiatans extends ListRecords
{
    protected static string $resource = AgendaKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
