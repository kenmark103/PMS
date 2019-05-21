<?php

namespace App\Policies;

use App\Admins;
use App\Rooms;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the rooms.
     *
     * @param  \App\User  $user
     * @param  \App\Rooms  $rooms
     * @return mixed
     */
    public function before(Admins $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function view(Admins $user, Rooms $rooms)
    {
        //
       

    }

    public function show(Admins $user, Rooms $rooms)
    {
        //

    }

    /**
     * Determine whether the user can create rooms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(Admins $user)
    {
        //
    }

    /**
     * Determine whether the user can update the rooms.
     *
     * @param  \App\User  $user
     * @param  \App\Rooms  $rooms
     * @return mixed
     */
    public function update(Admins $user, Rooms $rooms)
    {
        //
    }

    /**
     * Determine whether the user can delete the rooms.
     *
     * @param  \App\User  $user
     * @param  \App\Rooms  $rooms
     * @return mixed
     */
    public function delete(Admins $user, Rooms $rooms)
    {
        //
    }

    /**
     * Determine whether the user can restore the rooms.
     *
     * @param  \App\User  $user
     * @param  \App\Rooms  $rooms
     * @return mixed
     */
    public function restore(Admins $user, Rooms $rooms)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the rooms.
     *
     * @param  \App\User  $user
     * @param  \App\Rooms  $rooms
     * @return mixed
     */
    public function forceDelete(Admins $user, Rooms $rooms)
    {
        //
    }
}
