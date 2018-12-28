<?php

namespace App\Policies\Rh;

use App\Position;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the position.
     *
     * @param  \App\User  $user
     * @param  \App\Position  $position
     * @return boolean
     */
    public function view(User $user, Position $position)
    {
        return $user->member->company_id == $position->company_id;
    }

    /**
     * Determine whether the user can update the position.
     *
     * @param  \App\User  $user
     * @param  \App\Position  $position
     * @return boolean
     */
    public function update(User $user, Position $position)
    {
        if($user->member->company_id == $position->company_id){
            if($user->member->id == $position->member_id){
                return true;
            }
            else{
                $category = $user->member->premium->category->category;
                if($category == 'pdg' || $category == 'manager'){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the odel= position.
     *
     * @param  \App\User  $user
     * @param  \App\Position  $position
     * @return boolean
     */
    public function delete(User $user, Position $position)
    {
        if($user->member->company_id == $position->company_id){
            if($user->member->id == $position->member_id){
                return true;
            }
            else{
                $category = $user->member->premium->category->category;
                if($category == 'pdg' || $category == 'manager'){
                    return true;
                }
            }
        }
        return false;
    }
}
