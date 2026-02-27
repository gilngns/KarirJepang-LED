<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\GoogleCalendarService;

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\DivisionReportController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\PmiDepartureController;
use App\Http\Controllers\Api\UserController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API works!',
    ]);
});

Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (! auth()->attempt($credentials)) {
        return response()->json([
            'message' => 'Email atau password salah',
        ], 401);
    }

    $user = auth()->user();

    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken,
        'user' => [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'role'  => $user->role,
        ],
    ]);
});


Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('attendances', AttendanceController::class);

    Route::apiResource('division-reports', DivisionReportController::class);

    Route::apiResource('partners', PartnerController::class);

    Route::apiResource('pmi-departures', PmiDepartureController::class);

    Route::apiResource('users', UserController::class);

    Route::get('/meetings-today', function (GoogleCalendarService $calendar) {
        return response()->json(
            $calendar->getTodayEvents()
        );
    });
});
