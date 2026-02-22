<?php

namespace App\Filament\Resources\DivisionReports\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DivisionReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                Select::make('division_id')
                    ->label('Nama Divisi')
                    ->relationship('division', 'name')
                    ->required(),

                DatePicker::make('report_date')
                    ->label('Tanggal Laporan')
                    ->default(now())
                    ->required(),

                Textarea::make('job_description')
                    ->label('Job Description')
                    ->required()
                    ->rows(4)
                    ->maxLength(700)
                    ->helperText('Maksimal 100 kata')
                    ->columnSpanFull(),

                TextInput::make('progress_percentage')
                    ->label('Progress')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->required()
                    ->helperText('Isi angka 0 - 100')
                    ->columnSpan(1),
            ]);
    }
}
