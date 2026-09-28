<?php

namespace App\Filament\Resources\KategoriData\Pages;

use App\Filament\Resources\KategoriData\KategoriDataResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriData extends CreateRecord
{
    protected static string $resource = KategoriDataResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
