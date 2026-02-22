<?php

namespace App\Filament\Resources\DivisionReports\Pages;

use App\Filament\Resources\DivisionReports\DivisionReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDivisionReport extends EditRecord
{
    protected static string $resource = DivisionReportResource::class;

    protected function authorizeAccess(): void
    {
        parent::authorizeAccess();

        if (
            auth()->user()->isStaff() &&
            $this->record->user_id !== auth()->id()
        ) {
            abort(403);
        }

        if ($this->record->status === 'completed') {
            abort(403, 'Laporan sudah selesai dan tidak bisa diedit.');
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->visible(fn() => auth()->user()->isAdmin())
                ->successRedirectUrl(
                    fn() => $this->getResource()::getUrl('index')
                ),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['status'] = $data['progress_percentage'] == 100
            ? 'completed'
            : 'in_progress';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
