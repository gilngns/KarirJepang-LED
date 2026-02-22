<?php

namespace App\Filament\Resources\Attendances\Pages;

use App\Filament\Resources\Attendances\AttendanceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\Attendance;
use Illuminate\Validation\ValidationException;

class EditAttendance extends EditRecord
{
    protected static string $resource = AttendanceResource::class;

    protected function authorizeAccess(): void
    {
        parent::authorizeAccess();

        $user = auth()->user();

        if (
            $user->isStaff() &&
            $this->record->user_id !== $user->id
        ) {
            abort(403);
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
        $user = auth()->user();

        if ($user->isStaff()) {
            $data['user_id'] = $user->id;
        }

        $exists = Attendance::where('user_id', $data['user_id'])
            ->whereDate('date', $data['date'])
            ->where('id', '!=', $this->record->id)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'date' => 'Absensi untuk user dan tanggal tersebut sudah ada.',
            ]);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
