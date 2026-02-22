<?php

namespace App\Filament\Resources\Attendances\Pages;

use App\Filament\Resources\Attendances\AttendanceResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Attendance;
use Illuminate\Validation\ValidationException;

class CreateAttendance extends CreateRecord
{
    protected static string $resource = AttendanceResource::class;

    public function mount(): void
    {
        parent::mount();

        $user = auth()->user();

        if ($user->isStaff()) {

            $already = Attendance::where('user_id', $user->id)
                ->whereDate('date', now())
                ->exists();

            if ($already) {

                Notification::make()
                    ->title('Anda sudah melakukan absensi hari ini.')
                    ->warning()
                    ->send();

                $this->redirect(
                    AttendanceResource::getUrl('index')
                );
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        if ($user->isStaff()) {
            $data['user_id'] = $user->id;
            $data['date'] = now()->toDateString();
        }

        $exists = Attendance::where('user_id', $data['user_id'])
            ->whereDate('date', $data['date'])
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'date' => 'Absensi untuk user dan tanggal tersebut sudah ada.',
            ]);
        }

        return $data;
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->label('Simpan Absensi');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->visible(fn() => auth()->user()->isAdmin());
    }
}
