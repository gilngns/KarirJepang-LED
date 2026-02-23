<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PmiDeparture;
use Illuminate\Http\Request;

class PmiDepartureController extends Controller
{
    public function index()
    {
        return response()->json(
            PmiDeparture::with('visa')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'visa_id' => 'required|exists:visas,id',
            'total' => 'required|integer',
        ]);

        $departure = PmiDeparture::create($data);

        return response()->json($departure, 201);
    }

    public function show(PmiDeparture $pmi_departure)
    {
        return response()->json(
            $pmi_departure->load('visa')
        );
    }

    public function update(Request $request, PmiDeparture $pmi_departure)
    {
        $data = $request->validate([
            'date' => 'sometimes|date',
            'visa_id' => 'sometimes|exists:visas,id',
            'total' => 'sometimes|integer',
        ]);

        $pmi_departure->update($data);

        return response()->json($pmi_departure);
    }

    public function destroy(PmiDeparture $pmi_departure)
    {
        $pmi_departure->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
