<?php

namespace App\Filament\Resources\KategoriData\Pages;

use App\Filament\Resources\KategoriData\KategoriDataResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriData extends ListRecords
{
    protected static string $resource = KategoriDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
