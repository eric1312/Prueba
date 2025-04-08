<?php

namespace App\Policies;

use App\Models\System;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SystemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, System $system): bool
    {
        return $system->is_public || $user->systems->contains($system->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }
    public function access(User $user, System $system)
    {
    return $user->systems()
        ->where('system_id', $system->id)
        ->wherePivot('role', '!=', 'pending')
        ->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, System $system): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, System $system): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, System $system): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, System $system): bool
    {
        return false;
    }
}
