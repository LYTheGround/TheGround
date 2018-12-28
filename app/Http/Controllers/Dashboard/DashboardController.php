<?php

namespace App\Http\Controllers\Dashboard;

use App\Buy;
use App\Client;
use App\Company;
use App\Member;
use App\Position;
use App\Product;
use App\Provider;
use App\Sale;
use App\Trade_action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * récupéré la data nécessaire et renvoi la vue.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        // members
        $members = $this->members();
        // positions
        $positions = $this->positions();
        // providers
        $providers = $this->providers();
        // clients
        $clients = $this->clients();
        // product
        $products = $this->products();
        // buy
        $buys = $this->buys();
        // sale
        $sales = $this->sales();
        $data = compact('sales','buys','products','clients','providers','positions','members');
        //dd($members[0]->);
        return view('dashboard',$data);
    }

    /**
     * la list des dernier cinq member de la compagnie.
     * @return mixed
     */
    private function members()
    {
        return Member::where('company_id',auth()->user()->member->company_id)
            ->take(5)
            ->orderBy('id',"desc")
            ->with('info')
            ->with('premium.category')
            ->get();
    }

    /**
     * la list des dernier cinq position de la company.
     * @return mixed
     */
    private function positions()
    {
        return Position::where('company_id',auth()->user()->member->company_id)
            ->take(5)
            ->orderBy('id',"desc")
            ->with('info.city')
            ->get();
    }

    /**
     * la list des dernier cinq Fournisseurs de la company.
     * @return mixed
     */
    private function providers()
    {
        return Provider::where('company_id',auth()->user()->member->company_id)
            ->take(5)
            ->orderBy('id',"desc")
            ->with('info_box.city')
            ->get();
    }

    /**
     * la list des dernier cinq Clients de la company.
     * @return mixed
     */
    private function clients()
    {
        return Client::where('company_id',auth()->user()->member->company_id)
            ->take(5)
            ->orderBy('id',"desc")
            ->with('info_box.city')
            ->get();
    }

    /**
     * la list des dernier cinq Produits de la company.
     * @return mixed
     */
    private function products()
    {
        return Product::where('company_id',auth()->user()->member->company_id)
            ->take(5)
            ->orderBy('id',"desc")
            ->get();
    }

    /**
     * la list des dernier cinq Achats de la company.
     * @return mixed
     */
    private function buys()
    {
        return Buy::where('company_id',auth()->user()->member->company_id)
            ->take(5)
            ->orderBy('id',"desc")
            ->with('trade_action')
            ->get();
    }

    /**
     * la list des dernier cinq Ventes de la company.
     * @return mixed
     */
    private function sales()
    {
        return Sale::where('company_id',auth()->user()->member->company_id)
            ->take(5)
            ->orderBy('id',"desc")
            ->with('trade_action')
            ->get();
    }

}
