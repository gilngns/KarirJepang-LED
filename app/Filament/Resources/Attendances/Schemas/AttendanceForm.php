<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                Select::make('status')
                    ->options([
            'Hadir' => 'Hadir',
            'Sakit' => 'Sakit',
            'Cuti' => 'Cuti',
            'Perjalanan Dinas' => 'Perjalanan dinas',
        ])
                    ->required(),
                Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }
}
