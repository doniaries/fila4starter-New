<?php

namespace App\Filament\Resources\ActivityResource;

use App\Filament\Resources\ActivityResource\Pages;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Activity;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use UnitEnum;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 4;
    protected static ?string $slug = 'activities';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['causer', 'subject']);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->components([
                        Section::make()
                            ->components([
                                TextInput::make('causer_type')
                                    ->label('Tipe Pengguna'),
                                TextInput::make('causer_id')
                                    ->label('ID Pengguna'),
                                TextInput::make('subject_type')
                                    ->label('Tipe Subjek'),
                                TextInput::make('subject_id')
                                    ->label('ID Subjek'),
                            ])->columns(2),
                        KeyValue::make('properties')
                            ->label('Perubahan Data')
                            ->columnSpan('full'),
                    ])
                    ->columnSpan(['lg' => 3]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('Pengguna')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Subjek')
                    ->formatStateUsing(function ($state) {
                        return class_basename($state);
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('event')
                    ->label('Aktivitas')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        'login' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'created' => 'Dibuat',
                        'updated' => 'Diubah',
                        'deleted' => 'Dihapus',
                        'login' => 'Login',
                        default => ucfirst($state),
                    }),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->formatStateUsing(fn($state, $record) => match ($record->event) {
                        'updated' => 'Mengubah data ' . class_basename($record->subject_type),
                        'created' => 'Menambahkan data ' . class_basename($record->subject_type),
                        'deleted' => 'Menghapus data ' . class_basename($record->subject_type),
                        default => $state,
                    })
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->deferLoading()
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListActivities::route('/'),
        ];
    }
}
