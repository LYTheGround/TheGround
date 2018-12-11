<?php

namespace App\Policies\Trade;

use App\Buy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyPolicy
{
    use HandlesAuthorization;

    public function archivedList(User $user, Buy $buy)
    {
        $category = $user->member->premium->category->category;
        if($category == 'pdg' || $category == 'manager'){
            return true;
        }
        return false;
    }
}
