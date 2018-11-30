<?php

namespace App\Policies\Rh;

use App\User;
use App\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function view(User $user, Member $member)
    {
        return $user->member->company_id  == $member->company_id;
    }

    /**
     * Determine whether the user can view the premium.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function range(User $user)
    {
        return $user->member->premium->category->category == 'pdg' || $user->member->premium->category->category == 'manager';
    }

    /**
     * Determine whether the user can delete the member.
     *
     * @param  \App\User  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function delete(User $user, Member $member)
    {
        //
    }

    public function token(User $user)
    {
        return $user->member->premium->category->category == 'pdg' || $user->member->premium->category->category == 'manager';
    }
}
