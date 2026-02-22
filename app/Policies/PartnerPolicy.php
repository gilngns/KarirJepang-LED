<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Partner;

class PartnerPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Partner $partner): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Partner $partner): bool
    {
        return true;
    }

    public function delete(User $user, Partner $partner): bool
    {
        return true;
    }
}
