<?php

use Illuminate\Support\Facades\Route;
use App\Services\GoogleCalendarService;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API works!',
    ]);
});


Route::get('/meetings-today', function (GoogleCalendarService $calendar) {
    return response()->json(
        $calendar->getTodayEvents()
    );
});
