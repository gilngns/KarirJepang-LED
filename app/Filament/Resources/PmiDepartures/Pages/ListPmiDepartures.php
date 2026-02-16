<?php

namespace App\Filament\Resources\PmiDepartures\Pages;

use App\Filament\Resources\PmiDepartures\PmiDepartureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPmiDepartures extends ListRecords
{
    protected static string $resource = PmiDepartureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
