<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StaffProfile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * GET /api/users
     */
    public function index(): JsonResponse
    {
        $users = User::with('staffProfile.division')->get();

        return response()->json($users);
    }

    /**
     * POST /api/users
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
            'role'        => 'required|in:admin,staff',
            'division_id' => 'required|exists:divisions,id',
            'position'    => 'required|string',
        ]);

        // Create User
        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => $validated['password'],
            'role'      => $validated['role'],
            'is_active' => true,
        ]);

        // Create Staff Profile
        StaffProfile::create([
            'user_id'     => $user->id,
            'division_id' => $validated['division_id'],
            'position'    => $validated['position'],
        ]);

        return response()->json(
            $user->load('staffProfile.division'),
            201
        );
    }

    /**
     * GET /api/users/{user}
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(
            $user->load('staffProfile.division')
        );
    }

    /**
     * PUT /api/users/{user}
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'sometimes|required|string',
            'email'       => 'sometimes|email|unique:users,email,' . $user->id,
            'password'    => 'nullable|min:6',
            'role'        => 'sometimes|in:admin,staff',
            'division_id' => 'sometimes|exists:divisions,id',
            'position'    => 'sometimes|string',
            'is_active'   => 'sometimes|boolean',
        ]);

        // Update User
        $user->update($validated);

        // Update Staff Profile if needed
        if (isset($validated['division_id']) || isset($validated['position'])) {
            $user->staffProfile()->update([
                'division_id' => $validated['division_id'] ?? $user->staffProfile->division_id,
                'position'    => $validated['position'] ?? $user->staffProfile->position,
            ]);
        }

        return response()->json(
            $user->load('staffProfile.division')
        );
    }

    /**
     * DELETE /api/users/{user}
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}