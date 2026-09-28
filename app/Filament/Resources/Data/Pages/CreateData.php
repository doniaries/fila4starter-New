<?php

namespace App\Filament\Resources\Data\Pages;

use App\Filament\Resources\Data\DataResource;
use Filament\Resources\Pages\CreateRecord;

class CreateData extends CreateRecord
{
    protected static string $resource = DataResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
