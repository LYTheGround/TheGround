<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Sale;
use App\Trade_action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradeActionController extends Controller
{

    public function done(Sale $sale)
    {
        // marquez comme vendu
        $sale->trade_action()->update([
            'done'              => true,
            'done_member_id'    => auth()->user()->member->id,
            'done_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'store','url'=> route('sale.show',compact('sale')) . '/tasks/store'],'progress' => 45]),
        ]);
        // offer and store_qt in purchased
        $this->purchased_store_qt($sale);
        // ajouter les valuers sur le accounting
        $accounting = $sale->company->accounting;
        $accounting->update([
            'tva'       => $accounting->tva + $sale->tva_payed,
            'taxes'     => $accounting->taxes + $sale->taxes,
            'profit'    => $accounting->profit + $sale->profit_after_taxes,
            'taxes_after_unload'    => $accounting->taxes_after_unload + $sale->taxes,
            'tva_after_unload'      => $accounting->tva_after_unload + $sale->tva_payed
        ]);
        // rediriger show sale
        return redirect()->route('sale.show',compact('sale'));
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
            $purchased->update([
                'qt' => $purchased->qt - $order->bc->qt,
            ]);
        }
    }

    public function store(Sale $sale)
    {
        $sale->trade_action()->update([
            'store'              => true,
            'store_member_id'    => auth()->user()->member->id,
            'store_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'delivery','url'=> route('sale.show',compact('sale')) . '/tasks/delivery'],'progress' => 60]),
        ]);
        $this->purchased_qt($sale);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function delivery(Sale $sale)
    {
        $sale->trade_action->update([
            'delivery'              => true,
            'delivery_member_id'    => auth()->user()->member->id,
            'delivery_time'         => Carbon::now(),
            'tasks'             => json_encode(['next' => ['name' => 'finish','url'=> route('sale.show',compact('sale')) . '/tasks/finish'],'progress' => 75]),
        ]);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function finish(Sale $sale)
    {
        $sale->trade_action->update([
            'tasks'             => json_encode(['next' => null,'progress' => 100]),
            'status'            => 'finish'
        ]);
        return redirect()->route('sale.show',compact('sale'));
    }
}
