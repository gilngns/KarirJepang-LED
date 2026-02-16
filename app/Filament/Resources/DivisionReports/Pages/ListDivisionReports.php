<?php

namespace App\Filament\Resources\DivisionReports\Pages;

use App\Filament\Resources\DivisionReports\DivisionReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDivisionReports extends ListRecords
{
    protected static string $resource = DivisionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
