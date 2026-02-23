<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AttendanceController extends Controller
{
    public function index()
    {
        $query = Attendance::with('user');

        if (auth()->user()->isStaff()) {
            $query->where('user_id', auth()->id());
        }

        return response()->json($query->latest()->get());
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();

        if ($authUser->isStaff()) {

            $data = $request->validate([
                'status' => 'required|string',
                'note' => 'nullable|string|max:100',
            ]);

            $userId = $authUser->id;
            $date = now()->toDateString();
        } else {

            $data = $request->validate([
                'email' => 'required|exists:users,email',
                'date' => 'required|date',
                'status' => 'required|string',
                'note' => 'nullable|string|max:100',
            ]);

            $targetUser = \App\Models\User::where('email', $data['email'])->first();

            $userId = $targetUser->id;
            $date = $data['date'];
        }

        $exists = Attendance::where('user_id', $userId)
            ->whereDate('date', $date)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Absensi sudah ada'
            ], 422);
        }

        $attendance = Attendance::create([
            'user_id' => $userId,
            'date' => $date,
            'status' => $data['status'],
            'note' => $data['note'] ?? null,
        ]);

        return response()->json($attendance, 201);
    }

    public function show(Attendance $attendance)
    {
        if (
            auth()->user()->isStaff() &&
            $attendance->user_id !== auth()->id()
        ) {
            abort(403);
        }

        return response()->json($attendance);
    }

    public function update(Request $request, Attendance $attendance)
    {
        if (
            auth()->user()->isStaff() &&
            $attendance->user_id !== auth()->id()
        ) {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|string',
            'note' => 'nullable|string|max:100',
        ]);

        $attendance->update($data);

        return response()->json($attendance);
    }

    public function destroy(Attendance $attendance)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $attendance->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
