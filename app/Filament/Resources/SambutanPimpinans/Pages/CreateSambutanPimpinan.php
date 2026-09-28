<?php

namespace App\Filament\Resources\SambutanPimpinans\Pages;

use App\Filament\Resources\SambutanPimpinans\SambutanPimpinanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSambutanPimpinan extends CreateRecord
{
    protected static string $resource = SambutanPimpinanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
