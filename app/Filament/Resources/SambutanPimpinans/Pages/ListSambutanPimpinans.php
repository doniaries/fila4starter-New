<?php

namespace App\Filament\Resources\SambutanPimpinans\Pages;

use App\Filament\Resources\SambutanPimpinans\SambutanPimpinanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSambutanPimpinans extends ListRecords
{
    protected static string $resource = SambutanPimpinanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
