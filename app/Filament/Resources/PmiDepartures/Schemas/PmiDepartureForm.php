<?php

namespace App\Filament\Resources\PmiDepartures\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PmiDepartureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('year')
                    ->required(),
                Select::make('visa_id')
                    ->relationship('visa', 'name')
                    ->required(),
                TextInput::make('total')
                    ->required()
                    ->numeric(),
            ]);
    }
}
