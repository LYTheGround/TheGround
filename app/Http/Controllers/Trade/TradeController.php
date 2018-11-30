<?php

namespace App\Http\Controllers\Trade;

use App\Buy;
use App\Sale;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TradeController extends Controller
{

    /**
     * @role la liste des achats encours et la liste des ventes encours
     *
     * @return View
     */

    public function __invoke()
    {
        $company = auth()->user()->member->company;
        // La liste des dix dernier achats encours de cette compagnie conserver dans une variable "buys"
        // En demandent au curseur d'attendre la jointure de la table :  <trade_action>
        $buys = Buy::where('company_id',$company->id)->with('trade_action')->limit(10)->get();
        $buys = $buys->reject(function ($buy) {
            $tasks = json_decode($buy->trade_action->tasks);
            return $tasks->progress == 100;
        });
        // La liste des dix dernier ventes encours de cette Compagnie conservé dans une variable "Salses"
        // En demandent au curseur d'attendre la jointure de la table :  <trade_action>
        $sales = Sale::where('company_id',$company->id)->with('trade_action')->limit(10)->get();
        $sales = $sales->reject(function ($sale) {
            $tasks = json_decode($sale->trade_action->tasks);
            return $tasks->progress == 100;
        });
        // Returner la vus "index" dans le dossier <Trade>
        return view('trade.index',compact('buys','sales'));
    }
}
