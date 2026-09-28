<?php

namespace App\Filament\Resources\AgendaKegiatans;

use App\Filament\Resources\AgendaKegiatans\Pages\CreateAgendaKegiatan;
use App\Filament\Resources\AgendaKegiatans\Pages\EditAgendaKegiatan;
use App\Filament\Resources\AgendaKegiatans\Pages\ListAgendaKegiatans;
use App\Filament\Resources\AgendaKegiatans\Schemas\AgendaKegiatanForm;
use App\Filament\Resources\AgendaKegiatans\Tables\AgendaKegiatansTable;
use App\Models\AgendaKegiatan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AgendaKegiatanResource extends Resource
{
    protected static ?string $model = AgendaKegiatan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|UnitEnum|null $navigationGroup = 'Dinas';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return \Illuminate\Support\Facades\Cache::remember('badge_agenda_kegiatans_count', 3600, fn () => static::getModel()::count());
    }

    public static function form(Schema $schema): Schema
    {
        return AgendaKegiatanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AgendaKegiatansTable::configure($table);
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
            'index' => ListAgendaKegiatans::route('/'),
            'create' => CreateAgendaKegiatan::route('/create'),
            'edit' => EditAgendaKegiatan::route('/{record}/edit'),
        ];
    }
}
