<?php

namespace App\Policies;

use App\Models\Price;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PricePolicy
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
     * @param  \App\Models\Price  $price
     * @return mixed
     */
    public function view(User $user, Price $price)
    {
        if ($price->category_id) {
            return $user->belongsToTeam($price->category()->team);
        } elseif ($price->product_id) {
            return $user->belongsToTeam($price->product()->team);
        }
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
     * @param  \App\Models\Price  $price
     * @return mixed
     */
    public function update(User $user, Price $price)
    {
        if ($price->category_id) {
            return $user->belongsToTeam($price->category->team);
        } elseif ($price->product_id) {
            return $user->belongsToTeam($price->product->team);
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Price  $price
     * @return mixed
     */
    public function delete(User $user, Price $price)
    {
        if ($price->category_id) {
            return $user->belongsToTeam($price->category->team);
        } elseif ($price->product_id) {
            return $user->belongsToTeam($price->product->team);
        }
    }
}
