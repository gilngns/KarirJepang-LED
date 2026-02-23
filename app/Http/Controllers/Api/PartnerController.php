<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return response()->json(Partner::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'logo' => 'nullable|string',
        ]);

        $partner = Partner::create($data);

        return response()->json($partner, 201);
    }

    public function show(Partner $partner)
    {
        return response()->json($partner);
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'website' => 'nullable|url',
            'logo' => 'nullable|string',
        ]);

        $partner->update($data);

        return response()->json($partner);
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
