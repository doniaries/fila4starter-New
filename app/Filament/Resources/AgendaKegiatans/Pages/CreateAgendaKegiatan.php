<?php

namespace App\Filament\Resources\AgendaKegiatans\Pages;

use App\Filament\Resources\AgendaKegiatans\AgendaKegiatanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAgendaKegiatan extends CreateRecord
{
    protected static string $resource = AgendaKegiatanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
