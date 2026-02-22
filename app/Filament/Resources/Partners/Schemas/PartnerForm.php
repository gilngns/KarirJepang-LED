<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Mitra Karir Jepang')
                    ->description('Masukkan informasi mitra dan upload logo.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Mitra')
                                ->required(),

                            TextInput::make('website')
                                ->label('Website')
                                ->url()
                                ->placeholder('https://example.com'),
                        ]),

                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->disk('public')
                    ->directory('partners')
                    ->visibility('public')
                    ->imagePreviewHeight('120')
                    ->preserveFilenames()
                    ->openable()
                    ->downloadable(),
                    ]),
            ]);
    }
}
