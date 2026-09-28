<?php

namespace App\Filament\Resources\ExternalLinks\Pages;

use App\Filament\Resources\ExternalLinks\ExternalLinkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExternalLink extends CreateRecord
{
    protected static string $resource = ExternalLinkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
