<?php

namespace App\Policies\Accounting;

use App\Unload;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnloadPolicy
{
    use HandlesAuthorization;

    public function view(User $user,Unload $unload)
    {
        $category = $user->member->premium->category->category;
        if($user->member->id == $unload->member_id){
            return true;
        }
        elseif($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
            return true;
        }
        else{
            return false;
        }
   }
}
