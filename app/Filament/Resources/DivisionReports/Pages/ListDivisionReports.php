<?php

namespace App\Filament\Resources\DivisionReports\Pages;

use App\Filament\Resources\DivisionReports\DivisionReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Filament\Schemas\Components\Tabs\Tab as TabsTab;

class ListDivisionReports extends ListRecords
{
    protected static string $resource = DivisionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Aktif' => TabsTab::make()
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->where('status', 'in_progress')
                ),

            'Selesai' => TabsTab::make()
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->where('status', 'completed')
                ),
        ];
    }
}
