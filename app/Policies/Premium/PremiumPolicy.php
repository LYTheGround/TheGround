<?php

namespace App\Policies\Premium;

use App\User;
use App\Premium;
use Illuminate\Auth\Access\HandlesAuthorization;

class PremiumPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create premia.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the premium.
     *
     * @param  \App\User  $user
     * @param  \App\Premium  $premium
     * @return mixed
     */
    public function update(User $user, Premium $premium)
    {
        //
    }

    /**
     * Determine whether the user can delete the premium.
     *
     * @param  \App\User  $user
     * @param  \App\Premium  $premium
     * @return mixed
     */
    public function delete(User $user, Premium $premium)
    {
        //
    }

    /**
     * Determine whether the user can restore the premium.
     *
     * @param  \App\User  $user
     * @param  \App\Premium  $premium
     * @return mixed
     */
    public function restore(User $user, Premium $premium)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the premium.
     *
     * @param  \App\User  $user
     * @param  \App\Premium  $premium
     * @return mixed
     */
    public function forceDelete(User $user, Premium $premium)
    {
        //
    }
}
