<?php

namespace App\Policies\Deal;

use App\Buy_dv;
use App\Provider;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProviderPolicy
{
    use HandlesAuthorization;

    /**
     * seulement les providers de notre compagnie qu'ont peux voir
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function view(User $user, Provider $provider)
    {
        return $user->member->company_id == $provider->company_id;
    }

    /**
     * seuls le créateur du provider, le pdg et le manager qui peuvent modifié le provider
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function update(User $user, Provider $provider)
    {
        if($user->member->company_id == $provider->company_id){
            if($user->id == $provider->user_id){
                return true;
            }
            $category = $user->member->premium->category->category;
            if($category == 'pdg' || 'manager'){
                return true;
            }
        }
        return false;
    }

    /**
     * seuls les providers qui sont pas engager qui peuvent être supprimé.
     * seuls le créateur du provider, le pdg et le manager qui peuvent supprimé un provider non actif
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function delete(User $user, Provider $provider)
    {
        $dvs = Buy_dv::where([['provider_id',$provider->id],['selected',true]])->first();
        if(!$dvs){
            if($provider->user_id == $user->id){
                return true;
            }
            $category = $user->member->premium->category->category;
            if($category == 'pdg' || $category == 'manager'){
                return true;
            }
        }
        return false;
    }
}
