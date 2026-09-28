<?php

namespace App\Filament\Resources\PelakuEkrafs\Pages;

use App\Filament\Resources\PelakuEkrafs\PelakuEkrafResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPelakuEkrafs extends ListRecords
{
    protected static string $resource = PelakuEkrafResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
