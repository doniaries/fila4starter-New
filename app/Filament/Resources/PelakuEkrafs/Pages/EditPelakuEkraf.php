<?php

namespace App\Filament\Resources\PelakuEkrafs\Pages;

use App\Filament\Resources\PelakuEkrafs\PelakuEkrafResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPelakuEkraf extends EditRecord
{
    protected static string $resource = PelakuEkrafResource::class;

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
