<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Quote;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotePolicy
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
     * @param  \App\Models\Quote  $quote
     * @return mixed
     */
    public function view(User $user, Quote $quote)
    {
        return $user->belongsToTeam($quote->team);
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
     * @param  \App\Models\Quote  $quote
     * @return mixed
     */
    public function update(User $user, Quote $quote)
    {
        return $user->belongsToTeam($quote->team);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Quote  $quote
     * @return mixed
     */
    public function delete(User $user, Quote $quote)
    {
        return $user->belongsToTeam($quote->team);
    }
}
