<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                auth()->user()->isStaff()
                    ? Hidden::make('user_id')
                    ->default(auth()->id())
                    : Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                auth()->user()->isStaff()
                    ? Hidden::make('date')
                    ->default(now()->toDateString())
                    : DatePicker::make('date')
                    ->required(),

                Select::make('status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Sakit' => 'Sakit',
                        'Cuti' => 'Cuti',
                        'Perjalanan Dinas' => 'Perjalanan Dinas',
                    ])
                ->label('Status Kehadiran')
                    ->required(),

                Textarea::make('note')
                    ->label('Keterangan (opsional)')
                    ->maxLength(100)
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
