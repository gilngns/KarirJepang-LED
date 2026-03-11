<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meeting;

class MeetingController extends Controller
{
    public function today()
    {
        $meetings = Meeting::query()
            ->whereDate('start_time', today())
            ->orderBy('start_time')
            ->get()
            ->map(function ($meeting) {

                return [
                    'title' => $meeting->title,
                    'start' => $meeting->start_time,
                    'end' => $meeting->end_time,
                    'location' => $meeting->location,
                ];
            });

        return response()->json($meetings);
    }
}
