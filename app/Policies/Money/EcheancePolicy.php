<?php

namespace App\Policies\Money;

use App\Echeance;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EcheancePolicy
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
    public function update(User $user,Echeance $echeance)
    {
        $category = $user->member->premium->category->category;
        if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
            if($user->member->company_id === $echeance->company_id){
                return true;
            }
        }
        return false;
    }
}
