<?php

namespace App\Policies\Trade;

use App\Buy;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyPolicy
{
    use HandlesAuthorization;

    public function archivedList(User $user)
    {
        $category = $user->member->premium->category->category;
        if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
            return true;
        }
        return false;
    }

    public function view(User $user, Buy $buy)
    {
        // ce buy est de cette compagnie
        if($buy->company_id == $user->member->company_id){
            // le status n'est pas finish
            if($buy->trade_action->status != 'finish'){
                return true;
            }
            else{
                // pdg, manager et accounting peuvent accédez a tous les achats
                $category = $user->member->premium->category->category;
                if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
                    return true;
                }
                elseif(Carbon::parse($buy->trade_action->updated_at)->format('Y-m') == gmdate('Y-m')){
                    return true;
                }
                 return false;
            }
        }
        return false;
    }

    public function bc(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            if($buy->trade_action->bc){
                return false;
            }
            return true;
        }
        return false;
    }

    public function dv(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            if($buy->trade_action->dv){
                return false;
            }
            return true;
        }
        return false;
    }

    public function done(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            if($buy->trade_action->bc && $buy->trade_action->dv && !$buy->trade_action->done){
                return true;
            }
            return false;
        }
        return false;
    }

    public function delivery(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            if($buy->trade_action->bc && $buy->trade_action->dv && $buy->trade_action->done && !$buy->trade_action->delivery){
                return true;
            }
            return false;
        }
        return false;
    }

    public function store(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            if($buy->trade_action->bc && $buy->trade_action->dv && $buy->trade_action->done && $buy->trade_action->delivery && !$buy->trade_action->store){
                return true;
            }
            return false;
        }
        return false;
    }

    public function finish(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            if($buy->trade_action->bc && $buy->trade_action->dv && $buy->trade_action->done && $buy->trade_action->delivery && $buy->trade_action->store){
                return true;
            }
            return false;
        }
        return false;
    }

    public function bl(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            $category = $user->member->premium->category->category;
            if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
                if($buy->trade_action->bc && $buy->trade_action->dv && $buy->trade_action->done && $buy->trade_action->delivery && $buy->trade_action->store){
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    public function delete(User $user, Buy $buy)
    {
        if($user->member->company_id == $buy->company_id){
            $category = $user->member->premium->category->category;
            if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
                if($buy->trade_action->done){
                    return false;
                }
                return true;
            }
            return false;
        }
        return false;
    }
}
