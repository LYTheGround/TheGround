<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Accounting;
use App\Client;
use App\Http\Controllers\Admin\ArchiveTradeController;
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

    public function done(Sale $sale)
    {
        $this->authorize('done',$sale);
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
            $sold->update(['slug' => 'SOLD-' . $sold->id]);
            $this->min_prince($dv->client,$order->bc->purchased->product_id,$order->pu);
        }
    }

    public function min_prince(Client $client,$product_id,$pu)
    {
        $min = $client->products()->where('product_id',$product_id)->first();
        if($min){
            if ($min->pivot->min_prince > $pu){
                $min->pivot->update([
                    'min_prince' => $pu
                ]);
            }
        }
        else{
            $client->products()->attach($product_id, ['min_prince' => $pu]);
        }
    }

    public function purchased_store_qt($sale)
    {
        foreach ($sale->dv->orders as $order) {
            $purchased = $order->bc->purchased;
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
