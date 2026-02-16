<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DivisionReport;

class DivisionReportPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DivisionReport $report): bool
    {
        return $user->isAdmin() || $report->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, DivisionReport $report): bool
    {
        return $user->isAdmin() || $report->user_id === $user->id;
    }

    public function delete(User $user, DivisionReport $report): bool
    {
        return $user->isAdmin() || $report->user_id === $user->id;
    }
}
