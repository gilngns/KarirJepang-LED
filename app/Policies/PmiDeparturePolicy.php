<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PmiDeparture;

class PmiDeparturePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PmiDeparture $pmi): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, PmiDeparture $pmi): bool
    {
        return true;
    }

    public function delete(User $user, PmiDeparture $pmi): bool
    {
        return true;
    }
}
