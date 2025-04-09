<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        // Anyone can view the events from the same company they belong to
        return (
            ($user->hasAnyRole(['manager','company-manager']) && $user->company() === $event->company()) ||
            $user->hasRole('administrator')
        );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return (
            ($user->hasAnyRole(['manager','company-manager']) && $user->company() === $event->company()) ||
            $user->hasRole('administrator')
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return (
            ($user->hasAnyRole(['manager','company-manager']) && $user->company() === $event->company()) ||
            $user->hasRole('administrator')
        );
    }
}
