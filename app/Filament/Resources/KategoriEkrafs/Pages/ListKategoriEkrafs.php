<?php

namespace App\Filament\Resources\KategoriEkrafs\Pages;

use App\Filament\Resources\KategoriEkrafs\KategoriEkrafResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriEkrafs extends ListRecords
{
    protected static string $resource = KategoriEkrafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
