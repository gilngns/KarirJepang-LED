<?php

namespace App\Filament\Resources\PmiDepartures\Pages;

use App\Filament\Resources\PmiDepartures\PmiDepartureResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePmiDeparture extends CreateRecord
{
    protected static string $resource = PmiDepartureResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
