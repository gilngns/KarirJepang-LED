<?php

namespace App\Filament\Resources\Meetings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MeetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                DateTimePicker::make('start_time')
                    ->required(),
                DateTimePicker::make('end_time'),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
