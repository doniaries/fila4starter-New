<?php

namespace App\Filament\Resources\SambutanPimpinans;

use App\Filament\Resources\SambutanPimpinans\Pages\CreateSambutanPimpinan;
use App\Filament\Resources\SambutanPimpinans\Pages\EditSambutanPimpinan;
use App\Filament\Resources\SambutanPimpinans\Pages\ListSambutanPimpinans;
use App\Filament\Resources\SambutanPimpinans\Schemas\SambutanPimpinanForm;
use App\Filament\Resources\SambutanPimpinans\Tables\SambutanPimpinanTable;
use App\Models\SambutanPimpinan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SambutanPimpinanResource extends Resource
{
    protected static ?string $model = SambutanPimpinan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Dinas';

    protected static ?int $navigationSort = 11;

    public static function form(Schema $schema): Schema
    {
        return SambutanPimpinanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SambutanPimpinanTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSambutanPimpinans::route('/'),
            'create' => CreateSambutanPimpinan::route('/create'),
            'edit' => EditSambutanPimpinan::route('/{record}/edit'),
        ];
    }
}
