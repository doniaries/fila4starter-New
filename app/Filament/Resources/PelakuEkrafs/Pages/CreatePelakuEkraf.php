<?php

namespace App\Filament\Resources\PelakuEkrafs\Pages;

use App\Filament\Resources\PelakuEkrafs\PelakuEkrafResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePelakuEkraf extends CreateRecord
{
    protected static string $resource = PelakuEkrafResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
