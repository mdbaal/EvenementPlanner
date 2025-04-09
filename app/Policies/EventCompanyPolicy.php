<?php

namespace App\Policies;

use App\Models\EventCompany;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventCompanyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return  $user->hasRole('administrator');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EventCompany $eventCompany): bool
    {
        return (
            ($user->hasAnyRole(['company-manager']) && $user->company() == $eventCompany) ||
            $user->hasRole('administrator')
        );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return  $user->hasRole('administrator');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventCompany $eventCompany): bool
    {
        return (
            ($user->hasAnyRole(['company-manager']) && $user->company() == $eventCompany) ||
            $user->hasRole('administrator')
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventCompany $eventCompany): bool
    {
        return  $user->hasRole('administrator');
    }

}
