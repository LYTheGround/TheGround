<?php

namespace App\Http\Controllers\Money;

use App\Echeance;
use App\Http\Requests\Trade\EcheanceRequest;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class EcheanceController extends Controller
{

    public function index()
    {
        $this->authorize('view',Echeance::class);
        $echeances = auth()->user()->member->company->echeances()
            ->orderBy('payed')
            ->orderBy('date')
            ->get();
        return view('money.echeance.index',compact('echeances'));
    }

    public function edit(Echeance $echeance)
    {
        $this->authorize('update',$echeance);
        return view('money.echeance.edit',compact('echeance'));
    }

    public function update(EcheanceRequest $request,Echeance $echeance)
    {
        $this->authorize('update',$echeance);
        $echeance->update(['date' => $request->date]);
        session()->flash('status','La Modification a bien été exécuté');
        return redirect()->route('echeance.index');
    }

    public function destroy(Echeance $echeance)
    {
        $this->authorize('update',$echeance);
        $echeance->delete();
        session()->flash('status','La suppression a bien été exécuté');
        return back();
    }

    public function payed(Echeance $echeance)
    {
        $this->authorize('update',$echeance);
        $echeance->update(['payed' => Carbon::now()]);
        session()->flash('status','Le paiement a bien été marquez comme Payer');
        return back();
    }
}
