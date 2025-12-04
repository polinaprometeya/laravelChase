<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User as UserModel;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    //?UserModel $user so you do not have to log in to see events
    public function viewAny(?UserModel $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?UserModel $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(UserModel $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    //this check before was directly in Gate::define authentication method but now it can be moved here,
    //so nothing needs to be done in Event controller , all auth things have specific method for it here

    public function update(UserModel $user, Event $event): bool
    {
        return $user->id === $event->user_id;

    }

    /**
     * Determine whether the user can delete the model.
     */
    //so you need to be the owner of the event to be able to delete an event
    public function delete(UserModel $user, Event $event): bool
    {
        return $user->id === $event->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    //this relates to soft delete
    public function restore(UserModel $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    //this relates to soft delete
    public function forceDelete(UserModel $user, Event $event): bool
    {
        return false;
    }
}
