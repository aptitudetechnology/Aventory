<?php

namespace App\Policies;

use App\Models\NurseryLocation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NurseryLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NurseryLocation  $location
     * @return mixed
     */
    public function view(User $user, NurseryLocation $location)
    {
        return $user->belongsToTeam($location->team);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NurseryLocation  $location
     * @return mixed
     */
    public function update(User $user, NurseryLocation $location)
    {
        return $user->belongsToTeam($location->team);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\NurseryLocation  $location
     * @return mixed
     */
    public function delete(User $user, NurseryLocation $location)
    {
        return $user->belongsToTeam($location->team);
    }
}
