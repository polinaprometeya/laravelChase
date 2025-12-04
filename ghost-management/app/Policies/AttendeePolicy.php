<?php

namespace App\Policies;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User as UserModel;
use Illuminate\Auth\Access\Response;

class AttendeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?UserModel $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?UserModel $user, ?Attendee $attendee): bool
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
    //we do not have such action yet
    // public function update(UserModel $user, Event $event, Attendee $attendee): bool
    // {
    //     return $user->id === $event->user_id || $user->id === $attendee->user_id;
    //     ;
    // }

    /**
     * Determine whether the user can delete the model.
     */
    // public function delete(UserModel $user, Event $event, Attendee $attendee): bool
    // {
    //     return  $user->id === $event->user_id || $user->id === $attendee->user_id;
    // }

    public function delete(UserModel $user, Attendee $attendee): bool
    {
        return  $user->id === $attendee->event->user_id || $user->id === $attendee->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(UserModel $user, Attendee $attendee): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(UserModel $user, Attendee $attendee): bool
    {
        return false;
    }
}
