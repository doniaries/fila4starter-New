<?php

namespace App\Filament\Resources\KategoriEkrafs;

use \UnitEnum;
use App\Filament\Resources\KategoriEkrafs\Pages\CreateKategoriEkraf;
use App\Filament\Resources\KategoriEkrafs\Pages\EditKategoriEkraf;
use App\Filament\Resources\KategoriEkrafs\Pages\ListKategoriEkrafs;
use App\Filament\Resources\KategoriEkrafs\Schemas\KategoriEkrafForm;
use App\Filament\Resources\KategoriEkrafs\Tables\KategoriEkrafsTable;
use App\Models\KategoriEkraf;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriEkrafResource extends Resource
{
    protected static ?string $model = KategoriEkraf::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Ekraf';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return KategoriEkrafForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriEkrafsTable::configure($table);
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
            'index' => ListKategoriEkrafs::route('/'),
            'create' => CreateKategoriEkraf::route('/create'),
            'edit' => EditKategoriEkraf::route('/{record}/edit'),
        ];
    }
}
