<?php

namespace App\Filament\Resources\PmiDepartures\Schemas;

use Filament\Schemas\Schema;
use App\Models\Visa;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;

class PmiDepartureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            DatePicker::make('date')
                ->required()
                ->native(false),

            Radio::make('visa_id')
                ->options(Visa::pluck('name', 'id')->toArray())
                ->required()
                ->inline(),

            TextInput::make('total')
                ->numeric()
                ->required()
                ->maxLength(10),
        ]);
    }
}
