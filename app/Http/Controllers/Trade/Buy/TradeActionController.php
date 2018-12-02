<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Buy;
use App\Buy_dv;
use App\Buy_order;
use App\Http\Controllers\Controller;
use App\Month;
use App\Purchased;
use Carbon\Carbon;

class TradeActionController extends Controller
{
    private $tva = 0;
    public function done(Buy $buy)
    {
        // vérifier
            // si le member à l'accès
            // si le bc et le dv est déjà eu lieu
        $dv = $buy->dvs->where('selected', true)->first();
        $orders = $dv->orders;
        // marquer comme acheter dans le purchased
        $month = Month::month();
        foreach ($orders as $order){
            $this->tva += $order->tva;
            $order->purchased()->create([
                'slug'          => $buy->slug,
                'qt'            => $order->bc->qt,
                'store_qt'      => $order->bc->qt,
                'offer_qt'      => $order->bc->qt,
                'product_id'    => $order->bc->product_id,
                'accounting_id' => $buy->company->accounting->id,
                'month_id'      => $month->id
            ]);
        }
        // accounting
        $accounting = $buy->company->accounting;
        $accounting->update([
            'tva' => $accounting->tva + $this->tva
        ]);
        // month
        $month->update([
            'tva' => $month->tva + $this->tva,
            'tva_after_unload' => $month->tva_after_unload + $this->tva,
        ]);
        // marquez comme done dans trade_action
        $buy->trade_action->update([
            'done'              => true,
            'done_member_id'    => auth()->user()->member->id,
            'done_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'delivery','url'=> route('buy.show',compact('buy')) . '/tasks/delivery'],'progress' => 45]),
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function delivery(Buy $buy)
    {
        // verifier si il ya l'autorisation
        // verifier si il ya déjà un delivery
            // si oui modifier trade_action en suppriment tous les taches sauf bc et dv et done
            // si non marquez comme dv supprimé tous les taches sauf bc et dv et done et delivery
        $buy->trade_action->update([
            'delivery'              => true,
            'delivery_member_id'    => auth()->user()->member->id,
            'delivery_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'store','url'=> route('buy.show',compact('buy')) . '/tasks/store'],'progress' => 60]),
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function store(Buy $buy)
    {
        // verifier si il ya l'autorisation
        // verifier si il ya déjà un store
            // si oui modifier trade_action en suppriment tous les taches sauf bc et dv et done et delivery
            // si non marquez comme dv supprimé tous les taches sauf bc et dv et done et delivery et store
        $buy->trade_action->update([
            'store'              => true,
            'store_member_id'    => auth()->user()->member->id,
            'store_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'finish','url'=> route('buy.show',compact('buy')) . '/tasks/finish'],'progress' => 75]),
        ]);
        // ajouter les valuers sur le accounting
        $accounting = $buy->company->accounting;
        $accounting->update([
            'tva'                   => $accounting->tva + $buy->tva_payed,
            'tva_after_unload'      => $accounting->tva_after_unload + $buy->tva_payed
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function finish(Buy $buy)
    {
        // verifier si il ya l'autorisation
        // verifier si il ya déjà un store
            // si oui modifier trade_action en suppriment tous les taches sauf bc et dv et done et delivery
            // si non marquez comme dv supprimé tous les taches sauf bc et dv et done et delivery et store
        $buy->trade_action->update([
            'tasks'             => json_encode(['next' => null,'progress' => 100]),
            'status'            => 'finish'
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function bl(Buy $buy)
    {
        // verifier si il ya l'autorisation
        // ajoute le bl en image dans son chemin approprié et ajouter-le dans la trade_action

    }

    public function fc(Buy $buy)
    {
        // verifier si il ya l'autorisation
        // ajoute le fc en image dans son chemin approprié et ajouter-le dans la trade_action
    }
}
