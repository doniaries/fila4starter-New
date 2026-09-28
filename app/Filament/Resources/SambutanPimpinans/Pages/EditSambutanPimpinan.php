<?php

namespace App\Filament\Resources\SambutanPimpinans\Pages;

use App\Filament\Resources\SambutanPimpinans\SambutanPimpinanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSambutanPimpinan extends EditRecord
{
    protected static string $resource = SambutanPimpinanResource::class;

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
