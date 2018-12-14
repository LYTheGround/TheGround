<?php

namespace App\Policies\Trade;

use App\Sale;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
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

    public function view(User $user, Sale $sale)
    {
        // ce buy est de cette compagnie
        if($sale->company_id == $user->member->company_id){
            // le status n'est pas finish
            if($sale->trade_action->status != 'finish'){
                return true;
            }
            else{
                if(Carbon::parse($sale->trade_action->done_time)->format('m-Y') == gmdate('m-Y')){
                    return true;
                }
                // pdg, manager et accounting peuvent accédez a tous les achats
                $category = $user->member->premium->category->category;
                if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    public function dv(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            if($sale->trade_action->dv){
                return false;
            }
            return true;
        }
        return false;
    }

    public function done(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            if($sale->trade_action->dv && !$sale->trade_action->done){
                return true;
            }
            return false;
        }
        return false;
    }

    public function store(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            if($sale->trade_action->dv && $sale->trade_action->done && !$sale->trade_action->store){
                return true;
            }
            return false;
        }
        return false;
    }

    public function delivery(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            if($sale->trade_action->dv && $sale->trade_action->done && $sale->trade_action->store && !$sale->trade_action->delivery){
                return true;
            }
            return false;
        }
        return false;
    }

    public function finish(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            if($sale->trade_action->dv && $sale->trade_action->done && $sale->trade_action->delivery && $sale->trade_action->store){
                return true;
            }
            return false;
        }
        return false;
    }

    public function bl(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            $category = $user->member->premium->category->category;
            if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
                if($sale->trade_action->dv && $sale->trade_action->done && $sale->trade_action->store){
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    public function fc(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            $category = $user->member->premium->category->category;
            if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
                if($sale->trade_action->dv && $sale->trade_action->done && $sale->trade_action->delivery && $sale->trade_action->store){
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    public function delete(User $user, Sale $sale)
    {
        if($user->member->company_id == $sale->company_id){
            $category = $user->member->premium->category->category;
            if($category == 'pdg' || $category == 'manager' || $category == 'accounting'){
                if($sale->trade_action->done){
                    return false;
                }
                return true;
            }
            return false;
        }
        return false;
    }
}
