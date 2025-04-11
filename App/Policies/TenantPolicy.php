<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Tenant $tenant)
    {
        return $user->id === $tenant->owner_id || 
               $tenant->users->contains($user->id);
    }

    public function create(User $user, System $system)
    {
        return $user->systems->contains($system->id);
    }

    public function update(User $user, Tenant $tenant)
    {
        return $user->id === $tenant->owner_id;
    }

    public function delete(User $user, Tenant $tenant)
    {
        return $user->id === $tenant->owner_id || $user->isAdmin();
    }
}