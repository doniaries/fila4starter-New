<?php

namespace App\Filament\Resources\KategoriEkrafs\Pages;

use App\Filament\Resources\KategoriEkrafs\KategoriEkrafResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriEkraf extends CreateRecord
{
    protected static string $resource = KategoriEkrafResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
