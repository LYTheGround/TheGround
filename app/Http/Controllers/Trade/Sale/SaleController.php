<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Http\Requests\Trade\Sale\DvRequest;
use App\Sale;
use App\Trade_action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{

    public function index()
    {
        $sales = auth()->user()->member->company->sales;
        return view('trade.sale.index',compact('sales'));
    }

    public function create()
    {
        $clients = auth()->user()->member->company->clients;
        return view('trade.sale.create',compact('clients'));
    }

    public function store(DvRequest $request)
    {
        // trade action
        $tasks = json_encode(['next' => null,'progress' => 0]);
        $trade = Trade_action::create([
            'status' => 'int',
            'tasks' => $tasks
        ]);
        // sale
        $sale = $trade->sale()->create([
            'company_id'            => auth()->user()->member->company->id,
            'ht'                    => false,
            'tva'                   => false,
            'ttc'                   => false,
            'tva_payed'             => false,
            'profit'                => false,
            'taxes'                 => false,
            'profit_after_taxes'    => false
        ]);
        $sale->update(['slug' => 'S-'.$sale->id]);
        $dv = $sale->dv()->create(['client_id' => $request->client]);
        $dv->update(['slug' => 'DV-' . $dv->id]);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function show(Sale $sale)
    {
        $tasks = json_decode($sale->trade_action->tasks);
        return view('trade.sale.show',compact('sale','tasks'));
    }

    public function destroy(Sale $sale)
    {
        if(isset($sale->bcs[0])){
            foreach ($sale->bcs as $bc){
                $purchased = $bc->purchased;
                // add bcs to purchased
                $purchased->update([
                    'offer_qt' => $bc->qt + $purchased->offer_qt
                ]);
                // delete orders
                $bc->order()->delete();
                // delete bcs
                $bc->delete();
            }
        }
        // delete dv
        $sale->dv()->delete();
        // delete trade_action
        $sale->trade_action()->delete();
        // delete sale
        $sale->delete();
        return redirect()->route('sale.index');
    }
}
