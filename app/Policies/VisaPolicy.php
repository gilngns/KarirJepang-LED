<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visa;

class VisaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Visa $visa): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Visa $visa): bool
    {
        return $user->isAdmin();
    }
}
