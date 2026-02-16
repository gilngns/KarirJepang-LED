<?php

namespace App\Filament\Resources\PmiDepartures\Pages;

use App\Filament\Resources\PmiDepartures\PmiDepartureResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPmiDeparture extends EditRecord
{
    protected static string $resource = PmiDepartureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
