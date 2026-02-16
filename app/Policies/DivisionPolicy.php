<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Division;

class DivisionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Division $division): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Division $division): bool
    {
        return $user->isAdmin();
    }
}
