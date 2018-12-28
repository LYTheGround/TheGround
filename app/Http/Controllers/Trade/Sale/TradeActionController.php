<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Accounting;
use App\Client;
use App\Http\Requests\Trade\EcheanceRequest;
use App\Month;
use App\Product;
use App\Sale;
use App\Trade_action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DateTime;

class TradeActionController extends Controller
{

    public function echeance(EcheanceRequest $request, Sale $sale)
    {
        $this->authorize('done',$sale);
        $sale->echeance()->create([
            'date'  => $request->date,
            'prince'    => $sale->ttc,
            'company_id' => $sale->company_id
        ]);
        // marquez comme vendu
        $sale->trade_action()->update([
            'done'              => true,
            'done_member_id'    => auth()->user()->member->id,
            'done_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'store','url'=> route('sale.show',compact('sale')) . '/tasks/store'],'progress' => 45]),
        ]);
        // store_qt in purchased
        $this->purchased_store_qt($sale);
        $accounting = $sale->company->accounting;
        // ajouter les valuers sur le accounting
        $accounting->update([
            'tva'       => $accounting->tva + $sale->tva_payed,
            'taxes'     => $accounting->taxes + $sale->taxes,
            'profit'    => $accounting->profit + $sale->profit_after_taxes,
            'taxes_after_unload'    => $accounting->taxes_after_unload + $sale->taxes,
            'tva_after_unload'      => $accounting->tva_after_unload + $sale->tva_payed
        ]);
        // ajouter le sold
        // month
        $month = Month::month();
        $this->sold($sale,$accounting,$month);
        $month->update([
            'tva'       => $month->tva + $sale->tva_payed,
            'taxes'     => $month->taxes + $sale->taxes,
            'profit'    => $month->profit + $sale->profit_after_taxes,
            'taxes_after_unload'    => $month->taxes_after_unload + $sale->taxes,
            'tva_after_unload'      => $month->tva_after_unload + $sale->tva_payed
        ]);
        // redirect show sale
        return redirect()->route('sale.show',compact('sale'));
    }

    public function done(Sale $sale)
    {
        $this->authorize('done',$sale);
        $ttc = $sale->ttc;
        $url = route('sale.show',compact('sale')) . '/echeance';
        return view('trade.echeance.create',compact('url','ttc'));
    }

    private function sold(Sale $sale,Accounting $accounting,Month $month)
    {
        $dv = $sale->dv;
        foreach ($dv->orders as $order) {
            $sold = $order->sold()->create([
                'qt'    => $order->bc->qt,
                'product_id' => $order->bc->purchased->product_id,
                'accounting_id' => $accounting->id,
                'month_id'  => $month->id
            ]);
            $sold->update(['slug' => '#SOLD-' . $sold->id]);
            $this->clientProduct($order->bc->purchased->product,$order->pu,$dv->client_id);
        }
    }

    private function clientProduct($product, $pu,$client_id)
    {
        $min = $product->clients()->where('client_id',$client_id)->first();
        if($min){
            if($min->pivot->min_prince > $pu){
                $min->pivot->update([
                    'min_prince' => $pu,
                    'updated_at' => now()
                ]);
            }
        }
        else{
            $product->clients()->attach($client_id,['min_prince' => $pu]);
        }
    }

    private function purchased_store_qt($sale)
    {
        foreach ($sale->dv->orders as $order) {
            $purchased = $order->bc->purchased;
            $productAmount = $purchased->productAmount;
            $this->clientProduct($purchased->product,$order->pu,$sale->dv->client_id);
            $sqt = $order->bc->qt;
            $pqt = $productAmount->qt;
            $lqt = $pqt - $sqt;
            $total = $productAmount->ttcu * $lqt;
            $add = $productAmount->total - $total;
            $productAmount->update([
                'qt' => $lqt,
                'total' => $total
            ]);
            $product = $productAmount->product;
            $product->update([
                'amount' => $product->amount - $add
            ]);
            $purchased->update([
                'store_qt' => $purchased->store_qt - $order->bc->qt,
            ]);
        }
    }

    public function purchased_qt($sale)
    {
        foreach ($sale->dv->orders as $order) {
            $purchased = $order->bc->purchased;
            $product = $purchased->product;
            $purchased->update([
                'qt' => $purchased->qt - $order->bc->qt,
            ]);
            $product->update([
                'qt'    => $product->qt - $order->bc->qt
            ]);
        }
    }

    public function store(Sale $sale)
    {
        $this->authorize('store',$sale);
        $sale->trade_action()->update([
            'bl'                => true,
            'bl_member_id'      => auth()->user()->member->id,
            'bl_time'           => Carbon::now(),
            'store'             => true,
            'store_member_id'   => auth()->user()->member->id,
            'store_time'        => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'delivery','url'=> route('sale.show',compact('sale')) . '/tasks/delivery'],'progress' => 60]),
        ]);
        $this->purchased_qt($sale);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function delivery(Sale $sale)
    {
        $this->authorize('delivery',$sale);
        $sale->trade_action->update([
            'delivery'              => true,
            'delivery_member_id'    => auth()->user()->member->id,
            'delivery_time'         => Carbon::now(),
            'tasks'                 => json_encode(['next' => ['name' => 'finish','url'=> route('sale.show',compact('sale')) . '/tasks/finish'],'progress' => 75]),
        ]);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function finish(Sale $sale)
    {
        $this->authorize('finish',$sale);
        $trade = $sale->trade_action;
        $trade->update([
            'fc'                => true,
            'fc_member_id'      => auth()->user()->member->id,
            'fc_time'           => Carbon::now(),
            'tasks'             => json_encode(['next' => null,'progress' => 100]),
            'status'            => 'finish'
        ]);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function bl(Sale $sale)
    {
        $this->authorize('bl',$sale);
        return view('trade.sale.bc.bl',compact('sale'));
    }

    public function fc(Sale $sale)
    {
        $this->authorize('fc',$sale);
        return view('trade.sale.fc',compact('sale'));
    }
}
