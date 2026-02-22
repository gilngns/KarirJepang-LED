<?php

namespace App\Filament\Resources\Attendances\Pages;

use App\Filament\Resources\Attendances\AttendanceResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;
use App\Models\Attendance;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        $user = auth()->user();

        if ($user->isStaff()) {

            $already = Attendance::where('user_id', $user->id)
                ->whereDate('date', now())
                ->exists();

            if ($already) {
                return []; 
            }
        }

        return [
            CreateAction::make()
                ->label('Absen Sekarang'),
        ];
    }
}
