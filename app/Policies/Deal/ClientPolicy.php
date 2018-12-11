<?php

namespace App\Policies\Deal;

use App\Buy_dv;
use App\Client;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * seulement les providers de notre compagnie qu'ont peux voir
     * @param User $user
     * @param Client $client
     * @return bool
     * @internal param Provider $provider
     */
    public function view(User $user, Client $client)
    {
        return $user->member->company_id == $client->company_id;
    }

    /**
     * seuls le créateur du provider, le pdg et le manager qui peuvent modifié le provider
     * @param User $user
     * @param Client $client
     * @return bool
     * @internal param Provider $provider
     */
    public function update(User $user, Client $client)
    {
        if ($user->member->company_id == $client->company_id) {
            if ($user->id == $client->user_id) {
                return true;
            }
            $category = $user->member->premium->category->category;
            if ($category == 'pdg' || 'manager') {
                return true;
            }
        }
        return false;
    }

    /**
     * seuls les providers qui sont pas engager qui peuvent être supprimé.
     * seuls le créateur du provider, le pdg et le manager qui peuvent supprimé un provider non actif
     * @param User $user
     * @param Client $client
     * @return bool
     * @internal param Provider $provider
     */
    public function delete(User $user, Client $client)
    {
        $dvs = Buy_dv::where([['provider_id', $client->id], ['selected', true]])->first();
        if (!$dvs) {
            if ($client->user_id == $user->id) {
                return true;
            }
            $category = $user->member->premium->category->category;
            if ($category == 'pdg' || $category == 'manager') {
                return true;
            }
        }
        return false;
    }
}
