<?php

namespace App\Filament\Resources\AgendaKegiatans\Pages;

use App\Filament\Resources\AgendaKegiatans\AgendaKegiatanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAgendaKegiatan extends EditRecord
{
    protected static string $resource = AgendaKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
