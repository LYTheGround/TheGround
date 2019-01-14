<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\LimitAccount;
use App\Premium;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class PlanController extends Controller
{
    // verifier la date limit si il est dépasser
    // si oui
    // si oui archiver le compte si il est d'un user normale
    // si c'est un compte de pdg archiver toute la compagnie
    // session flash et retourne false
    // si non
    // verifier la marge pour les notifications "10 - 5 - 1"
    // verifier le status actuel si il est activer
    // si non
    // session flash et retourne false
    // si oui
    // return true
    private $send = null;

    public function UserPlan($user)
    {
        if($user->member->premium->status->status == 'active'){
            if ($user->member->premium->limit < gmdate('Y-m-d')) {
                $this->archived($user->member->premium);
                return false;
            }
            else {

                if ($user->member->premium->limit <= gmdate('Y-m-d', strtotime("+1 days"))) {
                    $this->notifications($user, $user->member->premium->limit, 1);
                }

                elseif ($user->member->premium->limit <= gmdate('Y-m-d', strtotime("+5 days"))) {
                    $this->notifications($user, $user->member->premium->limit, 5);
                }

                elseif ($user->member->premium->limit <= gmdate('Y-m-d', strtotime("+10 days"))) {

                    $this->notifications($user, $user->member->premium->limit, 10);
                }

                return true;
            }
        }
        else{
            session()->flash('danger',trans("pages.auth.login.don't active"));
            return false;
        }
    }

    public function archived($premium)
    {
        $companyP = $premium->member->company->premium->limit;
        $p = new Premium();
        if ($premium->category->category == 'pdg' || $companyP < gmdate('Y-m-d')) {
            session()->flash('danger', trans("pages.auth.login.don't active"));
            $p->updateStatus(3, $premium->member->company);
        }
        else {
            session()->flash('danger', trans("pages.auth.login.don't active company"));
            $p->updateStatusMember(3, $premium->member->company, $premium);
        }
    }

    public function notifications($user, $limit, $days)
    {
        foreach ($user->notifications as $notification) {
            if ($notification->data['notification_id'] == $limit . '-' . $days) {
                return true;
            }
        }
        $end = strtotime($limit);
        $start = strtotime(gmdate('Y-m-d'));
        $diff = $end - $start;
        $d = $diff / (60 * 60 * 24);
        $data = [
            'img' => null,
            'name' => 'TheGround',
            'url' => null,
            'task' => 'votre compte sera archivez dans ' . $d . ' jours',
            'msg' => 'penser a recharger votre Range',
            'limit' => $limit,
            'days'  => $days
        ];
        Notification::send($user,new LimitAccount($data) );
        return true;
    }
}
