<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PmiDeparture;

class PmiDeparturePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, PmiDeparture $pmi): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, PmiDeparture $pmi): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, PmiDeparture $pmi): bool
    {
        return $user->isAdmin();
    }
}
