<?php

namespace App\Filament\Resources\PmiDepartures;

use App\Filament\Resources\PmiDepartures\Pages\CreatePmiDeparture;
use App\Filament\Resources\PmiDepartures\Pages\EditPmiDeparture;
use App\Filament\Resources\PmiDepartures\Pages\ListPmiDepartures;
use App\Filament\Resources\PmiDepartures\Schemas\PmiDepartureForm;
use App\Filament\Resources\PmiDepartures\Tables\PmiDeparturesTable;
use App\Models\PmiDeparture;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PmiDepartureResource extends Resource
{
    protected static ?string $model = PmiDeparture::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'year';

    public static function form(Schema $schema): Schema
    {
        return PmiDepartureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PmiDeparturesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPmiDepartures::route('/'),
            'create' => CreatePmiDeparture::route('/create'),
            'edit' => EditPmiDeparture::route('/{record}/edit'),
        ];
    }
}
