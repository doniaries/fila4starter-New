<?php

namespace App\Filament\Resources\Data;

use App\Filament\Resources\Data\Pages\CreateData;
use App\Filament\Resources\Data\Pages\EditData;
use App\Filament\Resources\Data\Pages\ListData;
use App\Filament\Resources\Data\Schemas\DataForm;
use App\Filament\Resources\Data\Tables\DataTable;
use App\Models\Data;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataResource extends Resource
{
    protected static ?string $model = Data::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Data';

    protected static ?string $recordTitleAttribute = 'nama_data';

    public static function form(Schema $schema): Schema
    {
        return DataForm::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return DataTable::configure($table);
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
            'index' => ListData::route('/'),
            'create' => CreateData::route('/create'),
            'edit' => EditData::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
