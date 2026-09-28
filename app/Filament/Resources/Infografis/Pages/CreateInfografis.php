<?php

namespace App\Filament\Resources\Infografis\Pages;

use App\Filament\Resources\Infografis\InfografisResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInfografis extends CreateRecord
{
    protected static string $resource = InfografisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
