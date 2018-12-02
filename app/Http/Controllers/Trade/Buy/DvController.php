<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Buy;
use App\Buy_dv;
use App\Buy_order;
use App\Http\Requests\Trade\Buy\DvRequest;
use App\Provider;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DvController extends Controller
{
    private $ht = 0;
    private $tva = 0;
    private $ttc = 0;

    /**
     * Affichage du devi d'achat.
     * @param Buy $buy
     * @param Buy_dv $dv
     * @return View
     */
    public function show(Buy $buy,Buy_dv $dv)
    {
        // verifier Que cette vente appartient a la compagnie du membre
        if(auth()->user()->member->company->id == $buy->company_id){
            // verifier Que le devi indiquez appartient à cette achat
            if($dv->buy_id == $buy->id){
                // returner la vus "show" dans le repertoire d'achat en la transmettant les deux variables "$buy et $dv et $orders et $provider"
                    // - $buy.
                    // - $dv
                    // - provider
                    // - orders with product && product_img
                $provider = Provider::where('id',$dv->provider_id)->with('info_box')->first();
                $orders = Buy_order::where('buy_dv_id',$dv->id)->with('bc')->get();
                return view('trade.buy.Dv.show',compact('buy','dv','provider','orders'));
            }
            abort(404);
        }
        abort(404);
    }

    /**
     * @param Buy $buy
     * @return View
     */

    public function create(Buy $buy)
    {
        // bcs de cet achat
        $bcs = $buy->bcs;
        // tous les provider de la compagnie
        $providers = Provider::where('company_id',auth()->user()->member->company_id)->with('info_box')->get();
        // return la vus "create" en transmettant les variable "buy - bcs - providers"
        return view('trade.buy.dv.create',compact('buy','bcs','providers'));
    }

    public function store(DvRequest $request, Buy $buy)
    {
        // request
            // pu pour tous les bons de commande
            // le provider exist et contient a cette compagnie
        if($this->validated($request,$buy)){
            return redirect()->route('dv.create',compact('buy'));
        }
        // ajouter un nouveau dv
        $dv = $buy->dvs()->create([
            'provider_id' => $request->provider,
        ]);
        $this->selected($buy,$dv);
        // ajouter tous les orders avec la fonction [$this->orders($request->all())]
        $this->orders($request,$buy,$dv);
        // modifier les prix dans dv (ht-tva-ttc) d'pré les variable privé
        $dv->update([
            'ht'    => $this->ht,
            'tva'   => $this->tva,
            'ttc'   =>$this->ttc
        ]);
        // indiquez en session flash que l'insertion du devi a bien est inséré avec succès
        session()->flash('status',"l'insertion est avec succès");
        // returner une redirection vers le show buy en lui transmettant la variable buy
        return redirect()->route('buy.show',compact('buy'));
    }

    private function validated(DvRequest $request, Buy $buy)
    {
        foreach ($buy->bcs as $bc){
            if(!isset($request->pu[$bc->id])){
                session()->flash('status','Désolé tous les prix doit être indiquez');
                return true;
            }
        }
        return false;
    }

    public function orders(DvRequest $request,Buy $buy,$dv)
    {
        foreach ($buy->bcs as $bc) {
            $ht = $request->pu[$bc->id] * $bc->qt;
            $tva = $ht * ($bc->product->tva/100);
            $ttc = $ht + $tva;
            $dv->orders()->create([
                'pu' => $request->pu[$bc->id],
                'ht'        => $ht,
                'tva'       => $tva,
                'ttc'       => $ttc,
                'buy_bc_id' => $bc->id
            ]);
            $this->tva += $tva;
            $this->ht += $ht;
            $this->ttc += $ttc;
        }
    }

    public function destroy(Buy $buy, Buy_dv $dv)
    {
        // vérifié si ce dv appartient a ce buy
        // vérifier si ce buy appartient a cette compagnie
        if($dv->delete()){
            session()->flash('status','le devi a été supprimé avec succès');
        }
        else{
            session()->flash('status','un problème est survenu l\'or de la suppression veuillez ressayer');
        }
        return redirect()->route('buy.show',compact('buy'));
    }

    public function selected(Buy $buy, Buy_dv $dv)
    {
        $dvs = $buy->dvs;
        foreach ($dvs as $ds){
            $ds->update(['selected' => false]);
        }
        $dv->update(['selected' => true]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function confirm(Buy $buy)
    {
        $buy->trade_action->update([
            'dv'            => true,
            'dv_member_id'  => auth()->user()->member->id,
            'dv_time'       => Carbon::now(),
            'tasks'         => json_encode(['prev' => null,'next' => ['name' => 'acheter','url'=> route('buy.show',compact('buy')) . '/tasks/done'],'progress' => 30]),
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }
}
