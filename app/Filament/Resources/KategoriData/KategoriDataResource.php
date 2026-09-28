<?php

namespace App\Filament\Resources\KategoriData;

use App\Filament\Resources\KategoriData\Pages\CreateKategoriData;
use App\Filament\Resources\KategoriData\Pages\EditKategoriData;
use App\Filament\Resources\KategoriData\Pages\ListKategoriData;
use App\Filament\Resources\KategoriData\Schemas\KategoriDataForm;
use App\Filament\Resources\KategoriData\Tables\KategoriDataTable;
use App\Models\KategoriData;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KategoriDataResource extends Resource
{
    protected static ?string $model = KategoriData::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|UnitEnum|null $navigationGroup = 'Data';
    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Kategori Data';

    protected static ?string $pluralModelLabel = 'Kategori Data';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return KategoriDataForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriDataTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKategoriData::route('/'),
            'create' => CreateKategoriData::route('/create'),
            'edit' => EditKategoriData::route('/{record}/edit'),
        ];
    }
}
