<?php

namespace App\Policies\Accounting;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountingPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        $category = $user->member->premium->category->category;

        if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
            return true;
        }
        return false;
    }
}
