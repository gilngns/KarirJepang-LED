<?php

namespace App\Filament\Resources\DivisionReports\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DivisionReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('division_id')
                    ->relationship('division', 'name')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('job_description')
                    ->required(),
                TextInput::make('progress_percentage')
                    ->required()
                    ->numeric(),
                DatePicker::make('report_date')
                    ->required(),
            ]);
    }
}
