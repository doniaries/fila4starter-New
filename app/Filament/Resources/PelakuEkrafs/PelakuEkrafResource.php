<?php

namespace App\Filament\Resources\PelakuEkrafs;

use App\Filament\Resources\PelakuEkrafs\Pages\CreatePelakuEkraf;
use App\Filament\Resources\PelakuEkrafs\Pages\EditPelakuEkraf;
use App\Filament\Resources\PelakuEkrafs\Pages\ListPelakuEkrafs;
use App\Filament\Resources\PelakuEkrafs\Schemas\PelakuEkrafForm;
use App\Filament\Resources\PelakuEkrafs\Tables\PelakuEkrafsTable;
use App\Models\PelakuEkraf;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PelakuEkrafResource extends Resource
{
    protected static ?string $model = PelakuEkraf::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Ekonomi Kreatif';

    public static function getNavigationBadge(): ?string
    {
        return \Illuminate\Support\Facades\Cache::remember('badge_pelaku_ekrafs_count', 3600, fn () => static::getModel()::count());
    }

    protected static ?string $recordTitleAttribute = 'nama_pelaku';

    public static function form(Schema $schema): Schema
    {
        return PelakuEkrafForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelakuEkrafsTable::configure($table);
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
            'index' => ListPelakuEkrafs::route('/'),
            'create' => CreatePelakuEkraf::route('/create'),
            'edit' => EditPelakuEkraf::route('/{record}/edit'),
        ];
    }
}
