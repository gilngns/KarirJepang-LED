<?php

namespace App\Filament\Resources\DivisionReports\Pages;

use App\Filament\Resources\DivisionReports\DivisionReportResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateDivisionReport extends CreateRecord
{
    protected static string $resource = DivisionReportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        $data['status'] = $data['progress_percentage'] == 100
            ? 'completed'
            : 'in_progress';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->visible(fn() => auth()->user()->isAdmin());
    }
}
