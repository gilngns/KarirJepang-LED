<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DivisionReport;
use Illuminate\Http\Request;

class DivisionReportController extends Controller
{
    public function index()
    {
        $query = DivisionReport::with(['division', 'user']);

        if (auth()->user()->isStaff()) {
            $query->where('user_id', auth()->id());
        }

        return response()->json($query->latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'report_date' => 'required|date',
            'job_description' => 'required|string',
            'progress_percentage' => 'required|integer|min:0|max:100',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = $data['progress_percentage'] == 100
            ? 'completed'
            : 'in_progress';

        $report = DivisionReport::create($data);

        return response()->json($report, 201);
    }

    public function show(DivisionReport $division_report)
    {
        if (
            auth()->user()->isStaff() &&
            $division_report->user_id !== auth()->id()
        ) {
            abort(403);
        }

        return response()->json($division_report);
    }

    public function update(Request $request, DivisionReport $division_report)
    {
        $authUser = auth()->user();

        if ($authUser->isStaff() && $division_report->user_id !== $authUser->id) {
            abort(403);
        }

        if ($division_report->status === 'completed') {
            return response()->json([
                'message' => 'Laporan sudah selesai dan tidak bisa diedit.'
            ], 403);
        }

        $data = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'report_date' => 'required|date',
            'job_description' => 'required|string',
            'progress_percentage' => 'required|integer|min:0|max:100',
        ]);

        $data['status'] = $data['progress_percentage'] == 100
            ? 'completed'
            : 'in_progress';

        $division_report->update($data);

        return response()->json($division_report);
    }

    public function destroy(DivisionReport $division_report)
    {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }

        $division_report->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
