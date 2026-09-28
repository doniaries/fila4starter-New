<?php

namespace App\Filament\Resources\KategoriEkrafs\Pages;

use App\Filament\Resources\KategoriEkrafs\KategoriEkrafResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriEkraf extends EditRecord
{
    protected static string $resource = KategoriEkrafResource::class;

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
