<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Buy;
use App\Buy_dv;
use App\Buy_order;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trade\EcheanceRequest;
use Illuminate\Http\Request;
use App\Month;
use App\Purchased;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TradeActionController extends Controller
{
    private $tva = 0;

    private function clientProduct($product, $pu,$provider_id)
    {
        $min = $product->providers()->where('provider_id',$provider_id)->first();
        if($min){
            if($min->pivot->min_prince > $pu){
                $min->pivot->update([
                    'min_prince' => $pu,
                    'updated_at' => now()
                ]);
            }
        }
        else{
            $product->providers()->attach($provider_id,['min_prince' => $pu]);
        }
    }

    public function echeance(EcheanceRequest $request, Buy $buy)
    {
        $this->authorize('done',$buy);
        // vérifier
        // si le member à l'accès
        // si le bc et le dv est déjà eu lieu
        $dv = $buy->dvs->where('selected', true)->first();
        $buy->update([
            'ht'    => $dv->ht,
            'tva'   => $dv->tva,
            'ttc'   => $dv->ttc
        ]);
        $buy->echeance()->create([
            'date'  => $request->date,
            'prince'    => $dv->ttc,
            'company_id' => $buy->company_id
        ]);
        $orders = $dv->orders;
        // marquer comme acheter dans le purchased
        $month = Month::month();
        foreach ($orders as $order){
            $this->clientProduct($order->bc->product,$order->pu,$dv->provider_id);
            $this->tva += $order->tva;
            $purchased = $order->purchased()->create([
                'slug'          => str_slug('PUR' . $buy->slug. ' '. $order->id),
                'qt'            => $order->bc->qt,
                'store_qt'      => 0,
                'offer_qt'      => 0,
                'product_id'    => $order->bc->product_id,
                'accounting_id' => $buy->company->accounting->id,
                'month_id'      => $month->id
            ]);

            $amount = $purchased->productAmount()->create([
                'qt'            => $order->bc->qt,
                'ttcu'          => ($order->ttc / $order->bc->qt),
                'total'         => $order->ttc,
                'history'       => $order->ttc,
                'product_id'    => $order->bc->product_id,
                'company_id'    => auth()->user()->member->company_id
            ]);
            $product = $amount->product;
            $product->update([
                'amount' => $product->amount + $order->ttc
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
            'tasks'             => json_encode(['next' => ['name' => __('validation.attributes.delivery'),'url'=> route('buy.show',compact('buy')) . '/tasks/delivery'],'progress' => 45]),
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function done(Buy $buy)
    {
        $this->authorize('done',$buy);
        $ttc = $buy->dvs->where('selected', true)->first()->ttc;
        $url = route('buy.show',compact('buy')) . '/echeance';
        return view('trade.echeance.create',compact('url','ttc'));
    }

    public function delivery(Buy $buy)
    {
        $this->authorize('delivery',$buy);
        // verifier si il ya l'autorisation
        // verifier si il ya déjà un delivery
            // si oui modifier trade_action en suppriment tous les taches sauf bc et dv et done
            // si non marquez comme dv supprimé tous les taches sauf bc et dv et done et delivery
        $buy->trade_action->update([
            'delivery'              => true,
            'delivery_member_id'    => auth()->user()->member->id,
            'delivery_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => __('validation.attributes.store'),'url'=> route('buy.show',compact('buy')) . '/tasks/store'],'progress' => 60]),
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function store(Buy $buy)
    {
        $this->authorize('store',$buy);
        // add qt in product and purchased
        //dd($buy->purchaseds());
        $dv = $buy->dvs->where('selected', true)->first();
        $orders = $dv->orders;
        foreach ($orders as $order){
            $this->tva += $order->tva;
            $purchased = $order->purchased;
            $purchased->update([
                'qt'            => $order->bc->qt,
                'store_qt'      => $order->bc->qt,
                'offer_qt'      => $order->bc->qt,
            ]);
            $product = $purchased->product;
            $product->update([
                'qt'    => $product->qt + $order->bc->qt
            ]);
        }
        $buy->trade_action->update([
            'store'              => true,
            'store_member_id'    => auth()->user()->member->id,
            'store_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => __('validation.attributes.finish'),'url'=> route('buy.show',compact('buy')) . '/tasks/finish'],'progress' => 75]),
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function finish(Buy $buy)
    {
        $this->authorize('finish',$buy);
        $trade = $buy->trade_action;
        $trade->update([
            'tasks'             => json_encode(['next' => null,'progress' => 100]),
            'status'            => 'finish'
        ]);

        return redirect()->route('buy.show',compact('buy'));
    }

    public function bl(Request $request,Buy $buy)
    {
        $this->authorize('bl',$buy);
        $validator = Validator::make($request->all('bl'),[
            'bl' => 'required|mimes:jpg,jpeg,png'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $buy->trade_action()->update([
            'bl'   => $request->file('bl')->store('trade/bl'),
            'bl_member_id'  => auth()->user()->member->id,
            'bl_time' => Carbon::now()
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function blDestroy(Buy $buy)
    {
        $this->authorize('bl',$buy);
        Storage::disk('public')->delete($buy->trade_action->bl);
        $buy->trade_action()->update([
            'bl'   => null,
            'bl_member_id'  => null,
            'bl_time' => null
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function fc(Request $request,Buy $buy)
    {
        $this->authorize('bl',$buy);
        $validator = Validator::make($request->all('fc'),[
            'fc' => 'required|mimes:jpg,jpeg,png'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $buy->trade_action()->update([
            'fc'   => $request->file('fc')->store('trade/fc'),
            'fc_member_id'  => auth()->user()->member->id,
            'fc_time' => Carbon::now()
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }

    public function fcDestroy(Buy $buy)
    {
        $this->authorize('bl',$buy);
        Storage::disk('public')->delete($buy->trade_action->fc);
        $buy->trade_action()->update([
            'fc'   => null,
            'fc_member_id'  => null,
            'fc_time' => null
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }
}
