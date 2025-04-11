<?php

namespace App\Policies;

use App\Models\System;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPolicy
{
    use HandlesAuthorization;

    public function view(User $user, System $system)
    {
        return $system->is_public || $user->systems->contains($system->id);
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, System $system)
    {
        return $user->systems()
            ->where('system_id', $system->id)
            ->wherePivot('role', 'admin')
            ->exists();
    }

    public function delete(User $user, System $system)
    {
        return $user->isSuperAdmin();
    }

    public function attachUser(User $user, System $system)
    {
        return $user->systems()
            ->where('system_id', $system->id)
            ->wherePivot('role', 'admin')
            ->exists();
    }
}